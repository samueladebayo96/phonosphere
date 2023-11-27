<?php

/**
 * Model user : sur ce modèle, nous traiterons toutes les requêtes liées à la table user
 */


function getUsersFromTable(): array
{
    global $conn;
    $sql = $conn->query("SELECT * FROM users");
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function getUserByUserName($username): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUserByUserId($user_id): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->execute([$user_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function ifExistInUsersTable($value, $column): bool
{
    $users = getUsersFromTable();
    return is_numeric(array_search($value, array_column($users, $column)));
}

function registerUser($username, $password, $retry_password, $lastname, $firstname, $secret_question, $secret_answer): bool
{
    if (ifExistInUsersTable($username, "username")) {
        return false;
    }
    global $conn;
    $sql = "INSERT INTO users (username, password, lastname, firstname, secret_question, secret_answer) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $password, $lastname, $firstname, $secret_question, $secret_answer]);
    return true;

}

function login($username, $password): bool
{
    global $conn;
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $password]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $user_id = $stmt->fetchColumn();
        $last_activity = date('Y-m-d H:i:s', time());
        $sql = "UPDATE users SET last_activity = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$last_activity, $user_id]);
    } else {
        return false;
    }
    return true;
}
function resetPassword($user_id, $secret_answer, $new_password): bool
{
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ? AND secret_answer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $secret_answer]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $sql = "UPDATE users SET password = ? WHERE id =?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_password, $user_id]);
        return true;
    } else {
        return false;
    }
}


<?php

/**
 * Model user : sur ce modèle, nous traiterons toutes les requêtes liées à la table user
 */

/**
 * function : Permet de récupérer tout les users de la table users
 * return : retourne la table users en array
 */
function getUsersFromTable(): array
{
    global $conn;
    $sql = $conn->query("SELECT * FROM users");
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * function : Permet de récupérer un user avec son nom d'utilisateur
 * params : $username -> le nom d'utilisateur du user
 * return : retourne le user en array
 */
function getUserByUserName($username): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * function : Permet de récupérer un user avec son id
 * params : $id -> l'id du user
 * return : retourne le user en array
 */
function getUserByUserId($user_id): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->execute([$user_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * function : Permet de vérifier si une valeur se retrouve dans la table users
 * params : $value -> la valeur à retrouver
 * params : $column -> la colonne dans laquelle la valeur se trouve
 * return : retourne si elle est bien dans la table users
 */
function ifExistInUsersTable($value, $column): bool
{
    $users = getUsersFromTable();
    return is_numeric(array_search($value, array_column($users, $column)));
}


/**
 * function : Permet d'enregistrer un utilisateur
 * params : $username, $password, $retry_password, $lastname, $firstname, $secret_question, $secret_answer -> les valeurs à insérer dans la base de donnée
 * return : retourne si l'utilisateur a bien été insérer dans la base de donnée
 */
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


/**
 * function : Permet de se connecter à un compte
 * params : $username, $password -> les paramètres pour se connecter à un compte
 * return : retourne si l'utilisateur a bien réussi à se connecter au compte
 */
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

/**
 * function : Permet de modifier le mot de passe d'un utilisateur
 * params : $user_id, $secret_answer, $new_password -> les paramètres pour se connecter à un compte
 * return : retourne si le mot de passe à bien été modifié
 */
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


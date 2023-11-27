<?php

/**
 * Modèle contact : sur ce modèle, nous traiterons toutes les requêtes liées à la table contact
 */

function getContactsFromTable(): array
{
    global $conn;
    $query = $conn->query("SELECT * FROM contacts");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getContactsByUserId($user_id): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
    $query->execute([$user_id]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getContactById($id): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function ifExistInContactsTable($value, $column): bool
{
    $contacts = getContactsFromTable();
    return is_numeric(array_search($value, array_column($contacts, $column)));
}

function registerContact($lastname, $firstname, $phone_number, $address, $user_id): bool
{
    if (ifExistInContactsTable($phone_number, "phone_number")) {
        return false;
    }
    global $conn;
    $sql = "INSERT INTO contacts (lastname, firstname, phone_number, address, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$lastname, $firstname, $phone_number, $address, $user_id]);
    return true;

}

function removeContact($id, $user_id): bool
{
    global $conn;
    $sql = "DELETE FROM contacts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $user_id]);
    return true;
}
function updateContact($id, $lastname, $firstname, $phone_number, $address): bool
{
    if (ifExistInContactsTable($phone_number, "phone_number")) {
        return false;
    }
    global $conn;
    $sql = "UPDATE contacts SET lastname = ?, firstname = ?, phone_number = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$lastname, $firstname, $phone_number, $address, $id]);
    return true;
}
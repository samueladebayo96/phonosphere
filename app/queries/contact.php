<?php

/**
 * Modèle contact : sur ce modèle, nous traiterons toutes les requêtes liées à la table contact
 */



/**
 * function : Permet de récupérer tout les contacts de la table contacts
 * return : retourne la table contacts en array
 */
function getContactsFromTable(): array
{
    global $conn;
    $query = $conn->query("SELECT * FROM contacts");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * function : Permet de récupérer tout les contacts d'un utilisateur
 * params : $user_id -> l'utilisateur à qui on va récupérer les contacts
 * return : retourne les contacts de l'utilisateur en array
 */
function getContactsByUserId($user_id): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
    $query->execute([$user_id]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * function : Permet de récupérer un contact avec son id
 * params : $id -> l'id du contact
 * return : retourne le contact en array
 */
function getContactById($id): array
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * function : Permet de vérifier si une valeur se retrouve dans la table contacts
 * params : $value -> la valeur à retrouver
 * params : $column -> la colonne dans laquelle la valeur se trouve
 * return : retourne si elle est bien dans la table contacts
 */
function ifExistInContactsTable($value, $column): bool
{
    $contacts = getContactsFromTable();
    return is_numeric(array_search($value, array_column($contacts, $column)));
}

/**
 * function : Permet de vérifier si une valeur se retrouve dans le répertoire de contact d'un utilisateur
 * params : $user_id -> dans quelle répertoire de quelle utilisateur on va rechercher la valeur
 * params : $value -> la valeur à retrouver
 * params : $column -> la colonne dans laquelle la valeur se trouve
 * return : retourne si elle est bien dans le répertoire de contact de l'utilisateur
 */
function ifContactExistInBook($user_id, $value, $column): bool
{
    $contacts = getContactsByUserId($user_id);
    return is_numeric(array_search($value, array_column($contacts, $column)));
}


/**
 * function : Permet d'enregistrer un contact
 * params : $lastname, $firstname, $phone_number, $address, $user_id -> les valeurs à insérer dans la base de donnée
 * return : retourne si l'utilisateur a bien été insérer dans la base de donnée
 */
function registerContact($lastname, $firstname, $phone_number, $address, $user_id): bool
{
    if (ifContactExistInBook($user_id, $phone_number, "phone_number")) {
        return false;
    }
    global $conn;
    $sql = "INSERT INTO contacts (lastname, firstname, phone_number, address, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$lastname, $firstname, $phone_number, $address, $user_id]);
    return true;

}

/**
 * function : Permet de supprimer un contact
 * params : $id -> l'id du contact à supprimer
 * params : $user_id -> dans quelle répertoire de quelle utilisateur il se trouve
 * return : retourne si l'utilisateur a bien été supprimé de la base de donnée
 */
function removeContact($id, $user_id): bool
{
    global $conn;
    $sql = "DELETE FROM contacts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $user_id]);
    return true;
}

/**
 * function : Permet de modifier un contact
 * params : $id -> l'id du contact à modifier
 * params : $lastname, $firstname, $phone_number, $address -> les valeurs à modifier dans la base de donnée
 * return : retourne si l'utilisateur a bien été modifié
 */
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
<?php

/**
 *  Controller contact : ce contrôleur s'occupera de récupérer les données envoyées par des requêtes GET ou POST et appelera les fonctions nécessaire dans le modèle contact et retournera le résultat à la vue
 */

/**
 *  checkContactFields est une fonction qui sert à vérifier si les données envoyées dans le formulaire ont bien été remplis
 *  params - $fields : un tableau de données
 *  return : cette fonction retourne un tableau d'erreurs si il y en a
 */

function checkContactFields($fields): array {
    $err = [];
    $errorMessages = [
        "lastname" => "Le nom de famille est vide",
        "firstname" => "Le prénom est vide",
        "phone_number" => "Le numéro de téléphone est vide",
        "address" => "L'adresse est vide",
    ];

    foreach($fields as $key => $value) {
        if(!isset($value) || empty($value)) {
            $err[] = $errorMessages[$key];
        }
    }

    return $err;
}

/**
 *  Condition pour appeler la fonction qui permet d'insérer un nouveau contact dans la base de donnée
 */

if(!is_null($action) && $action === "add_contact") {
    $lastname = htmlspecialchars($_POST["lastname"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $phone_number = htmlspecialchars(trim($_POST["phone_number"]));
    $address = htmlspecialchars($_POST["address"]);
    $fields = ["lastname" => $lastname, "firstname" => $firstname, "phone_number" => $phone_number, "address" => $address];
    $user_id = $_SESSION["user_id"];
    $errors = checkContactFields($fields);
    if(empty($errors)) {
        $success = registerContact($lastname, $firstname, $phone_number, $address, $user_id);
        if(!$success) {
            $errors[] = "Numéro déjà enregistré";
        }
    }
    if($success) {
        header("Location: contacts");
    }
}

/**
 *  Condition pour appeler la fonction qui permet de supprimer un contact de la base de donnée
 */

if(!is_null($action) && $action === "remove_contact") {
    $contact_id = $_GET["id"];
    $user_id = $_SESSION["user_id"];
    $success = removeContact($contact_id, $user_id);
    if(!$success) {
        $errors[] = "Le contact n'existe pas";
    }
    if($success) {
        header("Refresh: 0; url=contacts");
    }
}

/**
 *  Condition pour appeler la fonction qui permet de modifier un contact de la base de donnée
 */

if(!is_null($action) && $action === "update") {
    if(!is_numeric($_GET["id"])) {
        $errors[] = "Identifiant introuvable";
    }
    $contact_id = htmlspecialchars(trim($_GET["id"]));
    $lastname = htmlspecialchars(trim($_POST["lastname"]));
    $firstname = htmlspecialchars(trim($_POST["firstname"]));
    $phone_number = htmlspecialchars(trim($_POST["phone_number"]));
    $address = htmlspecialchars($_POST["address"]);
    $fields = ["lastname" => $lastname, "firstname" => $firstname, "phone_number" => $phone_number, "address" => $address];
    $errors = checkContactFields($fields);
    if(empty($errors)) {
        $success = updateContact($contact_id, $lastname, $firstname, $phone_number, $address);
        if(!$success) {
            $errors[] = "Numéro déjà enregistré sur un autre utilisateur";
        }
    }
    if($success) {
        header("Location: contacts");
    }
}

/**
 *  Condition pour appeler la fonction qui permet d'import des contacts dans la base de donnée
 */

if(isset($_FILES["import_contacts"]) && $_FILES["import_contacts"]["error"] == UPLOAD_ERR_OK) {
    $tmp_file = $_FILES["import_contacts"]["tmp_name"];
    $contacts = array_map('str_getcsv', file($tmp_file));
    unset($contacts[0]);
    sort($contacts);
    foreach($contacts as $contact) {
        $lastname = htmlspecialchars(trim($contact[1]));
        $firstname = htmlspecialchars(trim($contact[2]));
        $phone_number = htmlspecialchars(trim($contact[3]));
        $address = htmlspecialchars(($contact[4]));
        $user_id = $_SESSION["user_id"];
        $fields = ["lastname" => $contact[1], "firstname" => $contact[2], "phone_number" => $contact[3], "address" => $contact[4]];
        $errors = checkContactFields($fields);
        if(empty($errors)) {
            $success = registerContact($lastname, $firstname, $phone_number, $address, $user_id);
            if(!$success) {
                $errors[] = "Numéro déjà enregistré";
                break;
            }
        }
        if($success) {
            continue;
        }
    }
}

?>
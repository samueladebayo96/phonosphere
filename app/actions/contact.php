<?php

/**
 *  Controller contact : ce contrôleur s'occupera de récupérer les données envoyées par des requêtes GET ou POST et appelera les fonctions nécessaire dans le modèle contact et retournera le résultat à la vue
 */

/**
 *  checkContactFields est une fonction qui sert à vérifier si les données envoyées dans le formulaire ont bien été remplis
 *  params - $fields : un tableau de données
 *  return : cette fonction retourne un tableau d'erreurs si il y en a
 */

function checkContactFields($fields): array
{
    $err = [];
    $errorMessages = [
        "lastname" => "Le nom de famille est vide",
        "firstname" => "Le prénom est vide",
        "phone_number" => "Le numéro de téléphone est vide",
        "address" => "L'adresse est vide",
    ];

    foreach ($fields as $key => $value) {
        if (!isset($value) || empty($value)) {
            $err[] = $errorMessages[$key];
        }
    }

    return $err;
}

if (!is_null($action) && $action === "add_contact") {
    $lastname = htmlspecialchars($_POST["lastname"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $phone_number = !is_numeric(htmlspecialchars(trim($_POST["phone_number"]))) ? $errors[] = "Le numéro entré ne contient pas de nombre" : htmlspecialchars(trim($_POST["phone_number"]));
    $address = htmlspecialchars($_POST["address"]);
    $fields = ["lastname" => $lastname, "firstname" => $firstname, "phone_number" => $phone_number, "address" => $address];
    $user_id = $_SESSION["user_id"];
    $errors = checkContactFields($fields);
    if (empty($errors)) {
        $success = registerContact($lastname, $firstname, $phone_number, $address, $user_id);
        if (!$success) {
            $errors[] = "Numéro déjà enregistré";
        }
    }
    if ($success) {
        header("Location: contacts");
    }
}

if (!is_null($action) && $action === "remove_contact") {
    $contact_id = $_GET["id"];
    $user_id = $_SESSION["user_id"];
    $success = removeContact($contact_id, $user_id);
    if (!$success) {
        $errors[] = "Le contact n'existe pas";
    }
    if ($success) {
        header("Refresh: 0; url=contacts");
    }
}

if (!is_null($action) && $action === "update") {
    if (!is_numeric($_GET["id"])) {
        $errors[] = "Identifiant introuvable";
    }
    $contact_id = htmlspecialchars(trim($_GET["id"]));
    $lastname = htmlspecialchars(trim($_POST["lastname"]));
    $firstname = htmlspecialchars(trim($_POST["firstname"]));
    $phone_number = !is_numeric(htmlspecialchars(trim($_POST["phone_number"]))) ? $errors[] = "Le numéro entré ne contient pas de nombre" : htmlspecialchars(trim($_POST["phone_number"]));
    $address = htmlspecialchars($_POST["address"]);
    $fields = ["lastname" => $lastname, "firstname" => $firstname, "phone_number" => $phone_number, "address" => $address];
    $errors = checkContactFields($fields);
    if (empty($errors)) {
        $success = updateContact($contact_id, $lastname, $firstname, $phone_number, $address);
        if (!$success) {
            $errors[] = "Numéro déjà enregistré sur un autre utilisateur";
        }
    }
    if ($success) {
        header("Location: contacts");
    }
}
?>
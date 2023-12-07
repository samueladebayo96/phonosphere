<?php

/**
 *  Controller user : ce contrôleur s'occupera de récupérer les données envoyées par des requêtes GET ou POST et appelera les fonctions nécessaire dans le modèle user et retournera le résultat à la vue
 */

/**
 *  checkUserFields est une fonction qui sert à vérifier si les données envoyées dans le formulaire ont bien été remplis
 *  params - $fields : un tableau de données
 *  return : cette fonction retourne un tableau d'erreurs si il y en a
 */

function checkUserFields($fields): array
{
    $err = [];
    $errorMessages = [
        "lastname" => "Champs nom de famille vide",
        "firstname" => "Champs prénom vide",
        "username" => "Champs nom d'utilisateur vide",
        "password" => "Champs mot de passe vide",
        "secret_question" => "Champs question secrète vide",
        "secret_answer" => "Champs réponse secrète vide",
    ];

    foreach ($fields as $key => $value) {
        if (!isset($value) || empty($value)) {
            $err[] = $errorMessages[$key];
        }
    }

    if (isset($fields["retry_password"]) && (!empty($fields["password"]) && $fields["password"] !== $fields["retry_password"])) {
        $err[] = "Les deux mots de passe entrés ne sont pas identiques";
    }

    return $err;
}

/**
 *  Condition pour appeler la fonction qui permet d'insérer un nouvel utilisateur dans la base de donnée
 */

if (!is_null($action) && $action === "add_user") {
    $username = htmlspecialchars(strtolower(trim($_POST["username"])));
    $password = htmlspecialchars(trim($_POST["password"]));
    $retry_password = htmlspecialchars(trim($_POST["retry_password"]));
    $lastname = htmlspecialchars(trim($_POST["lastname"]));
    $firstname = htmlspecialchars(trim($_POST["firstname"]));
    $secret_question = htmlspecialchars(strtolower($_POST["secret_question"]));
    $secret_answer = htmlspecialchars(strtolower($_POST["secret_answer"]));
    $fields = ["username" => $username, "password" => $password, "retry_password" => $retry_password, "lastname" => $lastname, "firstname" => $firstname, "secret_question" => $secret_question, "secret_answer" => $secret_answer];
    $errors = checkUserFields($fields);
    $password = md5($password);
    $retry_password = md5($retry_password);
    if (empty($errors)) {
        $success = registerUser($username, $password, $retry_password, $lastname, $firstname, $secret_question, $secret_answer);
        if (!$success) {
            $errors[] = "Nom d'utilisateur déjà inscrit";
        }
    }
    if ($success) {
        $_SESSION["user_id"] = $conn->lastInsertId();
        header("Location: home");
    }
}

/**
 *  Condition pour se connecter au site avec un nom d'utilisateur et un mot de passe
 */

if (!is_null($action) && $action === "log_in") {
    $username = htmlspecialchars(strtolower(trim($_POST["username"])));
    $password = htmlspecialchars(trim($_POST["password"]));
    $fields = ["username" => $username, "password" => $password];
    $errors = checkUserFields($fields);
    $password = md5($password);
    if (empty($errors)) {
        $success = login($username, $password);
        if (!$success) {
            $errors[] = "Nom d'utilisateur ou mot de passe incorrect";
        }
    }
    if ($success) {
        $user = getUserByUserName($username);
        $_SESSION["user_id"] = $user["id"];
        header("Location: home");
    }
}


/**
 *  Condition pour se changer de mot de passe (utilisé sur la page mot de passe oublié et profile)
 */

if (!is_null($action) && $action === "reset_password") {
    if (!isset($_SESSION["user_id"])) {
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $user = getUserByUserName($username);
            $secret_answer = htmlspecialchars(strtolower($_POST["secret_answer"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            $fields = ["secret_answer" => $secret_answer, "password" => $password];
            $errors = checkUserFields($fields);
            $password = md5($password);
            if (empty($errors)) {
                $success = resetPassword($user["id"], $secret_answer, $password);
                if (!$success) {
                    $errors[] = "Réponse secrète incorrect";
                }
            }
            if ($success) {
                session_destroy();
                header("Location: home");
            }
        }
    } else {
        $user_id = $_SESSION["user_id"];
        $secret_answer = htmlspecialchars(strtolower($_POST["secret_answer"]));
        $password = htmlspecialchars(trim($_POST["password"]));
        $fields = ["secret_answer" => $secret_answer, "password" => $password];
        $errors = checkUserFields($fields);
        $password = md5($password);
        if (empty($errors)) {
            $success = resetPassword($user_id, $secret_answer, $password);
            if (!$success) {
                $errors[] = "Réponse secrète incorrect";
            }
        }
    }

}
if (!is_null($action) && $action === "update_password") {
    $username = htmlspecialchars(strtolower(trim($_POST["username"])));
    $fields = ["username" => $username];
    $errors = checkUserFields($fields);
    if (empty($errors)) {
        if (ifExistInUsersTable($username, "username")) {
            $_SESSION["username"] = $username;
            header("Location: update_password");
            $success = true;
        } else {
            $errors[] = "Nom d'utilisateur inexistant";
            $success = false;
        }
    }
}

?>
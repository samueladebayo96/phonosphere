<?php



$success = false; // Variable retournée à la vue pour déterminer si l'action est un succès ou pas
$errors = []; // Variable pour contenir une liste d'erreurs


function format(array $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

require_once("user.php");
require_once("contact.php");
?>
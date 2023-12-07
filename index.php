<?php

/**
 * L'index sert de "router" pour afficher les différentes pages
 */

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$action = isset($_GET["action"]) ? $_GET["action"] : null;

$pages = [
    "home" => "home",
    "register" => "register",
    "login" => "login",
    "logout" => "logout",
    "profile" => "profile",
    "lost_password" => "lost_password",
    "contacts" => "contacts",
    "register_contact" => "register_contact",
    "update_contact" => "update_contact",
    "update_password" => "update_password"
];

$page = $_GET["p"] ?? "home";
$page = $pages[$page] ?? "404";

/**
 * Déconnexion
 */

if ($page == "logout") {
    session_destroy();
    header("Location: home");
    $page = "home";
}

/**
 * Si un petit malin veut aller sur la page login alors qu'il est déjà connecté on le renvoie sur page home
 */
if ($page == "login" && isset($_SESSION["user_id"])) {
    header("Location: home");
    $page = "home";
}

/**
 * Si un petit malin veut directement aller sur la page profile alors qu'il n'est connecté à aucun compte on le renvoie sur la page login
 */
if ($page == "profile" && !isset($_SESSION["user_id"])) {
    header("Location: login");
    $page = "login";
}

/**
 * Si un petit malin veut aller sur la page register alors qu'il est déjà connecté on le renvoie sur la page home
 */
if ($page == "register" && isset($_SESSION["user_id"])) {
    header("Location: home");
    $page = "home";
}

/**
 * Si un petit malin veut aller sur la page contacts alors qu'il n'est pas connecté on le renvoie sur la page login
 */
if ($page == "contacts" && !isset($_SESSION["user_id"])) {
    header("Location: login");
    $page = "login";
}

/**
 * Si un petit malin veut aller sur la page register_contact alors qu'il n'est pas connecté on le renvoie sur la page login
 */
if ($page == "register_contact" && !isset($_SESSION["user_id"])) {
    header("Location: login");
    $page = "login";
}

/**
 * Si un petit malin veut aller sur la page update_contact alors qu'il est pas connecté on le renvoie sur la page login
 */
if ($page == "update_contact" && !isset($_SESSION["user_id"])) {
    header("Location: login");
    $page = "login";
}

/**
 * Si un petit malin veut aller sur la page update_password alors qu'il n'est pas passé par la page lost_password on le renvoie à cette page
 */
if ($page == "update_password" && !isset($_SESSION["username"])) {
    header("Location: lost_password");
    $page = "lost_password";
}


$title = "Phonosphere - " . strtoupper($page);

require_once("./app/app.php");
require_once("./app/layouts/template.php");
require_once("./app/$page.php");
require_once("./app/layouts/footer.php");



?>
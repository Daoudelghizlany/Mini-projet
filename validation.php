<?php
session_start();
require('config.php');

$afaire = $_GET['afaire'] ?? '';
if ($afaire === 'deconnexion') {
    session_destroy();
    header("Location: login.php?erreur=3");
    exit;
}

$login = $_POST['login'] ?? '';
$pass = $_POST['pass'] ?? '';

if (empty($login) || empty($pass)) {
    header("Location: login.php?erreur=1");
    exit;
}

if ($login !== USERLOGIN || $pass !== USERPASS) {
    header("Location: login.php?erreur=2");
    exit;
}
$_SESSION['CONNECT'] = 'OK';
$_SESSION['login'] = $login;
header("Location: accueil.php");

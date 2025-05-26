<?php
session_start();
if (!isset($_SESSION['CONNECT']) || $_SESSION['CONNECT'] !== 'OK') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Accueil</title></head>
<body>
<h2>Hello <?= htmlspecialchars($_SESSION['login']) ?></h2>
<a href="validation.php?afaire=deconnexion">Déconnexion</a>
</body>
</html>
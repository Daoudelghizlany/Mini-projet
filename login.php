<?php
$erreur = $_GET['erreur'] ?? '';
$message = '';
if ($erreur == 1) $message = "Veuillez saisir un login et un mot de passe.";
elseif ($erreur == 2) $message = "Erreur de login/mot de passe.";
elseif ($erreur == 3) $message = "Vous avez été déconnecté du service.";
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h2>Connexion</h2>
<p style="color:red"><?= $message ?></p>
<form action="validation.php" method="post">
    <label>Login: <input type="text" name="login"></label><br>
    <label>Mot de passe: <input type="password" name="pass"></label><br>
    <input type="submit" value="Se connecter">
</form>
</body>
</html>
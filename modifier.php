<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM exercice WHERE id = ?");
$stmt->execute([$id]);
$exercice = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $stmt = $pdo->prepare("UPDATE exercice SET titre = ?, auteur = ? WHERE id = ?");
    if ($stmt->execute([$titre, $auteur, $id])) {
        header("Location: index.php");
        exit;
    } else {
        echo "Échec de la modification.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Modifier Exercice</title></head>
<body>
<h2>Modifier Exercice</h2>
<form method="post">
    <label>Titre: <input type="text" name="titre" value="<?= $exercice['titre'] ?>" required></label><br>
    <label>Auteur: <input type="text" name="auteur" value="<?= $exercice['auteur'] ?>" required></label><br>
    <input type="submit" value="Modifier">
</form>
</body>
</html>
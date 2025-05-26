<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $stmt = $pdo->prepare("INSERT INTO exercice (titre, auteur, date_creation) VALUES (?, ?, NOW())");
    $stmt->execute([$titre, $auteur]);
    $message = "Exercice ajouté avec succès.";
}
$exercices = $pdo->query("SELECT * FROM exercice")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Exercices</title>
</head>

<body>
    <h2>Ajouter un exercice</h2>
    <form method="post">
        <label>Titre: <input type="text" name="titre" required></label><br>
        <label>Auteur: <input type="text" name="auteur" required></label><br>
        <input type="submit" value="Ajouter">
    </form>
    <?php if (!empty($message)) echo "<p style='color:green'>$message</p>"; ?>
    <h2>Liste des exercices</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($exercices as $ex): ?>
            <tr>
                <td><?= $ex['id'] ?></td>
                <td><?= $ex['titre'] ?></td>
                <td><?= $ex['auteur'] ?></td>
                <td><?= $ex['date_creation'] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $ex['id'] ?>">Modifier</a> |
                    <a href="supprimer.php?id=<?= $ex['id'] ?>" onclick="return confirm('Supprimer cet exercice ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
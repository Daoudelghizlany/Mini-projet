<!DOCTYPE html>
<html>

<head>
    <title>Générateur de mot de passe</title>
</head>

<body>
    <h2>Générateur de mot de passe</h2>
    <form method="post">
        <label for="length">Longueur du mot de passe:</label>
        <input type="number" name="length" min="6" max="32" value="12" required>
        <input type="submit" name="generate" value="Générer">
    </form>

    <?php
    if (isset($_POST['generate'])) {
        $length = $_POST['length'];
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        echo "<h3>Votre mot de passe: <strong>$password</strong></h3>";
    }
    ?>
</body>

</html>
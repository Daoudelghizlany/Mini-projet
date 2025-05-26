<?php
$errors = [];
$success = false;
$name = $email = $message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if (empty($name)) {
        $errors['name'] = 'Le nom est obligatoire';
    }
    if (empty($email)) {
        $errors['email'] = 'L\'email est obligatoire';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'email n\'est pas valide';
    }

    if (empty($message)) {
        $errors['message'] = 'Le message est obligatoire';
    } elseif (strlen($message) < 10) {
        $errors['message'] = 'Le message doit contenir au moins 10 caractères';
    }
    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .contact-form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        .error {
            color: #d9534f;
            font-size: 0.9em;
            margin-top: 5px;
        }

        button {
            background: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background: #4cae4c;
        }

        .success-message {
            background: #dff0d8;
            color: #3c763d;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .submitted-data {
            background: #e7f3fe;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Contactez-nous</h1>

    <?php if ($success): ?>
        <div class="success-message">
            <p>Merci pour votre message, <?php echo htmlspecialchars($name); ?> !</p>
            <p>Nous vous répondrons dès que possible.</p>
        </div>

        <div class="submitted-data">
            <h3>Récapitulatif de votre message :</h3>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Message :</strong></p>
            <p><?php echo nl2br(htmlspecialchars($message)); ?></p>
        </div>
        <p><a href="contact.php">Envoyer un nouveau message</a></p>
    <?php else: ?>
        <div class="contact-form">
            <form method="post" novalidate>
                <div class="form-group">
                    <label for="name">Votre nom :</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <?php if (isset($errors['name'])): ?>
                        <span class="error"><?php echo $errors['name']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Votre email :</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <?php if (isset($errors['email'])): ?>
                        <span class="error"><?php echo $errors['email']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="message">Votre message :</label>
                    <textarea id="message" name="message"><?php echo htmlspecialchars($message); ?></textarea>
                    <?php if (isset($errors['message'])): ?>
                        <span class="error"><?php echo $errors['message']; ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit">Envoyer le message</button>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>
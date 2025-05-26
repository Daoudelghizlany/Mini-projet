<?php
$guestbookFile = 'guestbook.txt';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);
    if (!empty($name) && !empty($message)) {
        $date = date('d/m/Y H:i:s');
        $entry = [
            'date' => $date,
            'name' => htmlspecialchars($name, ENT_QUOTES),
            'message' => htmlspecialchars($message, ENT_QUOTES)
        ];
        file_put_contents($guestbookFile, serialize($entry) . PHP_EOL, FILE_APPEND);
    }
}
$entries = [];
if (file_exists($guestbookFile)) {
    $lines = file($guestbookFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $entries[] = unserialize($line);
    }
    usort($entries, function ($a, $b) {
        $dateA = DateTime::createFromFormat('d/m/Y H:i:s', $a['date']);
        $dateB = DateTime::createFromFormat('d/m/Y H:i:s', $b['date']);
        return $dateB <=> $dateA;
    });
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .guestbook-form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
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
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        .entry {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .entry:last-child {
            border-bottom: none;
        }

        .entry-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #666;
        }

        .entry-name {
            font-weight: bold;
            color: #333;
        }

        .entry-date {
            font-style: italic;
            font-size: 0.9em;
        }

        .entry-message {
            white-space: pre-wrap;
        }

        .no-entries {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h1>Livre d'or</h1>

    <div class="guestbook-form">
        <h2>Laissez un message</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Votre nom:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="message">Votre message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit" name="submit">Envoyer</button>
        </form>
    </div>

    <div class="guestbook-entries">
        <h2>Messages</h2>

        <?php if (!empty($entries)): ?>
            <?php foreach ($entries as $entry): ?>
                <div class="entry">
                    <div class="entry-header">
                        <span class="entry-name"><?= $entry['name'] ?></span>
                        <span class="entry-date"><?= $entry['date'] ?></span>
                    </div>
                    <div class="entry-message"><?= nl2br($entry['message']) ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-entries">Aucun message pour le moment. Soyez le premier à signer notre livre d'or !</div>
        <?php endif; ?>
    </div>
</body>

</html>
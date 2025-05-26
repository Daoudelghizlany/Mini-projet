<?php
$questions = [
    [
        'question' => "Quelle est la capitale de la France?",
        'options' => ["Londres", "Berlin", "Paris", "Madrid"],
        'answer' => 2,
        'explication' => "Paris est la capitale de la France depuis le 6ème siècle."
    ],
    [
        'question' => "Combien font 5 × 7?",
        'options' => ["25", "30", "35", "40"],
        'answer' => 2,
        'explication' => "5 × 7 = 35 (table de multiplication)"
    ],
    [
        'question' => "Quel langage est principalement utilisé pour le développement web côté serveur?",
        'options' => ["HTML", "CSS", "JavaScript", "PHP"],
        'answer' => 3,
        'explication' => "PHP est un langage de script côté serveur."
    ],
    [
        'question' => "Quelle année a vu le premier pas sur la Lune?",
        'options' => ["1965", "1969", "1972", "1975"],
        'answer' => 1,
        'explication' => "Neil Armstrong a marché sur la Lune le 21 juillet 1969."
    ],
    [
        'question' => "Quel est le plus grand océan du monde?",
        'options' => ["Atlantique", "Indien", "Arctique", "Pacifique"],
        'answer' => 3,
        'explication' => "L'océan Pacifique couvre environ 1/3 de la surface terrestre."
    ]
];
$score = 0;
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($questions as $i => $question) {
        $userAnswer = $_POST['q' . $i] ?? null;
        $isCorrect = ($userAnswer == $question['answer']);

        if ($isCorrect) {
            $score++;
        }

        $results[] = [
            'question' => $question['question'],
            'user_answer' => $question['options'][$userAnswer] ?? "Aucune réponse",
            'correct_answer' => $question['options'][$question['answer']],
            'is_correct' => $isCorrect,
            'explication' => $question['explication']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }

        h1,
        h2 {
            color: #2c3e50;
            text-align: center;
        }

        .quiz-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .question {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .question:last-child {
            border-bottom: none;
        }

        .options {
            margin-left: 20px;
        }

        .option {
            margin: 8px 0;
        }

        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            display: block;
            margin: 20px auto;
        }

        button:hover {
            background: #2980b9;
        }

        .result {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .correct {
            background: #d4edda;
            border-left: 5px solid #28a745;
        }

        .incorrect {
            background: #f8d7da;
            border-left: 5px solid #dc3545;
        }

        .score {
            text-align: center;
            font-size: 1.2em;
            margin: 20px 0;
            padding: 10px;
            background: #e2e3e5;
            border-radius: 4px;
        }

        .explication {
            font-style: italic;
            color: #6c757d;
            margin-top: 10px;
        }

        .restart {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h1>Mini Quiz Culture Générale</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
        <form method="post">
            <div class="quiz-container">
                <?php foreach ($questions as $i => $question): ?>
                    <div class="question">
                        <h3>Question <?= $i + 1 ?>: <?= $question['question'] ?></h3>
                        <div class="options">
                            <?php foreach ($question['options'] as $j => $option): ?>
                                <div class="option">
                                    <input type="radio" id="q<?= $i ?>-<?= $j ?>" name="q<?= $i ?>" value="<?= $j ?>" required>
                                    <label for="q<?= $i ?>-<?= $j ?>"><?= $option ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit">Valider le quiz</button>
        </form>
    <?php else: ?>
        <div class="score">
            Votre score: <strong><?= $score ?> / <?= count($questions) ?></strong>
        </div>

        <div class="quiz-container">
            <h2>Résultats détaillés</h2>

            <?php foreach ($results as $i => $result): ?>
                <div class="result <?= $result['is_correct'] ? 'correct' : 'incorrect' ?>">
                    <h3>Question <?= $i + 1 ?>: <?= $result['question'] ?></h3>
                    <p>Votre réponse: <?= $result['user_answer'] ?></p>
                    <p>Réponse correcte: <?= $result['correct_answer'] ?></p>
                    <div class="explication"><?= $result['explication'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="restart">
            <a href="quiz.php"><button>Recommencer le quiz</button></a>
        </div>
    <?php endif; ?>
</body>

</html>
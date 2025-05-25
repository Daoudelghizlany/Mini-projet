<!DOCTYPE html>
<html>

<head>
    <title>Calculatrice PHP</title>
</head>

<body>
    <h2>Calculatrice</h2>
    <form method="post">
        <input type="number" name="num1" required>
        <select name="operation">
            <option value="add">Addition (+)</option>
            <option value="sub">Soustraction (-)</option>
            <option value="mul">Multiplication (*)</option>
            <option value="div">Division (/)</option>
        </select>
        <input type="number" name="num2" required>
        <input type="submit" name="calculate" value="Calculer">
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = 0;

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'sub':
                $result = $num1 - $num2;
                break;
            case 'mul':
                $result = $num1 * $num2;
                break;
            case 'div':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    echo "<p>Erreur: Division par zéro!</p>";
                    return;
                }
                break;
        }

        echo "<h3>Résultat: $result</h3>";
    }
    ?>
</body>

</html>
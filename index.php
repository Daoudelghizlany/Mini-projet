
<?php
echo "hello ". $_GET['nom'];
echo "<br>";
echo " how are you ?".$_GET['prenom']; 
echo "<br>";
echo " merci pour votre message : ".$_GET['message'];
echo "<br>";
echo "votre email est ".$_GET['email'];
?>
<Br>
<Br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="GET" >
    nom : <input type="text" name="nom"> <br>
    prnom: <input type="text" name="prenom"> <br>
    E-mail : <input type="email" name="email"> <br>
    <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
        <input type="submit" value="envoyer">

</body>

</html>

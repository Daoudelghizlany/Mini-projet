<?php
           
            $civilite = isset($_POST['civilite']) ? $_POST['civilite'] : '';
            $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
            $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
            $annee_naissance = isset($_POST['annee_naissance']) ? intval($_POST['annee_naissance']) : 0;
            $identifiant = isset($_POST['identifiant']) ? htmlspecialchars($_POST['identifiant']) : '';
            $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
            $debutant = isset($_POST['debutant']) ? 'Oui' : 'Non';
            
            $age = date('Y') - $annee_naissance;
            
            echo "<h2>Résultats :</h2>";
            echo "<p><strong>Civilité :</strong> $civilite</p>";
            echo "<p><strong>Nom :</strong> $nom</p>";
            echo "<p><strong>Prénom :</strong> $prenom</p>";
            echo "<p><strong>Âge :</strong> $age ans</p>";
            echo "<p><strong>Identifiant :</strong> $identifiant</p>";
            echo "<p><strong>Mot de passe :</strong> ********</p>"; 
            echo "<p><strong>Débutant en PHP :</strong> $debutant</p>";

            echo "<hr>";

?>

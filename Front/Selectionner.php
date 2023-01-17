<?php
// On démarre la session
session_start (); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Détail</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    <body>
        <h1>Description</h1>
        <br>
    
        <?php include("nav2.php");
        // Récupérez l'ID du CD à partir de la superglobale $_GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {

            // ID du CD choisi
            $cd_id = $_GET['id'];

            // Connexion a la base de données
            $bdd = "cetchepar001_bd";
            $host = "lakartxela.iutbayonne.univ-pau.fr";
            $user = "cetchepar001_bd";
            $pass = "cetchepar001_bd";
            $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la BDD");


            // Récupération des CDs de la base de données
            $query = "SELECT * FROM cd WHERE id = $cd_id";
            $result = mysqli_query($link, $query);

            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $pochette = $row['pochette'];
                $titre = $row['titre'];
                $auteur = $row['auteur'];
                $prix = $row['prix'];
                $description = $row['description'];
                echo "<div class = selection>";
                echo "<img src='../$pochette'>";
                echo "<p>Cet album s'appelle : $titre</p>";
                echo "<p>Il a été fait par : $auteur</p>";
                echo "<p>Vendu au prix de : $prix €</p>";
                echo "Description : $description";
                echo "</div>";
            }

            // Fermeture de la connexion à la base de données
            mysqli_close($link);
        }
        
        
        ?>
        </body>
</html>
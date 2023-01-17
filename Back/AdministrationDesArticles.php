<?php
// On démarre la session
session_start (); 
?>
<!DOCTYPE html>
<html>

<head>
    <title>AdministrationDesArticles</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cours.css">
</head>

<body>
    <h1>Gérer les albums</h1>
    <br>
    <h3>Ajouter un nouvel album</h3>
    <?php include("../Front/nav2.php");?>
    <form action='AdministrationDesArticles.php' method='post' enctype="multipart/form-data">
            Pochette (jpg) : <input type="file" name="pochette">
            <br>
            Titre : <input type="text" maxlength="255" name="titre">
            <br>
            Auteur : <input type="text" maxlength="255"name="auteur">
            <br>
            Prix : <input type="number" maxlength="255" name="prix">
            <br>
            Description: <input type="text"  maxlength="1000" name="description">
            <br>
            <input type="submit" value="Ajouter">
        </form>
    <br>
    <?php


    // Vérification qu'une session existe 
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

    // Connexion a la base de données
        $bdd = "cetchepar001_bd";
        $host = "lakartxela.iutbayonne.univ-pau.fr";
        $user = "cetchepar001_bd";
        $pass = "cetchepar001_bd";
        $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la BDD");

        // Table de la BDD traité
        $nomtable = "cd";


        // Supprimer un article
        if (isset($_POST['supprimer'])) {
            // Récupérez les données nécessaires pour identifier la ligne à supprimer
            $id = $_POST['supprimer'];

            $query = "DELETE FROM $nomtable WHERE id= '$id'";

            $result = mysqli_query($link, $query);
        }


        // Ajouter un article

            if (isset($_FILES['pochette']) && isset($_POST['titre']) && isset($_POST['auteur']) && isset($_POST['prix']) && isset($_POST['description'])) {


            // Récupération du nom du fichier
            $file_name = $_FILES['pochette']['name'];
            // Récupération du chemin temporaire de l'image sur le serveur
            $tmp_name = $_FILES['pochette']['tmp_name'];
            // Définission du chemin où on souhaite enregistrer l'image
            $upload_dir = '../img/'.$_FILES['pochette']['name'];
            // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
            move_uploaded_file($tmp_name, $upload_dir);

            // Récupération des informations du formulaire
            $CheminPochette = "img/" .$file_name;
            $AjouterPochette = $_FILES['pochette'];
            $AjouterTitre = $_POST['titre'];
            $AjouterAuteur = $_POST['auteur'];
            $AjouterPrix = $_POST['prix'];
            $AjouterDescription = $_POST['description'];


            // Vérifier si les champs sont remplis
            if (empty($CheminPochette) || $CheminPochette =="img/"  || empty( $AjouterTitre) || empty($AjouterAuteur) || empty($AjouterPrix) || empty($AjouterDescription)) {
                // Afficher un message d'erreur
                $error_msg = "Erreur dans l'ajout, tous les champs doivent être remplis.";
                echo $error_msg;
                echo "<br><br><br>";
            }
            
            // Si les champs sont remplis, vérifier que le titre du cd n'existe pas déjà
            else {

    
                $queryVerif = "SELECT * FROM cd WHERE titre='$AjouterTitre'";
                $result = mysqli_query($link, $queryVerif);
                if (mysqli_num_rows($result) > 0) {
                    // Le CD est déjà présent dans la base de données, affichage d'un message d'erreur
                    echo "Cet album est déjà présent, veuillez en choisir un autre.";
                    echo "<br><br><br>";
                } else {
                    // Le CD n'est pas présent dans la base de données, insertion
                    $query = "INSERT INTO $nomtable (pochette, titre, auteur, prix, description) VALUES (' $CheminPochette', '$AjouterTitre', '$AjouterAuteur',$AjouterPrix, '$AjouterDescription')";
                    $result = mysqli_query($link, $query);
                }
                
            } 
            
           
                
        }


        
        // Récupération des CDs de la base de données
        $query = "SELECT * FROM cd";
        $result = mysqli_query($link, $query);

        // Afficher la liste des cd
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $pochette = $row['pochette'];
            $titre = $row['titre'];
            $auteur = $row['auteur'];
            $prix = $row['prix'];
            echo "<p>Pochette de l'album :</p>"; 
            echo "<div class = selection>";
            echo "<a href='../Front/Selectionner.php?id=$id'><img src='../Back/Vignetos.php?pochette=$pochette'></a>"; // Affichage des CDs sous forme de vignettes
            echo "<p>Titre : $titre</p>";
            echo "<p>Auteur : $auteur</p>";
            echo "<p>Prix : $prix €</p>";
            echo "<form action='AdministrationDesArticles.php' method='post'><button type='submit' name='supprimer' value='$id'>Supprimer cet album</button></form>";
            echo "<br><br>";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($link);

    } else {
        echo "Vous n'êtes pas connecté !";
    }

    ?>


</body>

</html>
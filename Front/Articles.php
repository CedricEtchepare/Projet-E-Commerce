<?php
// On démarre la session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Articles</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cours.css">
</head>

<body>
    <h1>Faites votre choix parmis les meilleurs albums de tous les temps</h1>
    <br>
    <?php
    include("../Front/nav2.php");

    // Connexion a la base de données
    $bdd = "cetchepar001_bd";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "cetchepar001_bd";
    $pass = "cetchepar001_bd";
    $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la BDD");

    // Table de la BDD traité
    $nomtable = "cd";


    if (isset($_POST['AjouterPanier'])) {
        // Vérifier que le panier existe
        if (!isset($_SESSION['panier'])) {
            // S'il n'existe pas, le créer
            $_SESSION['panier'] = array();
        }
        // Ajouter l'article au panier
        $article = array(
            'quantite' => 1,
            'id' => $_POST['id'],
            'pochette' => $_POST['pochette'],
            'titre' => $_POST['titre'],
            'auteur' => $_POST['auteur'],
            'prix' => $_POST['prix']
        );

        // Vérifier si l'article n'existe pas déjà dans le panier 
        $article_exists = false;
            if (isset($_SESSION['panier'][$article['id']])) {
                // L'article existe, mettre à jour la quantité
                $_SESSION['panier'][$article['id']]['quantite'] =$_SESSION['panier'][$article['id']]['quantite']+ $article['quantite'];
                $article_exists = true;
            }

        // S'il n'existe pas, mettre l'article dans le panier 
        else {
            $_SESSION['panier'][$article['id']] = $article;
        }
    }

    // Récupération des CDs de la base de données
    $query = "SELECT * FROM $nomtable";
    $result = mysqli_query($link, $query);

    // Afficher la liste des CDs
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $pochette = $row['pochette'];
        $titre = $row['titre'];
        $auteur = $row['auteur'];
        $prix = $row['prix'];
        echo "<p>Pochette de l'album :</p>";
        echo "<div class = selection>";
        echo "<a href='Selectionner.php?id=$id'><img src='../Back/Vignetos.php?pochette=$pochette'></a>";  // Affichage des CDs sous forme de vignettes
        echo "<p>Titre : $titre</p>";
        echo "<p>Auteur : $auteur</p>";
        echo "<p>Prix : $prix €</p>";
        echo "<form action='Articles.php' method='post'>
                <input type='hidden' name='id' value=$id>
                <input type='hidden' name='pochette' value=$pochette>
                <input type='hidden' name='titre' value='$titre'>
                <input type='hidden' name='auteur' value='$auteur'>
                <input type='hidden' name='prix' value=$prix>
                <button type='submit' name='AjouterPanier' value='ajouter'>Ajouter au panier</button></form>";
        echo "<br><br>";
    }


    // Fermeture de la connexion à la base de données
    mysqli_close($link);
    ?>


</body>

</html>
<?php
// On démarre la session
session_start (); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Site de vente de CD</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    <body>
        <h1>Bienvenue</h1>
    
        <?php include("Front/nav.php");
        if (isset($_SESSION['login']) && ($_SESSION['pwd'])) {
            echo "Vous êtes connecté en tant que " . $_SESSION['login'] . " !";
        } else {
            echo "Vous n'êtes pas connecté";
        }?>
        </body>
</html>
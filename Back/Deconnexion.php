<?php // On démarre la session
session_start ();

// On détruit les variables de notre session
session_unset ();

// On détruit notre session
session_destroy ();?>

<!DOCTYPE html>
<html>
    <head>
        <title>Deconnexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    <body>
        <h1>Vous êtes déconnecté</h1>
        <?php include("../Front/nav2.php");?>
        </body>
</html>
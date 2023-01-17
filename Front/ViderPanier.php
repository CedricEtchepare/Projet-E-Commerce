<?php

// Démarrez une session
session_start();

// Videz le panier stocké dans la session
unset($_SESSION['panier']);

// Redirigez l'utilisateur vers la page du panier
header('Location: Panier.php');

?>
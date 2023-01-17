<?php session_start();

$_SESSION['panier'][$_GET["id"]]["quantite"] = $_GET["quantite"];


?>
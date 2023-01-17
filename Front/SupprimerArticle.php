<?php

// Démarrez une session
session_start();

// Vérifiez si l'identifiant de l'article a été envoyé en utilisant la méthode POST
if (isset($_POST['id'])) {
    // Récupérez l'identifiant de l'article à partir de la requête POST
    $id = $_POST['id'];

    // Récupérez le contenu du panier stocké dans la session
    $panier = $_SESSION['panier'];

    // Supprimez l'article du panier en utilisant la fonction array_filter() de PHP
    $panier = array_filter($panier, function ($item) use ($id) {
        return $item['id'] !== $id;
    });

    // Mettez à jour le panier stocké dans la session
    $_SESSION['panier'] = $panier;
}

// Redirigez l'utilisateur vers la page du panier
header('Location: panier.php');

?>
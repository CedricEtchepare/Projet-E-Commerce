<?php

if (isset($_GET['pochette'])){
    $largeur = 200;
    $hauteur = 200;
    $url_image = "../".$_GET['pochette'];
    $image = imagecreatefromjpeg($url_image);
    // Obtenir les dimensions de l'image de base
    $largeurImage = imagesx($image);
    $hauteurImage = imagesy($image);

    // Calculer les dimensions de la nouvelle image 
    $ratio = min($largeur / $largeurImage, $hauteur / $hauteurImage);
    $nouvelleLargeur = $largeurImage * $ratio;
    $nouvelleHauteur = $hauteurImage * $ratio;

    // Créer la vignette
    $vignette = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);

    // Redimensionner l'image
    imagecopyresampled($vignette, $image, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $largeurImage, $hauteurImage);

    // Envoyer l'image au navigateur
    header('Content-Type: image/jpeg');
    imagejpeg($vignette);

    imagedestroy($image);
    imagedestroy($vignette);
}



?>
<?php
// On démarre la session
session_start (); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panier</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    <body>

<?php


include("../Front/nav2.php");
// Vérifier si le panier existe dans la session
if (isset($_SESSION['panier'])) {
  // Afficher le contenu du panier dans un tableau
  echo '<h2>Contenu du panier</h2>';
  echo '<br>';
  echo '<table>';
  echo '<tr>';
  echo '<th>Pochette</th>';
  echo '<th>Quantite</th>';
  echo '<th>Titre</th>';
  echo '<th>Auteur</th>';
  echo '<th>Prix</th>';
  echo '<th>Action</th>';
  echo '</tr>';
  $prix=0;
  foreach ($_SESSION['panier'] as $article) {
    echo '<tr>';
    echo "<td><img src='../Back/Vignetos.php?pochette=$article[pochette]'></td>";
    echo '<td>' . '<input type=number id="'.$article["id"].'" onchange=" changerQuantite('.$article["id"].', this.value)" name=prix value="'.$article['quantite'].'">' . '</td>';
    echo '<td>' . $article['titre'] . '</td>';
    echo '<td>' . $article['auteur'] . '</td>';
    echo '<td>' . $article['prix'] . '€</td>';
    $id = $article['id'];
    echo "<td><form method='POST' action='SupprimerArticle.php'><input type='hidden' name='id' value='$id'><button type='submit'>Supprimer</button></form></td>";
    echo '</tr>';
    $prix+=$article['prix']*$article['quantite'];
  }
  echo '</table>';
  echo '<br>';
  echo "<form method='POST' action='ViderPanier.php'><button type='submit'>Vider le panier</button></form>";
  echo '<br><br>';
  echo " Prix totale : $prix €";
  echo '<br><br>';
  echo "<form method='POST' action='Payer.php'><button type='submit'>Valider le paiement</button></form>";
} else {
  // S'il n'y a pas de panier, afficher un message
  echo '<p>Le panier est vide</p>';
}
?>
<script>
  function changerQuantite(id, quantite){

fetch("http://lakartxela.iutbayonne.univ-pau.fr/~afakhfakh/Projet-E-Commerce/Front/modifierPanier.php?id="+id+"&quantite="+quantite)
location.reload() //faire f5
  }
 
</script>
</body>
</html>
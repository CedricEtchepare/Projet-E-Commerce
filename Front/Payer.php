<?php
// On démarre la session
session_start (); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Paiement</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="cours.css">
</head>

<body>
  <?php
  echo "<br/>";
  include("../Front/nav2.php");
  echo "<br/>";
  echo '<h2>Validation du paiement</h2>';
  echo "<form action='Payer.php' method='post'>
  <br>
  Numéro de carte : <input type='text' name='numero'>
  <br>
  <br>
  Nom du titulaire de la carte : <input type='text' name='nom'>
  <br>
  <br>
  Date d'expiration (Année / Mois) : <input type='text' name='date'>
  <br>
  <br>
  CVV : <input type='text' name='cvv'>
  <br>
  <br>
  <input type='submit' value='Payer'>
  </form>";
  if (isset($_POST['numero']) && isset($_POST['nom']) && isset($_POST['date'])) 
  {
    $numero = $_POST["numero"];
    $nom = $_POST["nom"];
    $date = $_POST["date"];
    $cvv = $_POST["cvv"];

    $premier_chiffre = substr($numero, 0, 1);
    $dernier_chiffre = substr($numero, -1);

    $date_du_jour = date("y-m-d");
    $dateDuJourPlus3Mois = date("y/m", strtotime("+3 months", strtotime($date_du_jour)));
    $dateExpiration = date("y/m", strtotime($date));

    if (is_numeric($numero) && strlen($numero) == 16 && $premier_chiffre == $dernier_chiffre && $dateExpiration > $dateDuJourPlus3Mois && is_numeric($cvv) && strlen($cvv) == 3) {
      echo "Paiement validé avec succès !";
      unset($_SESSION['panier']);
    } else {
      echo "Le paiement n'est pas validé, verifiez les coordonnées et reessayer";
    }
  } else 
  ?>
</body>
</html>

<?php
    // On teste si nos variables sont définies
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        // Connexion a la base de données
        $bdd = "cetchepar001_bd";
        $host = "lakartxela.iutbayonne.univ-pau.fr";
        $user = "cetchepar001_bd";
        $pass = "cetchepar001_bd";
        $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la BDD");


        // Table de la BDD traité
        $nomtable = "users";

        // Récupération du nom d'utilisateur saisi par l'utilisateur
        $login_valide = $_POST['login'];

        // Sélection du mot de passe associé au nom d'utilisateur saisi par l'utilisateur
        $query = "SELECT pwd FROM $nomtable WHERE login='$login_valide'";
        $result = mysqli_query($link, $query);
        $resultReq = mysqli_fetch_assoc($result);
        $pwd_valide = $resultReq['pwd'];


        // On vérifie si le nom d'utilisateur et le mot de passe sont valides
        if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
            session_start();
            // On enregistre les paramètres de notre visiteur comme variables session ($login et $pwd) (
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            // On redirige notre visiteur vers l'accueil du site
            header('location: ../index.php');
        } 
        else {
            // On indique a l'utilisateur que le nom d'utilisateur ou mot de passe est invalide
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            //echo '<meta http-equiv="refresh" content="0;URL=login.php">';
            echo "<br><br>Nom d'utilisateur ou mot de passe invalide, veuillez reessayer";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($link);
    }
?>
<html>
    <head>
        <title>Formulaire d'identification</title>
    </head>
    <body>
    <?php include("../Front/nav2.php");?>
        <h1>Formulaire d'identification</h1>
    <br>
        <form action="login.php" method="post">
            Votre nom d'utilisateur : <input type="text" name="login">
            <br><br>
            Votre mot de passe : <input type="password" name="pwd">
            <br><br>
            <input type="submit" value="Connexion">
        </form>
        <br>
        <p>Si vous n'avez pas de compte cliquez ici : <a href="inscription.php">S'inscrire</a></p>

    </body>
</html>
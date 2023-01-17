<?php
    //On teste si nos variables sont définies
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        // Connexion a la base de données
        $bdd = "cetchepar001_bd";
        $host = "lakartxela.iutbayonne.univ-pau.fr";
        $user = "cetchepar001_bd";
        $pass = "cetchepar001_bd";
        $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la BDD");

        // Table de la BDD traité
        $nomtable = "users";

        // Récupération des données du formulaire
        $username = $_POST['login'];
        $password = $_POST['pwd'];

        // Validation des données du formulaire
        if (strlen($username) < 4 || strlen($password) < 4) {
            // Le nom d'utilisateur et/ou le mot de passe sont vide(s) ou trop court(s)
            $error_msg = "Saisissez a nouveau, le nom d'utilisateur et le mot de passe doivent contenir au moins 4 caractères.";
        }

        // Si une erreur s'est produite, affichez un message d'erreur
        if (isset($error_msg)) {
            echo $error_msg;
            exit;
        }

        // Vérifier si l'utilisateur saisi n'est pas déjà présent dans la base de données
        $query = "SELECT * FROM users WHERE login='$username'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            // L'utilisateur est déjà présent dans la base de données, affichage d'un message d'erreur
            echo "Ce nom d'utilisateur est déjà pris, veuillez en choisir un autre.";
        }

        
        // Enregistrer l'utilisateur si ce n'est pas un administratuer
        else if (isset($_POST['login']) && isset($_POST['pwd'])) {
            if (isset($_POST['admin'])) {
                $query = "INSERT INTO $nomtable (login, pwd, admin) VALUES('$username', '$password', 0)";
                $result = mysqli_query($link, $query);
                header('location: login.php');
            }
            else {
                // Création de l'utilisateur dans la base de données
                $query = "INSERT INTO $nomtable (login, pwd, admin) VALUES('$username', '$password', 1)";
                $result = mysqli_query($link, $query);
                header('location: login.php');
            }
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($link);
    }
    ?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulaire d'Inscription</title>
</head>

<body>
    <?php include("../Front/nav2.php");?>
    <h1>Formulaire d'inscription</h1>
    <br>
    <form action="inscription.php" method="post">
        Votre nom d'utilisateur : <input type="text" name="login">
        <br><br>
        Votre mot de passe : <input type="password" name="pwd">
        <br><br>
        Si vous souhaitez un rôle administrateur, cochez cette case <input type="checkbox" id="admin" name="admin" value="1">
        <br><br>
        <input type="submit" value="S'inscrire">
    </form>

</body>

</html>
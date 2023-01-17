<?php
// On démarre la session
//session_start (); 
?>
<!doctype html>

<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Hans McMurdy">
      <title></title>
      <meta name="title" content="#JavaScriptFirst">
      <meta name="description" content="Learn how to code with #JavaScriptFirst: https://github.com/HansUXdev/JavaScript-First">
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <!-- Favicons -->

      <meta name="theme-color" content="#7952b3">
      <style>
         .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
         }
         @media (min-width: 768px) {
            .bd-placeholder-img-lg {
             font-size: 3.5rem;
            }
         }
      </style>
      <style>
            /* Prevent scroll on narrow devices */
            html,body {overflow-x: hidden; }
            body {padding-top: 56px;}
            @media (max-width: 991.98px) {
                .offcanvas-collapse {
                    position: fixed;
                    top: 56px; /* Height of navbar */
                    bottom: 0;
                    left: 100%;
                    width: 100%;
                    padding-right: 1rem;
                    padding-left: 1rem;
                    overflow-y: auto;
                    visibility: hidden;
                    background-color: #343a40;
                    transition: transform .3s ease-in-out, visibility .3s ease-in-out;
                }
                .offcanvas-collapse.open {
                    visibility: visible;
                    transform: translateX(-100%);
                }
            }
            .nav-scroller {
                position: relative;
                z-index: 2;
                height: 2.75rem;
                overflow-y: hidden;
            }
            .nav-scroller .nav {
                display: flex;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                color: rgba(255, 255, 255, .75);
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }
            .nav-underline .nav-link {
                padding-top: .75rem;
                padding-bottom: .75rem;
                font-size: .875rem;
                color: #6c757d;
            }
            .nav-underline .nav-link:hover {color: #007bff;}
            .nav-underline .active {font-weight: 500;color: #343a40;}
            .text-white-50 { color: rgba(255, 255, 255, .5); }
            .bg-purple { background-color: #6f42c1; }
      </style>
   </head>
</html>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title></title>

  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">



  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<body>
    
    <?php
    
    // Vérification qu'une session existe 
    if (isset($_SESSION['login']) && ($_SESSION['pwd'])){
      // Connexion a la base de données
        $bdd = "cetchepar001_bd";
        $host = "lakartxela.iutbayonne.univ-pau.fr";
        $user = "cetchepar001_bd";
        $pass = "cetchepar001_bd";
        $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la BDD");

        // Table de la BDD traité
        $nomtable = "users";

        // Récupération de l'utilisateur actuel 
        $username = $_SESSION['login'];

        // Préparez la requête SQL pour récupérer le login
        $query = "SELECT admin FROM $nomtable WHERE login = '$username'";

        $result = mysqli_query($link, $query);
        $resultReq = mysqli_fetch_assoc($result);

// Vérifiez si l'utilisateur est administrateur (login = 0), non administrateur (login = 1) ou pas connecté (else) et lui afficher ses possibilités de navigation
        if ($resultReq["admin"] == 0) {

            echo "<header>
            <nav class='navbar navbar-expand-lg fixed-top navbar-dark bg-dark'>
            <div class='container-fluid'>
               <a class='navbar-brand' href='../index.php'>CD</a>
               <button class='navbar-toggler p-0 border-0' type='button' data-toggle='offcanvas'>
               </button>
               <div class='navbar-collapse offcanvas-collapse' id='navbarsExampleDefault'>
                  <ul class='navbar-nav mr-auto mb-2 mb-lg-0'>
                     <li class='nav-item'><a class='nav-link' href='./index.php'>Accueil</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Front/Articles.php'>Articles</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Back/AdministrationDesArticles.php'>Administration des articles</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Front/Panier.php'>Panier</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Back/Deconnexion.php'>Se Deconnecter</a></li>
                  </ul>
               </div>
            </div>
         </nav>
        </header>";
        } 
        else if ($resultReq["admin"] == 1) {

            echo "<header>
            <nav class='navbar navbar-expand-lg fixed-top navbar-dark bg-dark'>
            <div class='container-fluid'>
               <a class='navbar-brand' href='../index.php'>CD</a>
               <button class='navbar-toggler p-0 border-0' type='button' data-toggle='offcanvas'>
               </button>
               <div class='navbar-collapse offcanvas-collapse' id='navbarsExampleDefault'>
                  <ul class='navbar-nav mr-auto mb-2 mb-lg-0'>
                     <li class='nav-item'><a class='nav-link' href='./index.php'>Accueil</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Front/Articles.php'>Articles</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Front/Panier.php'>Panier</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Back/Deconnexion.php'>Se Deconnecter</a></li>
                  </ul>
               </div>
            </div>
         </nav>
        </header>";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($link);

        }

        else{

            echo "<header>
            <nav class='navbar navbar-expand-lg fixed-top navbar-dark bg-dark'>
            <div class='container-fluid'>
               <a class='navbar-brand' href='../index.php'>CD</a>
               <button class='navbar-toggler p-0 border-0' type='button' data-toggle='offcanvas'>
               </button>
               <div class='navbar-collapse offcanvas-collapse' id='navbarsExampleDefault'>
                  <ul class='navbar-nav mr-auto mb-2 mb-lg-0'>
                     <li class='nav-item'><a class='nav-link' href='./index.php'>Accueil</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Front/Articles.php'>Articles</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Front/Panier.php'>Panier</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Back/login.php'>Se Connecter</a></li>
                     <li class='nav-item'><a class='nav-link' href='./Back/inscription.php'>S'inscrire</a></li>

                  </ul>
               </div>
            </div>
         </nav>
        </header>";
        }
    ?>

</body>

</html>
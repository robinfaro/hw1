<?php
    require_once('isLogged.php');
    if (!isLogged()){
        header("Location: login.php");
        exit;
    }

?>



<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Paint Your Words</title>
      <link rel="stylesheet" href="home.css"/>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    </head>

    <body>

    <nav id="navigation-bar">

    <img src="./images/logo4.png" id="logo">

      <a href='http://localhost/Homework4/homepage.php'>
        Home
      </a>

      <a href='www.google.com'>
          About us
      </a>

      <a href='http://localhost/Homework4/most-liked-images.php'>
          Trend
      </a>

      <a href='http://localhost/Homework4/profile.php'>
          Profilo
    </a>

      <button>
        <a href='http://localhost/Homework4/logout.php'> LOG OUT </a>
      </button>
    </nav>

    <nav id='mobile-navbar'>
    <a href='http://localhost/Homework4/homepage.php'>
        <img src="images/homeIcon.svg">
      </a>

      <a href='http://localhost/Homework4/most-liked-images.php'>
          <img src="images/standingsIcon.svg">
      </a>

      <a href='http://localhost/Homework4/profile.php'>
          <img src="images/profileIcon.svg">
    </a>

      <button>
        <a href='http://localhost/Homework4/logout.php'> LOG OUT </a>
      </button>
      
    </nav>


    <header>
      <div id="overlay"> </div>
      Bentornato su Paint Your Words,
      <?php
        $conn = mysqli_connect("localhost", "root", "", "PYW");
        $query = "SELECT username FROM UTENTI WHERE email = '".$_SESSION["mail"]."'";
        $res = mysqli_query($conn, $query);
        echo( mysqli_fetch_row($res)[0] );

      ?>
    </header>


    <article id="menu">

      <div class='menu-element'>
        <div class='text-icon'>
        Cerchi ispirazione o vuoi semplicemente ammirare le opere dei tuoi artisti preferiti? <br>
        Prova la nostra funzionalità di ricerca di dipinti, con accesso a più di un milione di <br>
         opere d'arte
        <img src="images/iconReal.png">
        </div>
        <button> <a href='http://localhost/Homework4/paintSearch.php'> PROVA ORA </a></button>  
      </div>

      <div class='menu-element'>
        <div class='text-icon'>
        I dipinti che hai trovato non sono stati abbastanza d'ispirazione? Dai sfogo alla tua <br>
        immaginazione con la nuova funzionalità di generazione di immagini tramite <br>
        intellignza artificiale
        <img src="images/iconAI.png">
        </div>
        <button> <a href='http://localhost/Homework4/imageGeneration.php'> PROVA ORA </a> </button>  
      </div>
    </article>

    </body>








</html>
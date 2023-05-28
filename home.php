<?php
    require_once('isLogged.php');
    if (isLogged()){
        header("Location: homepage.php");
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

      <a href='http://localhost/Homework4/home.php'>
        Home
      </a>

      <a href='http://localhost/Homework4/home.php'>
          About us
      </a>

      <a href='http://localhost/Homework4/login.php'>
          Trend
      </a>

      <a href='www.google.com'>
          Collabora con noi
      </a>

      <a href='http://localhost/Homework4/login.php'>
          Log in
      </a>

      <button>
        <a href='http://localhost/Homework4/signup.php'> REGISTRATI </a>
      </button>
    </nav>


    <nav id='mobile-navbar'>
    <a href='http://localhost/Homework4/homepage.php'>
        <img src="images/homeIcon.svg">
      </a>

      <button>
        <a href='http://localhost/Homework4/login.php'> LOG IN </a>
      </button>

      <button>
        <a href='http://localhost/Homework4/signup.php'> REGISTRATI </a>
      </button>
      
    </nav>



    <header>
      <div id="overlay"> </div>
      BENVENUTO SU PAINT YOUR WORDS!
    </header>


    <article id="menu">

      <div class='menu-element'>
        <div class='text-icon'>
        Cerchi ispirazione o vuoi semplicemente ammirare le opere dei tuoi artisti preferiti? <br>
        Prova la nostra funzionalità di ricerca di dipinti, con accesso a più di un milione di <br>
         opere d'arte
        <img src="images/iconReal.png">
        </div>
        <button> <a href='http://localhost/Homework4/signup.php'> REGISTRATI PER PROVARE </a></button>  
      </div>

      <div class='menu-element'>
        <div class='text-icon'>
        I dipinti che hai trovato non sono stati abbastanza d'ispirazione? Dai sfogo alla tua <br>
        immaginazione con la nuova funzionalità di generazione di immagini tramite <br>
        intellignza artificiale
        <img src="images/iconAI.png">
        </div>
        <button> <a href='http://localhost/Homework4/signup.php'> REGISTRATI PER PROVARE </a> </button>  
      </div>
    </article>

    </body>








</html>
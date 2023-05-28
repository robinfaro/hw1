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
      <title>PYW Profile</title>
      <link rel="stylesheet" href="profile-picture-choice.css"/>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
      <script src="iconClick.js" defer="true"></script>
      <script src="pictureChoice.js" defer="true"></script>

    </head>


    <body>

        <header>
            <img src="images/logo4.png">
            SCEGLI UN AVATAR PER IL TUO PROFILO
        </header>
        
        <section class='choice-grid'>
            <div class='gallery'></div>
        </section>

        <section class='confirm hidden'>
            <button>
                CONFERMA
            </button>
        </section>


    </body>
</html>
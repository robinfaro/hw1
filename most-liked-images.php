<?php
    require_once('isLogged.php');
    if (!isLogged()){
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "PYW") or die(mysqli_connect_error());

?>


<html>
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PYW Trends</title>
      <link rel="stylesheet" href="profile.css"/>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
      <script src="iconClick.js" defer="true"></script>
      <script src="trend.js" defer="true"></script>

    </head>

    <body>
    <header>
         <img src="images/logo4.png">
    </header>

    <section class='most-liked-paintings'>
        <div class='gallery'></div>
    </section>

    

    </body>

</html>
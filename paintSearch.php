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
      <link rel="stylesheet" href="research.css"/>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
      <script src="paintSearch.js" defer="true"></script>
      <script src="iconClick.js" defer="true"></script>

 </head>

 <body>
    <header>
         <img src="images/logo4.png">
    </header>
        <form>
            <input type="text" id='content'>
            <input type="submit" value='Cerca' id='search'>
        </form>

        <div class='gallery' class='hidden'>

        </div>


    </body>


</html>
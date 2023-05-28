<?php
    require_once('isLogged.php');
    if (!isLogged()){
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "PYW");

?>


<html>
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PYW Profile</title>
      <link rel="stylesheet" href="profile.css"/>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
      <script src="iconClick.js" defer="true"></script>
      <script src="profile.js" defer="true"></script>

    </head>

    <body>
    <header>
         <img src="images/logo4.png">
    </header>


    <section class='profile-info'>
        <?php
            $mail = mysqli_real_escape_string($conn, $_SESSION["mail"]);
            $query = "SELECT * FROM UTENTI WHERE email = '".$mail."'";
            $res = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($res);
            $pic = $row['picture'];
            $username = $row['username'];
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            echo("<div class='profile-pic'> <img src='" .$pic. "' class='pic'> <button class='modify'> <img src= 'images/modifyPic.png'> </button> </div>");
            // echo("<div class='info-container' <span> Username: " .$username.  "</span>  <span> Nome: " .$nome.  "</span> 
            // <span> Cognome:"  .$cognome.  "</span> </div>");

            echo("<div class='info-container'> <span> Username: " .$username.  "</span> <span> Nome: " .$nome.  "</span>
            <span> Cognome: "  .$cognome.  "</span> </div>");
        ?>
    </section>

    <section class='liked-paintings'>
        <button class='showImage'>
        MOSTRA LE IMMAGINI CHE TI SONO PIACIUTE
        </button>
        <div class='gallery'></div>
    </section>
    

    </body>

</html>
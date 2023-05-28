<?php
    require_once('isLogged.php');
    if (isLogged()){
        header("Location: login.php");
        exit;
    }
    require_once("checkPassword.php");

    $conn = mysqli_connect("localhost", "root", "", "PYW");

    $error = null;


    if(isset($_POST["nome"]) && isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["username"]))
    {
        $query = "SELECT * FROM UTENTI WHERE email = '".$_POST["mail"]."'";
        $res = mysqli_query($conn, $query);

        if( mysqli_num_rows($res) != 0){
            $error = "Email già in uso!";
        }
        else{

            $query = "SELECT * FROM UTENTI WHERE username = '".$_POST["username"]."'";
            $res = mysqli_query($conn, $query);
    
            if( mysqli_num_rows($res) != 0){
                $error = "Username già in uso!";
            }

            else{

                //verifica password
                if( !checkPassword($_POST["password"])){
                    $error = "Password non valida! Assicurati siano presenti una maiuscola ed un numero, e che 
                    la lunghezza sia almeno di 8 caratteri";
                }
                else{
                    $hash_psw = password_hash($_POST["password"], PASSWORD_BCRYPT);

                    $insert_query = "INSERT INTO UTENTI VALUES ('" . mysqli_real_escape_string($conn, $_POST["nome"]) . "', 
                    '" . mysqli_real_escape_string($conn, $_POST["cognome"]) . "', '" . mysqli_real_escape_string($conn, $_POST["mail"]) . "', 
                    '" . mysqli_real_escape_string($conn, $_POST["username"]) . "', 'images/default_pfp.png',
                    '" . mysqli_real_escape_string($conn, $hash_psw) . "')";

                    mysqli_query($conn, $insert_query);

                    session_start();
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["mail"] = $_POST["mail"];

                    header("Location: homepage.php");
                    exit;
                }
            }

        }


    }

?>




<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Paint Your Words</title>
      <link rel="stylesheet" href="signup-login.css"/>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
      <script src="iconClick.js" defer="true"></script>
      <script src="signup.js" defer="true"></script>
    </head>

    <?php
        
    ?>

    <body>
        <header>
         <img src="images/logo4.png">
        </header>


        <div class="form-box">
        <form class="form" name="signup" method="post">
         <span class="title">Registrati</span>
            <span class="subtitle">Registrati gratuitamente a PYW</span>
            <div class="form-container">
                <input type="text" class="input" placeholder="Nome" name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                <input type="text" class="input" placeholder="Cognome" name="cognome" <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?> >
		        <input type="email" class="input" placeholder="Email" name="mail" <?php if(isset($_POST["mail"])){echo "value=".$_POST["mail"];} ?>>
                <input type="text" class="input" placeholder="Username" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
		        <input type="password" class="input" placeholder="Password" name="password">
            </div>
            <input type= 'submit' value='Registrati' id= 'submitButton'> 
        </form>
        <div class="form-section">
            <p>Hai già un account? <a href="http://localhost/Homework4/login.php">Log in</a> </p>
        </div>
        </div>

        <section class='errorBox'>
            <div id='error-mail'class='hidden'> <img src='images/error.png'> Email già in uso</div>    
            <div id='error-username' class='hidden'> <img src='images/error.png'> Username già in uso</div> 
            <div id='error-password' class='hidden'> <img src='images/error.png'> Password non valida</div>    
            <div id='error-comp' class='hidden'> <img src='images/error.png'> Compila tutti i campi</div>    
        </section>

        <?php
            if($error !== null){
                    echo ("<div class='error'> <img src='images/error.png'>" .$error ."</div>");
            }
        ?>
        
    </body>
</html>
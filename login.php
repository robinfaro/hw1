<?php
    require_once("checkPassword.php");
    require_once("isLogged.php");

    if (isLogged()){
        header("Location: homepage.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "PYW");


    if(isset($_POST["mail"]) && isset($_POST["password"]))
    {
        $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
        $query = "SELECT psw FROM UTENTI WHERE email = '".$mail."'";
        $res = mysqli_query($conn, $query);

        if( mysqli_num_rows($res) == 0){
            $error = "Credenziali non corrette";
        }
        else{
            $realPsw = mysqli_fetch_row($res)[0];
            if(!password_verify($_POST["password"], $realPsw)){
                $error = "Credenziali non corrette";
            }
            else{
                session_start();
                $_SESSION["mail"] = $_POST["mail"];
                header("Location: homepage.php");
                exit;
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
    </head>

    <?php
        
    ?>

    <body>
        <header>
         <img src="images/logo4.png">
        </header>

        <div class="form-box">
        <form class="form" name="login" method="post">
         <span class="title">Accedi</span>
            <span class="subtitle">Accedi per sfruttare le nostre funzionalità</span>
            <div class="form-container">
		        <input type="email" class="input" placeholder="Email" name="mail">
		        <input type="password" class="input" placeholder="Password" name="password">
            </div>
            <input type= 'submit' value='Accedi' id= 'submitButton'> 
        </form>
        <div class="form-section">
            <p>Hai dimenticato la tua password?  <a href="">Clicca qui</a> </p>
        </div>
        </div>

        <?php
            if(isset($error)){
                
                echo ("<div class='error'> <img src='images/error.png'>" .$error ."</div>");
            }
        ?>

        
    </body>
</html>
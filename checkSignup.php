<?php

    $conn = mysqli_connect("localhost", "root", "", "PYW") or die(mysqli_connect_error());


    if(isset($_GET['input']) && isset($_GET['type'])){
        if($_GET['type'] == 'username'){
            $error['ok'] = true;
            $query = "SELECT * FROM UTENTI WHERE username = '".mysqli_real_escape_string($conn, $_GET["input"])."'";
            $res = mysqli_query($conn, $query);

            if( mysqli_num_rows($res) > 0){
                $error['ok'] = false;

            }

            echo json_encode($error);
        }

        if($_GET['type'] == 'mail'){
            $error['ok'] = true;
            $query = "SELECT * FROM UTENTI WHERE email = '".mysqli_real_escape_string($conn, $_GET["input"])."'";
            $res = mysqli_query($conn, $query);

            if( mysqli_num_rows($res) > 0){
                $error['ok'] = false;

            }

            echo json_encode($error);
        }

    }



?>
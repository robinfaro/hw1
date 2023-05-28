<?php
    require_once('isLogged.php');
    if (!isLogged()){
        header("Location: login.php");
        exit;
    }



    if($_GET['action'] == 'search'){
        $directory = 'images/avatar';
        $images = scandir($directory);
        $avatars = array();

        foreach($images as $img){

            if (pathinfo($img, PATHINFO_EXTENSION) === 'svg') {
                $avatars[] = $directory .'/' .$img;
            }

        }

        echo json_encode($avatars);
    }

    if($_GET['action'] = 'set' && isset($_GET['input'])){
        $conn = mysqli_connect("localhost", "root", "", "PYW") or die(mysqli_connect_error());

        $query = "UPDATE UTENTI SET picture = '" . $_GET['input'] . "' WHERE email = '" . $_SESSION['mail'] . "'";

        echo $query;
        $res = mysqli_query($conn, $query);
    }

?>
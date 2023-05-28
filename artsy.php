<?php
    session_start();
    if (!isset($_SESSION["mail"])){
        header("Location: login.php");
        exit;
    }

    if(isset($_GET['offset'])){
        $offset = $_GET['offset'];
    }
    else{
        $offset = 0;
    }

    $conn = mysqli_connect("localhost", "root", "", "PYW") or die(mysqli_connect_error());


    $client_id = '90e281c84d8eb136b772';
    $client_secret = '76228367e1a2c55343ab74d33d5b08ee';

    $dati = array("client_id" => $client_id, "client_secret" => $client_secret);
    $dati = http_build_query($dati);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.artsy.net/api/tokens/xapp_token");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $dati);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $headers = array("'Content-Type: application/x-www-form-urlencoded");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($curl));
    $token = $result->token;


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.artsy.net/api/search?q=" .$_GET['input'] ."&offset=" .$offset   ."&type=artwork");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $headers = array("X-XAPP-Token: " .$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($curl);

    $resultArray = json_decode($result, true);

    foreach($resultArray['_embedded']['results'] as &$artwork){
        $query = "SELECT * FROM likes WHERE mail = '" . $_SESSION['mail'] . "' AND url = '" . $artwork['_links']['thumbnail']['href'] . "'";
        $res = mysqli_query($conn, $query);

        if( mysqli_num_rows($res) != 0){
            $artwork['isLiked'] = true;
        }
        else{
            $artwork['isLiked'] = false;
        }

    }

    echo json_encode($resultArray);








?>
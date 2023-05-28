<?php

    session_start();
    if (!isset($_SESSION["mail"])){
        header("Location: login.php");
        exit;
    }    

    $api_key = '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';

    $conn = mysqli_connect("localhost", "root", "", "PYW") or die(mysqli_connect_error());


     if(isset($_GET['input'])){

         $input = $_GET['input'];

        $dati = json_encode(array("prompt" => $input));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.openai.com/v1/images/generations");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $dati);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $headers = array("Content-Type: application/json", "Authorization: Bearer " .$api_key);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);

        $resultArray = json_decode($result, true);

        $imageUrl = $resultArray['data'][0]['url'];

        // Ottieni il contenuto dell'immagine come dati binari
        $imageData = file_get_contents($imageUrl);

        // Salva l'immagine sul server
        $nome = md5($imageUrl);
        $file = 'liked_ai_generated_images/' .$nome.  '.png'; // Specifica il percorso e il nome del file sul tuo server
        file_put_contents($file, $imageData);

        $resultArray['data'][0]['url'] = $file;

        $query = "SELECT * FROM likes WHERE mail = '" . $_SESSION['mail'] . "' AND url = '" . $imageUrl . "'";
        $res = mysqli_query($conn, $query);

        if( mysqli_num_rows($res) != 0){
            $resultArray['isLiked'] = true;
        }
        else{
            $resultArray['isLiked'] = false;
        }

        $resultArray['title'] = $_GET['input'];

    

        echo json_encode($resultArray);
    }

?>
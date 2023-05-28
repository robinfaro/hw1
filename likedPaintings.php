<?php
    require_once('isLogged.php');
    if (!isLogged()){
        header("Location: login.php");
        exit;
    }
    $conn = mysqli_connect("localhost", "root", "", "PYW") or die(mysqli_connect_error());

    if(isset($_POST['action'])){

        if($_POST['action'] == 'add'){

            $insert_query = "INSERT INTO likes (mail, url, title) values ( '".$_SESSION["mail"]."','".$_POST["url"]."','".$_POST["title"]."')";
            $res = mysqli_query($conn, $insert_query);
        }

        if($_POST['action'] == 'delete'){
            $insert_query = "delete from likes where(mail= '".$_SESSION["mail"]."'and url='".$_POST["url"]."')";
            $res = mysqli_query($conn, $insert_query);
        }

        if($_POST['action'] == 'search'){
            $query = "SELECT url, title from likes where(mail= '".$_SESSION["mail"]."')";

            $res = mysqli_query($conn, $query);

            $likes = array();

            $i = 0;
            while($row = mysqli_fetch_assoc($res)){
                $likes[] = $row;
            }


            echo json_encode($likes);
        }

        if($_POST['action'] == 'top'){
            $query = "SELECT distinct tl.*, l.title from totalLikes tl JOIN likes l ON tl.url = l.url where total_likes != 0 order by total_likes DESC";

            $res = mysqli_query($conn, $query);

            $likes = array();

            while($row = mysqli_fetch_assoc($res)){
                $query = "select * from likes where (mail= '" .$_SESSION["mail"] ."' and url = '" .$row['url'] ."')";
                $liked = mysqli_query($conn, $query);

                if( mysqli_num_rows($liked) != 0){
                    $row['isLiked'] = true;
                }
                else{
                    $row['isLiked'] = false;
                }
            
                $likes[] = $row;
            }

            


            echo json_encode($likes);
        }

        
    }



?>
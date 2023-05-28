<?php

    function isLogged(){
        session_start();
        return isset($_SESSION['mail']);
    }
?>
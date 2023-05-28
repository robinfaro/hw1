<?php

function checkPassword($password) {
    // Verifica la lunghezza minima
    if (strlen($password) < 8) {
        return false;
    }

    // Verifica la presenza di almeno una lettera maiuscola
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Verifica la presenza di almeno un numero
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    // La password soddisfa tutti i requisiti
    return true;
}

?>
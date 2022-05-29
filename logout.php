<?php
    include 'dbconfig.php';

    #DISTRUGGO LA SESSIONE CHE GIA' ESISTE.
    session_start();
    session_destroy();

    /*
        SE GIA' SONO STATI SETTATI DEI COOKIE ALLORA ELIMINO ANCHE QUELLI, DUNQUE LEGGO
        I DATI DEI COOKI CHE SINI STATI SETTATI E RICERCO I COOKIE DELL'UTENTE ALL'INTERNO 
        DEL DATABASE. SE TROVO UNA CORRISPONDENZA ALLORA VERIFICO CHE IL TOKEN DEL CLIENT SIA ANCORA VALIDO.
        IN FINE ELIMINO SIA DAL DATABASE CHE DAL COOKIE.
    */

    if (isset($_COOKIE['_applenet_user_id']) && isset($_COOKIE['_applenet_token']) && isset($_COOKIE['_applenet_cookie_id'])) { 
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $cookieid = mysqli_real_escape_string($conn, $_COOKIE['_applenet_cookie_id']);
        $userid = mysqli_real_escape_string($conn, $_COOKIE['_applenet_user_id']);
        $res = mysqli_query($conn, "SELECT id, hash FROM cookies WHERE id = $cookieid AND user = $userid");
        if ($cookie = mysqli_fetch_assoc($res)) { 
            if (password_verify($_COOKIE['_applenet_token'], $cookie['hash'])) {
                mysqli_query($conn, "DELETE FROM cookies WHERE id = $cookieid");
                mysqli_close($conn);
                setcookie('_applenet_user_id', '');
                setcookie('_applenet_cookie_id', '');
                setcookie('_applenet_token', '');
            }
        }
        mysqli_close($conn);
    }
    header('Location: login.php');
?>
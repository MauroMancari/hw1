<?php
    /*
        CONTROLLO CHE L'UTENTE SUA GIA' AUTENTICATO IN MODO TALE CHE,
        NON DEVO RICHIEDERE IL LOGIN OGNI VOLTA.
    */
    require_once 'dbconfig.php';
    session_start();

    function checkAuth() {
        #UTILIZZO GLOBAL PER POTER ESSERE LETTA ANCHE ALL'ESTERNO DELLA FUNZIONE CHECKAUTH().
        GLOBAL $dbconfig;
        if(!isset($_SESSION['_applenet_user_id'])) {
            if (isset($_COOKIE['_applenet_user_id']) && isset($_COOKIE['_applenet_token']) && isset($_COOKIE['_applenet_cookie_id'])) { 
                $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
                $cookieid = mysqli_real_escape_string($conn, $_COOKIE['_applenet_cookie_id']);
                $userid = mysqli_real_escape_string($conn, $_COOKIE['_applenet_user_id']);
                #PRENDO IL COOKIE CHE CORRISPONDE ALL'ID.
                $res = mysqli_query($conn, "SELECT * FROM cookies WHERE id = $cookieid AND user = $userid");
                if ($cookie = mysqli_fetch_assoc($res)) {
                    #FACCIO UN CONTROLLO, SE E' SCADUTO ALLORA LO ELIMINO, ALTRIMENTI FACCIO IL CONTROLLO PER VERIFICARE SE IL TOKEN E' VALIDO.
                    if(time() > $cookie['expires']) {
                        mysqli_query($conn, "DELETE FROM cookies WHERE id = ".$cookie['id']) or die(mysqli_error($conn));
                        header('Location: logout.php');
                        exit;
                    } else if (password_verify($_COOKIE['_applenet_token'], $cookie['hash'])) {
                        $_SESSION['_applenet_user_id'] = $_COOKIE['_applenet_user_id'];
                        mysqli_close($conn);
                        return $_SESSION['_applenet_user_id'];
                    }
                }
                mysqli_close($conn);
            }
            return 0;
        } else {
            return $_SESSION['_applenet_user_id'];
        }
    }
?>
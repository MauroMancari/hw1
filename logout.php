<?php
    include 'dbconfig.php';

    //DISTRUGGO LA SESSIONE CHE GIA' ESISTE
    session_start();
    session_destroy();

    if(isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['cookie_id'])){
        $conn = mysqli_connect($host, $user, $pwd, $nameDB) or die(mysqli_error($conn));
        $cookieid = mysqli_real_escape_string($conn, $_COOKIE['cookie_id']);
        $userid = mysqli_real_escape_string($conn, $_COOKIE['id']);
        $query = "SELECT id, hash FROM cookies WHERE id = $cookieid AND user = $userid";
        $res = mysqli_query($conn, $query);

        if($cookie = mysqli_fetch_assoc($res)){
            if(password_verify($_COOKIE['token'], $cookie['hash'])){
                mysqli_query($conn, "DELETE FROM cookies WHERE id = $cookieid");
                mysqli_close($conn);

                setcookie('id', '');
                setcookie('cookie_id', '');
                setcookie('token', '');
            }
        }
        mysqli_close($conn);
    }
    header('Location: login.php');
?>
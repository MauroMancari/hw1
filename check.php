<?php
    require_once 'dbconfig.php';
    session_start();
    //IMPOSTO UN COOKIE PER SALVARE LA SESSIONE, IN MODO CHE SE ESISTE MI VA DIRETTO ALLA HOME E NON DEVO RIESEGUIRE IL LOGIN

    /*if(isset($_SESSION['id'])){
        header('Location: home.php');
        exit;
    }*/

    function check(){
        GLOBAl $dbconfig;

        if(!isset($_SESSION['id'])){
            if(isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['cookie_id'])){
                $conn = mysqli_connect($host, $user, $pwd, $nameDB);
                $coockieid = mysqli_real_escape_string($conn, $_COOKIE['cookie_id']);
                $userid = mysqli_real_escape_string($conn, $_COOKIE['id']);

                //PRENDO IL COOKIE CHE CORRISPONDE ALL'ID.
                $query = "SELECT * FROM cookies WHERE id = $coockieid AND user = $userid";
                $res = mysqli_query($conn, $query);
                if($cookie = mysqli_fetch_assoc($res)){
                    //ESEGUO UN CONTROLLO, SE E' SCADUTO LO ELIMINO ALTRIMENTI, FACCIO IL CONTROLLO PER VERIFICARE SE IL TOKE E' VALIDO.
                    if(time() > $cookie['expires']){
                        mysqli_query($conn, "DELETE FROM cookies WHERE id = ".$cookie['id']) or die(mysqli_error($conn));
                        header('Location: logout.php');
                        exit;
                    }else if(password_verify($_COOKIE['token'], $_COOKIE['hash'])){
                        $_SESSION['id'] = $_COOKIE['id'];
                        mysqli_close($conn);
                        return $_SESSION['id'];
                    }
                }
                mysqli_close($conn);
            }
            return 0;
        }else{
            return $_SESSION['id'];
        }
    }
?>
<?php
#INSERISCO ALL'INTERNO DEL DB IL POST CHE SI DEVE PUBBLICARE.

#DEFINISCO LE CHIAVI CHE MI SERVIRANNO PER FAR FUNZIONARE CORRETTAMENTE LE API

# SPOTIFY   f64c2c9e08e7499e857c310755c78882                168f0e4417d94897bb301c2545a80404
# GIPHY     PwJbLrGVOUST0jTM3jl2tgUjj0aW2RxX
# UNSPLASH  GoA29IDvsUlRG4Kte2RdUYGc6c8mkke4GxDmqgwZfWE     cNc5w2WU-NQ9FF4OXjA5w9fSk6QOUC-MQKrNXi2xssw

    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    switch($_POST['type']) {
        case 'giphy': giphy(); break;
        case 'unsplash':
        case 'spotify': spotify(); break;
        case 'text': text(); break;
        default: break;
    }

    function spotify() {
        GLOBAL $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        /*
            COSTRUISCO LA QUERY, LA ESEGUE E SE E' CORRETTA 
            ALLORA MI RITORNA UN JSON.
        */
        $userid = mysqli_real_escape_string($conn, $userid);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $text = mysqli_real_escape_string($conn, $_POST['text']);

        $query = "INSERT INTO posts(user, content) VALUES('.$userid.', JSON_OBJECT('type', '$type', 'text', '$text', 'id', '$id'))";

        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }
        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }


    function giphy() {
        GLOBAL $dbconfig, $userid;

        $url = 'http://api.giphy.com/v1/gifs/'.$_POST["id"].'?api_key=PwJbLrGVOUST0jTM3jl2tgUjj0aW2RxX';
        $data =  file_get_contents($url);
        $json = json_decode($data, true);

        if($json['meta']['status'] == 200) {
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
            
            $userid = mysqli_real_escape_string($conn, $userid);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $text = mysqli_real_escape_string($conn, $_POST['text']);
            $url = mysqli_real_escape_string($conn, $json['data']['images']['original']['url']);

            $query = "INSERT INTO posts(user, content) VALUES('.$userid.', JSON_OBJECT('type', '$type', 'text', '$text', 'id', '$id', 'url', '$url'))";

            if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
                echo json_encode(array('ok' => true));
                exit;
            }
            
        }

        echo json_encode(array('ok' => false));
    }

    function text() {
        GLOBAL $dbconfig, $userid;
        if (!empty($_POST['text'])) {

            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
            
            $userid = mysqli_real_escape_string($conn, $userid);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $text = mysqli_real_escape_string($conn, $_POST['text']);

            $query = "INSERT INTO posts(user, content) VALUES('.$userid.', JSON_OBJECT('type', '$type', 'text', '$text'))";
            
            if(mysqli_query($conn, $query)) {
                echo json_encode(array('ok' => true));
                exit;
            }
        }
            
        echo json_encode(array('ok' => false));
    }
?>

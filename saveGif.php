<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        exit;
    }

    GLOBAL $userid;

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $userid = mysqli_real_escape_string($conn, $_SESSION['id']);
    $idGif = mysqli_real_escape_string($conn, $_POST['id_gif']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $query = "SELECT * FROM gifs WHERE id_gif = '$idGif' AND id_utente = '$userid'";
    $res = mysqli_query($conn, $query);

    if(mysqli_num_rows($res) > 0){
        echo json_encode(array('ok' => true));
        exit;
    }
    //CREO UN'ALTRA QUERY PER INSERIRE I VALORI NEL DATABSE
    $query = "INSERT INTO gifs(id_gif, id_utente, contenuto) VALUES ('$idGif', '$userid', JSON_OBJECT('id_gif', '$idGif', 'id_utente', '$userid', 'image', '$image'))";
    error_log($query);

    //SE LA QUERY E' CORRETTA MI RITORNA UN JSON CON {OK: TRUE}
    if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
        echo json_encode(array('ok' => true));
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>
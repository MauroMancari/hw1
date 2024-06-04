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

    $query = "DELETE FROM gifs WHERE id_gif = '$idGif' AND id_utente = '$userid'";

    if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
        echo json_encode(array('ok' => true));
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>
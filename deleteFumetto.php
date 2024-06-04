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
    $idFumetto = mysqli_real_escape_string($conn, $_POST['id_fumetto']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $query = "DELETE FROM fumetti WHERE id_fumetto = '$idFumetto' AND id_utente = '$userid'";

    //SE RISUCLTA CORRETTA ALLORA MI RITORNERA' UN JSON CON {OK: TRUE}
    if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
        echo json_encode(array('ok' => true));
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>
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
    $idCanzone = mysqli_real_escape_string($conn, $_POST['id_canzone']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $query = "SELECT * FROM canzoni WHERE id_canzone = '$idCanzone' AND id_utente = '$userid'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($res) > 0){
        echo json_encode(array('ok' => true)); //RISULTA VERO SE PRECEDENTEMENTE ERANO GIA' INSERITI
        exit;
    }

    //CREO UNA NUOVA QUERY DOVE INSERISCO TUTTI I VALORI
    $query = "INSERT INTO canzoni(id_canzone, id_utente, contenuto) values ('$idCanzone', '$userid', JSON_OBJECT('id_canzone', '$idCanzone', 'title', '$title', 'image', '$image', 'author', '$author'))";
    error_log($query);

    //SE E' CORRETTA MI RITORNA UN JSON CON {OK: TRUE}.
    if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
        echo json_encode(array('ok' => true));
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>
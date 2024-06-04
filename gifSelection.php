<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $userid = mysqli_real_escape_string($conn, $_SESSION['id']);

    $query = "SELECT id_gif AS id, id_utente AS utente, contenuto FROM gifs
              WHERE id_utente = $userid ORDER BY data_inserimento DESC LIMIT 15";
    $res = mysqli_query($conn, $query);
    $gif = array();

    while($vet = mysqli_fetch_assoc($res)){
        $gif[] = array('id_gif' => $vet['id'], 'id_utente' => $vet['utente'], 'contenuto' => json_decode($vet['contenuto']));
    }

    echo json_encode($gif);

    exit;
?>
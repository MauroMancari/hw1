<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $userid = mysqli_real_escape_string($conn, $_SESSION['id']);

    $query = "SELECT id_canzone AS id, id_utente AS utente, contenuto FROM canzoni 
              WHERE id_utente = $userid ORDER BY data_inserimento DESC LIMIT 15";
    $res = mysqli_query($conn, $query);
    $canzone = array();

    while($vet = mysqli_fetch_assoc($res)){
        $canzone[] = array('id_canzone' => $vet['id'], 'id_utente' => $vet['utente'], 'contenuto' => json_decode($vet['contenuto']));
    }

    echo json_encode($canzone);

    exit;
?>
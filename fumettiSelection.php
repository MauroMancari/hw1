<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $userid = mysqli_real_escape_string($conn, $_SESSION['id']);

    //SELEZIONO I PRIMI 15 FUMETTI
    $query = "SELECT id_fumetto AS id, id_utente AS utente, contenuto FROM fumetti 
              WHERE id_utente = $userid ORDER BY data_inserimento DESC LIMIT 15";
    $res = mysqli_query($conn, $query);
    $fumetto = array();
    
    while($vet = mysqli_fetch_assoc($res)){
        $fumetto[] = array('id_fumetto' => $vet['id'], 'id_utente' => $vet['utente'], 'contenuto' => json_decode($vet['contenuto']));
    }

    echo json_encode($fumetto);

    exit;
?>
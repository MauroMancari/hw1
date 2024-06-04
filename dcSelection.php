<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $userid = mysqli_real_escape_string($conn, $_SESSION['id']);

    $query = "SELECT id_fumetto AS id, contenuto FROM dc";

    $res = mysqli_query($conn, $query);
    $dc = array();

    while($vet = mysqli_fetch_assoc($res)){
        $dc[] = array('id_fumetto' => $vet['id'], 'contenuto' => json_decode($vet['contenuto']));
    }

    echo json_encode($dc);

    exit;
?>
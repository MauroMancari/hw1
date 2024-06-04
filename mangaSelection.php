<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $userid = mysqli_real_escape_string($conn, $_SESSION['id']);

    $query = "SELECT id_manga AS id, contenuto FROM manga";

    $res = mysqli_query($conn, $query);
    $manga = array();

    while($vet = mysqli_fetch_assoc($res)){
        $manga[] = array('id_manga' => $vet['id'], 'contenuto' => json_decode($vet['contenuto']));
    }

    echo json_encode($manga);

    exit;
?>
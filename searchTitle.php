<?php
    require_once 'dbconfig.php';
    session_start();
    if(!isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        exit;
    }

    header('Content-Type: application/json');

    marvelRequest();

    function marvelRequest(){
        $publicKey = 'dd9b2854c9e50f65b169b55bc3ad3ab4';
        $hash = '9de6aadf9b2374830ab38a517f007121';
        $query = urlencode($_GET['q']);
        $url = 'https://gateway.marvel.com:443/v1/public/series?titleStartsWith='.$query.'&ts=1&apikey='.$publicKey.'&hash='.$hash;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
        curl_close($ch);

        echo $res;        
    }
?>
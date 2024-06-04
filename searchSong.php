<?php
    require_once 'dbconfig.php';
    session_start();
    if(!isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        exit;
    }

    header('Content-Type: application/json');

    spotifyRequest();

    function spotifyRequest(){
        $client_id = 'feaefc6fe526458886eeb885dbab1758';
        $client_secret = '47fb69805a9344959d46335e945509ee';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //ESEGUO LA POST E SETTO ANCHE IL BODY E L'HEADER DELLA POST
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret)));
        $token = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $query = urlencode($_GET['q']);
        $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
        $res=curl_exec($ch);
        curl_close($ch);

        echo $res;
    }
?>
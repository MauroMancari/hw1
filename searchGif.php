<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        exit;
    }

    header('Content-Type: application/json');

    gifyRequest();

    function gifyRequest(){
        $apikey = 'HFZEz421edfK5hAGPaykOi7u098DCHf6';

        $query = urlencode($_GET['q']);
        $url = 'http://api.giphy.com/v1/gifs/search?q='.$query.'&api_key='.$apikey.'&limit=30';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        
        $newJSON = array();
        //QUI POSSO RIFORMARE L'ARRAY CHE HO CREATO
        for($i = 0; $i < count($json['data']); $i++){
            $newJSON[] = array('id' => $json['data'][$i]['id'], 'preview' => $json['data'][$i]['images']['preview_gif']['url'], 'hright' => $json['data'][$i]['images']['preview_gif']['height'], 'width' => $json['data'][$i]['images']['preview_gif']['width']);
        }
        //RITORNO IL NUOVO ARRAY
        echo json_encode($newJSON);
    }
?>
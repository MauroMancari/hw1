<?php
#LA SEGUENTE RITORNA UN JSON CON I RISULTATI CHE CI HA FORNITO L'API SELEZIONATA.
require_once 'auth.php';

#SE LA SEGUENTE SESSIONE E' SCADUTA ALLORA ESCO.
if (!checkAuth()) exit;

#DA QUI IMPOSTA L'HEADER DELLA RUSPOSTA.
header('Content-Type: application/json');

#IN BASE A COSA SCELGO DI FARE, VIENE ESEGUITA UNA FNZUNE DIVERSA.
switch($_GET['type']) {
    case 'giphy': giphy(); break;
    case 'spotify': spotify(); break;
    case 'unsplash': unsplash(); break;
    default: break;
}

function giphy() {
    $apikey = 'HFZEz421edfK5hAGPaykOi7u098DCHf6';
    
    $query = urlencode($_GET["q"]);
    $url = 'http://api.giphy.com/v1/gifs/search?q='.$query.'&api_key='.$apikey.'&limit=30';
    
    /*
        DA QUI CREAO IL CURL PER L'URL SELEZIONATO, DOPO SETTO CHE VOGLIO UN VALORE DI RITORNO ANZICHE' IN BOOLEAN
        (CHE DI PER SE E' COSì DI DEFAULT), ESEGUO LA RICHIESTA DELL'URL, IMPACCHETTO TUTTO ALL'INTERNO DI UN JSON
        ED INFINE LIBERO TUTT LE RISPOSTE.
    */
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    $json = json_decode($data, true);
    curl_close($ch);

    $newJson = array();
    #QUI POSSO RIFORMATTARE L'ARRAY CREATO.
    for ($i = 0; $i < count($json['data']); $i++) {
        $newJson[] = array('id' => $json['data'][$i]['id'], 'preview' => $json['data'][$i]['images']['preview_gif']['url'], 'height' => $json['data'][$i]['images']['preview_gif']['height'], 'width' => $json['data'][$i]['images']['preview_gif']['width']);
    }

    #RITORNO L'ARRAY.
    echo json_encode($newJson);
}

function spotify() {
    $client_id = 'f64c2c9e08e7499e857c310755c78882'; 
    $client_secret = '168f0e4417d94897bb301c2545a80404'; 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    #ESEGUO LA POST E SETTO ANCHE BODU ED HEADER DELLA POST.
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch);    

    #COSTRUISCO LA QUERY EFFETTIVA.
    $query = urlencode($_GET["q"]);
    $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
}

function unsplash() {
    #MOLTO SIMILE ALL'IMPLEMENTAZIONE DELLA FUNZIONE PER GIPHY
    $client_id = 'GoA29IDvsUlRG4Kte2RdUYGc6c8mkke4GxDmqgwZfWE';
    //  orientation=landscape&
    $query = urlencode($_GET["q"]);
    $url = 'https://api.unsplash.com/search/photos?per_page=30&client_id='.$client_id.'&query='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res=curl_exec($ch);
    curl_close($ch);

    $json = json_decode($res, true);

    $newJson = array();
    for ($i = 0; $i < count($json['results']); $i++) {
        $newJson[] = array('id' => $json['results'][$i]['id'], 'preview' => $json['results'][$i]['urls']['thumb'], 'height' => $json['results'][$i]['height'], 'width' => $json['results'][$i]['width']);
    }

    echo json_encode($newJson);
}
?>

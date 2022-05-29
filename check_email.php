<?php
    #FACCIO IL CONTROLLO PER VERIFICARE CHE L'EMAIL UTILIZZATA SIA UNICA.

    require_once 'dbconfig.php';
    
    #VERIFICO CHE L'ACCESSO FATTO SIA LEGGITIMO.
    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui!";
        exit;
    }

    #IMPOSTO L'HEADER DELLA RISPOSTA.
    header('Content-Type: application/json');
    
    #ESEGUO LA CONNESSIONE CON IL DATABASE.
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    /*
        COME PRIMA COSA LEGGO LA STRINGA DELLA MAIL, POI CONSTRUISCO LA QUERY,
        ESEGUO LA QUERY COSTRUITA ED INFINE RITORNO UN JSON CON CHIAVE EXISTS E CON 
        VALORE DI TIPO BOOLEANO.
    */ 
    $email = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT email FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

#CHIUDO LA CONNESSIONE.
    mysqli_close($conn);
?>
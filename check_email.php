<?php
    //CONTROLLO CHE L'EMAIL UTILIZZATA SIA UNICA E NON SIA GIà IN USO
    require_once 'dbconfig.php';

    //VERIFICO LA LEGGITTIMITA' DELL'ACCESSO
    if(!isset($_GET['q'])){
        echo 'Non dovresti essere qui!';
        exit;
    }

    //IMPOST L'HEADER DELLA RISPOSTA
    header('Content-Type: application/json');

    //ESEGUO LA CONNESSINE CON IL MIO DATABASE
    $conn = mysqli_connect($host, $user, $pwd, $nameDB);

    #**
    $email = mysqli_real_escape_string($conn, $_GET['q']);
    $query = "SELECT email FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
    mysqli_close($conn);

    /*
        #**
        COME PRIMA COSA LEGGO LA STRINGA DELLA MAIL, POI CONSTRUISCO LA QUERY,
        ESEGUO LA QUERY COSTRUITA ED INFINE RITORNO UN JSON CON CHIAVE EXISTS E CON 
        VALORE DI TIPO BOOLEANO.
    */
?>
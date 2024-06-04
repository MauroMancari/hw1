<?php
    //VERIFICO SE L'USERNAME E' GIA' IN USO O MENO
    require_once 'dbconfig.php';

    if(!isset($_GET['q'])){
        echo 'Non dovresti essere qui';
        exit;
    }

    header('Content-Type: application/json'); //MI SERVE RESTITUITO UN FILE JSON

    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
    $username = mysqli_real_escape_string($conn, $_GET['q']);
    $query = "SELECT username FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $jsonArray = array('exists' => mysqli_num_rows($res) > 0 ? true : false); //SE RISULTA VERA, MI RESTITUISCE IL VALORE DELL'ARRAY
    echo json_encode($jsonArray); //RESTITUISCE UN JSON
    mysqli_close($conn);
?>
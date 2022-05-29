<?php 
  #ESEGUO IL CONTROLLO DELL'USERNAME OER VERIFICARE SE ESSO E' UNICO OPPURE GIA' ESISTENTE.
    require_once 'dbconfig.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $username = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT username FROM (
              SELECT username FROM users 
              UNION ALL SELECT 'search'
              UNION ALL SELECT 'create'
              UNION ALL SELECT 'home'
              ) AS u WHERE username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
    mysqli_close($conn);
?>
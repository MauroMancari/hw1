<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    if (!isset($_POST["action"])) exit;
    if ($_POST["action"] != 0 && $_POST["action"] != 1) exit;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $action = mysqli_real_escape_string($conn, $_POST["action"]);

    $res = mysqli_query($conn, "UPDATE users SET dark = $action WHERE id = $userid") or die(mysqli_error($conn));

    mysqli_close($conn);
    echo json_encode(array('ok' => $res));
?>
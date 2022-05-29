<?php 
   
    #AGGIUNGO UN LIKE DA PARTE DELL'UTENTE LOGGATO.
    include 'auth.php';
    if (!$userid = checkAuth()) exit;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $postid = mysqli_real_escape_string($conn, $_POST["postid"]);

    #AGGIUNGO UN'ENTRY AI LIKE, SI ATTIVA IL TRIGGER CHE AGGIORNA IL NUMERO DI LIKE E RICAVO IL NUOVO NUMERO DI LIKE PRESENTI NELLA PAGINA.
    $in_query = "INSERT INTO likes(user, post) VALUES($userid, $postid)";
    $out_query = "SELECT nlikes FROM posts WHERE id = $postid";

    $res = mysqli_query($conn, $in_query) or die ('Unable to execute query. '. mysqli_error($conn));

    if ($res) {

        $res = mysqli_query($conn, $out_query);

        if (mysqli_num_rows($res) > 0) {

            $entry = mysqli_fetch_assoc($res);

            $returndata = array('ok' => true, 'nlikes' => $entry['nlikes']);

            echo json_encode($returndata);

            mysqli_close($conn);

            exit;

        }
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>
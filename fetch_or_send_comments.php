<?php 
/*
    PRELEVO LA SEZIONE DEI COMMENTI, SE C'E' UN COMMENTO INVIATO LO AGGIUNGE PRIMA DI 
    ESEGIIRE LA QUERY CHE RITORNA I COMMENTI IN MODO TALE DA AVERE SEMPRE LA LISTA 
    DEI COMMENTI AGGIORNATA. 
*/

    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');


    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $postid = mysqli_real_escape_string($conn, $_POST["postid"]);

    #SE ARRIVA UNA RICHIESTA DI AGGIUNTA DI UN COMMENTO ALLORA ESEGUO L'INSERT, ALTRIMENTI VISUALIZZO E BASTA.
    if(isset($_POST["comment"])) {
        if (!empty($_POST["comment"])) {
            #AGGIUNGO IL COMMENTO.
            $text = mysqli_real_escape_string($conn, $_POST["comment"]);
            $in_query = "INSERT INTO comments(user, post, text) VALUES($userid, $postid, '".$text."')";
            #FACCIO SCATTARE IL TRIGGER CHE AGGIORNA IL NUMERO DI COMMENTI.
            mysqli_query($conn, $in_query) or die (mysqli_error($conn));   
        }
    }

    #PRELEVO TUTTI GLI USER CHE HANNO COMMENTATO QUEL DETERMINATO POST.
    $out_query = "SELECT comments.id AS id, username, propic, text, time, verified 
                    FROM comments LEFT JOIN users ON user = users.id 
                    WHERE comments.post = $postid ORDER BY id DESC LIMIT 30";
    
    $res = mysqli_query($conn, $out_query) or die (mysqli_error($conn));

    $returnarray = array();

    while($entry = mysqli_fetch_assoc($res)) {
        #RITORNO LE INFORMAZIONI PER OGNI UTENTE.
        $propic = $entry['propic'] == null ? "images/default_avatar.png" : $entry['propic'];
        $returnarray[] = array('id' => $entry['id'], 'username' => $entry['username'], 'verified' => $entry['verified'], 
                                        'propic' => $propic, 'text' => $entry['text'], 'time' => getTime($entry['time']));

    }

    echo json_encode($returnarray);

    mysqli_close($conn);

    exit;
#RICAVO IL TEMPO IN MODO DA FAR VEDERE QUANDO E' STATO PUBBLICATO IL COMMENTO
    function getTime($timestamp) {             
        $old = strtotime($timestamp); 
        $diff = time() - $old;           
        $old = date('d/m/y', $old);

        if ($diff /60 <1) {
            return intval($diff%60)." sec";
        } else if ($diff / 60 < 60) {
            return intval($diff/60)." min";
        } else if ($diff / 3600 <24) {
            return intval($diff/3600) . " h";
        } else if ($diff/86400 < 30) {
            return intval($diff/86400) . " g";
        } else {
            return $old; 
        }
    }    
?>
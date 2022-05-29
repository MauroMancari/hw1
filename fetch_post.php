<?php 

    #PRELEVO GLI ULTIMI 10 POSTO OPPURE TUTTI QUELLI DISPONIBILI SE SONO MINORI DI 10.
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);
    
    $next = isset($_GET['from']) ? 'AND posts.id < '.mysqli_real_escape_string($conn, $_GET['from']).' ' : '';

        #PRENDO TUTTI I POSTO E TUTTI I LIKE CHE L'UTENTE LOGGATO HA MESSO HAI POSTO CHE SONO STATI RITORNATOI.
        $query = "SELECT users.id AS userid, users.name AS name, users.surname AS surname, users.username AS username, users.propic AS propic, 
        users.verified AS verified, posts.id AS postid, posts.content AS content, posts.time AS time, posts.nlikes AS nlikes, posts.ncomments AS ncomments,
        EXISTS(SELECT user FROM likes WHERE post = posts.id AND user = $userid) AS liked 
        FROM posts JOIN users ON posts.user = users.id  ORDER BY postid DESC LIMIT 10";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $postArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        #CREO L'ELENCO DEI POST SCROLLANDO TUTTI I RISULTATI OTTENUTI.
        $propic = $entry['propic'] == null ? "images/default_avatar.png" : $entry['propic'];
        $time = getTime($entry['time']);
        $postArray[] = array('userid' => $entry['userid'], 'name' => $entry['name'], 'surname' => $entry['surname'], 
                            'username' => $entry['username'], 'propic' => $propic, 'verified' => $entry['verified'], 
                            'postid' => $entry['postid'], 'content' => json_decode($entry['content']), 'nlikes' => $entry['nlikes'], 
                            'ncomments' => $entry['ncomments'], 'time' => "$time", 'liked' => $entry['liked']);
    }
    echo json_encode($postArray);
    
    exit;

    function getTime($timestamp) {
        #MI  ALCOLA IL TEMPO TRASCORSO TRA LA PUBLICAZIONE DI UN POST E UN ALTRO.     
        $old = strtotime($timestamp); 
        $diff = time() - $old;           
        $old = date('d/m/y', $old);

        if ($diff /60 <1) {
            return intval($diff%60)." secondi fa";
        } else if (intval($diff/60) == 1)  {
            return "Un minuto fa";  
        } else if ($diff / 60 < 60) {
            return intval($diff/60)." minuti fa";
        } else if (intval($diff / 3600) == 1) {
            return "Un'ora fa";
        } else if ($diff / 3600 <24) {
            return intval($diff/3600) . " ore fa";
        } else if (intval($diff/86400) == 1) {
            return "Ieri";
        } else if ($diff/86400 < 30) {
            return intval($diff/86400) . " giorni fa";
        } else {
            return $old; 
        }
    }
?>
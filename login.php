<?php
/*
    ESEGUO UNA VERIFICA PER CONTROLLARE SE L'UTENTE E' GIA' LOGGATO:
    IN CASO DI RISPOSTA POSITIVA ALLORA MI REINDIRIZZA DIRETTAMENTE ALLA HOME.
*/  
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }


    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        /* 
            SE L'USERNAME E LA PASS SONO STATI INVIATI, ALLORA AVVIENE LA CONNSESSIONE AL DATABASE.
            FACCIO LA PREPARAZIONE. CONSENTO DI UTILIZZARE COME ACCESSO USERNAME E E-MAIL IN MODO INTERCAMBIABILE.
        */
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $searchField = filter_var($username, FILTER_VALIDATE_EMAIL) ? "email" : "username";
        #RICAVO L'ID E USERNAME PER LA SESSIONE E LA PASS PER IL CONTROLLO.
        $query = "SELECT id, username, password FROM users WHERE $searchField = '$username'";
        #ESECUZIONE.
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        if (mysqli_num_rows($res) > 0) {
            #CI RITORNA UNA SOLA STRINGA, VA COMUNQUE BENE PERCHE' L'UTENTE CHE SI LOGGA PUO' ESSERE SOLTANTO UNO.
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {
                if (empty($_POST['remember'])) {
                    #SE NON VOGLIO ESSERE RICORDATO ALLORA POSSO IMPOSTARE UNA NUOVA SESSIONE.
                    $_SESSION["_applenet_username"] = $entry['username'];
                    $_SESSION["_applenet_user_id"] = $entry['id'];
                } else {
                    #IN CASO CONTRARIO IMPOSTO UN COOKIE CHE VALE PER 7 GIONRI.
                    $token = random_bytes(12);
                    #UTILIZZO UN TOKEN CON HASH PER MOTIVI DI SICUREZZA.
                    $hash = password_hash($token, PASSWORD_BCRYPT);
                    $expires =  strtotime("+7 day");
                    $query = "INSERT INTO cookies(hash, user, expires) VALUES('".$hash."',".$entry['id'].", ".$expires.")";
                    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    setcookie("_applenet_user_id", $entry['id'], $expires);
                    setcookie("_applenet_cookie_id", mysqli_insert_id($conn), $expires);
                    setcookie("_applenet_token", $token, $expires);
                }
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='./style/login.css'>
        <script src='./scripts/login.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="./assets/favicon.png">
        <script src='js/login.js' defer></script>
        <title>Applenet - Accedi</title>
    </head>
    <body>
        <main class="login">
        <section class="main_left">
        </section>
        <section class="main_right">
            <h1>Applenet</h1>
            <h2>Stay Hungry, Stay Foolish</h2>
            <?php
                #VERIFICA SE SONO PRESENTI DEGLI EROORI.
                if (isset($error)) {
                    echo "<span class='error'>$error</span>";
                }
                
            ?>
            <form name='login' method='post'>
                <div class="username">
                    <div><label for='username'>Nome utente o email</label></div>
                    <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                </div>
                <div>
                    <input type='submit' value="Accedi">
                </div>
            </form>
            <div class="signup">Non possiedi ancora un account? <a href="signup.php">Iscriviti subito?</a>
        </section>
        </main>
    </body>
</html>
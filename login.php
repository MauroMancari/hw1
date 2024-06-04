<?php
    /*
        EFFETTUO UNA VERIFICA PER CONTROLLARE SE L'UTENTE E' GIA' LOGGATO O MENO.
        IN CASO DI RISPOSTA POSITIVA, REINDIRIZZO DIRETTAMENTE ALLA HOME.
    */
    include 'check.php';
    if(check()){
        header('Location: index.php');
        exit;
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        /* 
            SE USERNAME E PASSWORD SONO STATI INVIATI, ALLORA AVVIO LA CONNESSIONE CON IL DATABASE.
            UTILIZZO EMAIL E NOME UTENTE PER ACCEDERE IN MODO INTERCAMBIABILE.
        */
        $conn = mysqli_connect($host, $user, $pwd, $nameDB);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $searchField = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        //RICAVO ID, USERNAME E PASSWORD PER IL CONTROLLO
        $query = "SELECT id, username, password FROM users WHERE $searchField = '$username'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) > 0){
            //RITORNA UNA SOLA STRINGA, VA BENE PERCHE' L'UTENTE CHE SI LOGGA E' SOLO UNO. INOLTRE CREO UN VETTORE ASSOCITIVO CON I SINGOLI RISULTATI.
            $vet = mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'], $vet['password'])){//verifica la password
                if(empty($_POST['remember'])){
                    //SE NON VOGLIO ESSERE RICORDATO ALLORA IMPOSTO UNA NUOVA SESSIONE
                    $_SESSION['username'] = $vet['username'];
                    $_SESSION['id'] = $vet['id'];
                }else{
                    //IN CASO CONTRARIO IMPOSTO UN COOKIE CHE VALE PER 7 GIORNI
                    $token = random_bytes(12);
                    //UTILIZZO UN TOKEN CON HASH PER MOTIVI DI SICUREZZA
                    $hash = password_hash($token, PASSWORD_BCRYPT);
                    $expires = strtotime("+7 day");
                    $query = "INSERT INTO cookies(hash, user, expires) VALUES ('".$hash."', ".$vet['id'].", ".$expires.")";
                    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

                    setcookie('id', vet['id'], $expires);
                    setcookie('cookie_id', mysqli_insert_id($conn), $expires);
                    setcookie('token', $token, $expires);
                }
                header('Location: index.php');
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        //SE L'UTENTE NON E' STATO TROVATO O LE CREDENZIALI NON HANNO SUPERATO LA VERIFICA SA UN ERRORE
        $error = 'Username e/o password errati.';
    }elseif(isset($_POST['username']) || isset($_POST['password'])){
        $error = 'Inserisci username e password';
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="login.js" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="login.css">
        <link rel="icon" type="image/png" href="assets/logo1.png">
        <title>Comics Corner - Accedi</title>
    </head>
    <body>
        <main>
            <section class="main-right">
                <h1>Comics Corner</h1>
                <h2>Accedi per visualizzare i dettagli</h2>
                <?php
                    //VERIFICO SE SONO PRESENTI DEGLI ERRORI
                    if(isset($error)){
                        echo "<span class='error'>$error</span>";
                    }
                ?>
                <form name="login" method="post">
                    <div class="username">
                        <div><label for="username">Nome utente o email</label></div>
                        <div><input type="text" name="username" <?php if(isset($_POST['username'])){echo "value=".$_POST['username'];}?>></div>
                    </div>
                    <div class="password">
                        <div><label for="password">Password</label></div>
                        <div><input type="password" name="password" <?php if(isset($_POST['password'])){echo "value=".$_POST['password'];}?>></div>
                    </div>
                    <div>
                        <input type="submit" value="Accedi">
                    </div>
                </form>
                <div class="signup">Non possiedi un account? <a href="signup.php">Iscriviti subito!</a>
            </section>
        </main>
    </body>
</html>
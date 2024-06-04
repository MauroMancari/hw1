<?php
    require_once "check.php"; //SE LA VARIBILE DI SESSIONE E' GIA' ESISTENTE, ALLORA VADO DIRETTAMENTE ALLA HOME.
    if(check()){
        header('Location: index.php');
        exit;
    }

    //VERIFICO L'ESISTENZA DEI DATI POST
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['confirm_password']) && isset($_POST['allow'])){
        //SE I DATI PASSATI TRAMITE POST ESISTONO, ESEGUO LA CONNESSIONE E CREO UN VETTORE DOVE SARANNO CONTENUTI GLI ERRORI.
        $conn = mysqli_connect($host, $user, $pwd, $nameDB);
        $error = array();

        #USERNAME -> VERIFICO CHE L'USERANAME RISPETTI IL PATTERN SPECIFICATO
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])){
            $error[] = 'Username non valido';
        }else{
            //CERCO SE L'USERNAME E' GIA' IN USO
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) > 0){
                $error[] = 'Username già in uso';
            }
        }
        #PASSWORD -> VERIFICO CHE LA PASSWORD RISPETTI I PATTERN
        if(strlen($_POST['password']) < 8){
            $error[] = 'Caratteri password insufficienti';
        }
        #CONFERMA PASSWORD -> VIRIFICA CHE LA PASSWORD COINCIDANO
        if(strcmp($_POST['password'], $_POST['confirm_password']) != 0){
            $error[] = 'Le password non coincidono';
        }
        #EMAIL -> VERIFICO CHE L'EMAIL RISPETTI I PATTERN
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[] = 'Email non valida';
        }else{
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $query = "SELECT email FROM users WHERE email = '$email'";
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) > 0){
                $error[] = 'Email già in uso';
            }
        }

        if(count($error) == 0){
            //SE NON SONO PRESENTI ERRORI SETTO LA PASSWORD, INSERISCO I DATI NEL DB E CREO LA VARIABILE DI SESSIONE
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT); //SERVE PER CRIPTARE LA PASSWORD
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $query = "INSERT INTO users(username, password, name, surname, email) VALUES ('$username', '$password', '$name', '$surname', '$email')";
            $res = mysqli_query($conn, $query);
            if($res){
                //SE L'INSERIMENTO RIESCE CORRETTAMENTE, SETTO I COOCKIE DI SESSIONE
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header('Location: index.php');
                exit;
            }else{
                $error[] = 'Errore di connessione al Database';
            }
            mysqli_close($conn);
        }
    }else{
        if(isset($_POST['username'])){
            $error = array('Riempire tutti i campi');
        }
    }    
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="signup.js" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="signup.css">
        <link rel="icon" type="image/png" href="assets/logo.png">
        <title>Comics Corner - Iscriviti</title>
    </head>
    <body>
        <main>
            <section class="main-left"></section>
            <section class="main-right">
                <h1>Crea il tuo account</h1>
                <form name="signup" method="post">
                    <div class="names">
                        <div class="name">
                            <div><label for='name'>Nome</label></div>
                            <div><input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> ></div>
                            <span>Nome non valido</span>
                        </div>
                        <div class="surname">
                            <div><label for='surname'>Cognome</label></div>
                            <div><input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> ></div>
                            <span>Cognome non valido</span>
                        </div>
                    </div>
                    <div class="username">
                        <div><label for='username'>Nome utente</label></div>
                        <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                        <span>Nome utente non disponibile</span>
                    </div>
                    <div class="email">
                        <div><label for='email'>Email</label></div>
                        <div><input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
                        <span>Indirizzo email non valido</span>
                    </div>
                    <div class="password">
                        <div><label for='password'>Password</label></div>
                        <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                        <span>Inserisci almeno 8 caratteri</span>
                    </div>
                    <div class="confirm_password">
                        <div><label for='confirm_password'>Conferma Password</label></div>
                        <div><input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></div>
                        <span>Le password non coincidono</span>
                    </div>
                    <div class="allow"> 
                        <div><input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>></div>
                        <div><label for='allow'>Acconsento a farmi rubare i dati.</label></div>
                    </div>
                    <div class="submit">
                    <input type='submit' value="Registrati" id="submit" disabled>
                    </div>
                </form>
                <div class="signup">Hai un account? <a href="login.php">Accedi</a>
            </section>
        </main>
    </body>
</html>
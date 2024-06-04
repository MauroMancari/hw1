<?php
    require_once 'check.php';
    if(!$userid = check()){
        header('Location: login.php');
        exit;
    }
?>

<html>
    <?php
        $conn = mysqli_connect($host, $user, $pwd, $nameDB);
        $userid = mysqli_real_escape_string($conn, $_SESSION['id']);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);
    ?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel='stylesheet' href='search.css'>
        <link rel="icon" type="image/png" href="assets/logo1.png">
        <script src="search.js" defer></script> 

        <title>Comics Corner - Cerca</title>
    </head>
    <body>
        <header>
            <div class="content flex">
                <a href="index.php"><img src="assets/logo2.png" alt="" width="140" class="logo"></a>
                <nav class="nav">
                    <ul class="menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php">Cerca</a></li>
                        <li><a href="prefer.php">Preferiti</a></li>
                    </ul>
                </nav>
                <div class="navbar" id="header-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </div>
        </header>
        <section id="overlay" class="hidden"></section>
        <main>
            <section id="search">
                <form>
                    <div class="search">
                        <label class="lab" for="text">Cosa vorresti cercare</label>
                        <input type="text" name="search" class="searchBar" id="text">
                        <select name="tipo" id="tipo">
                            <option value="titolo">Fumetto</option>
                            <option value="musica">Musica</option>
                            <option value="gif">Gif</option>
                        </select>
                        <input type="submit" value="Cerca">
                    </div>
                </form>
            </section>
            <section class="container">
                <div id="results">

                </div>
            </section>
        </main>
    </body>
</html>
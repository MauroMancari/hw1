<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: login.php');
        exit;
    }
    
    $conn = mysqli_connect($host, $user, $pwd, $nameDB);
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="marvel.js" defer></script>
        <link rel="stylesheet" href="static.css">
        <link rel="icon" type="image/png" href="assets/logo1.png">
        <title>Comics Corner - Marvel Comics</title>
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
                        <li id="menu-item"><a href="#">Altro +</a>
                            <ul class="sub-menu">
                                <li><a href="manga.php">Manga</a></li>
                                <li><a href="marvel.php">Marvel</a></li>
                                <li><a href="dc.php">DC</a></li>
                                <li><a href="funko.php">Funko</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="navbar" id="header-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </div>
        </header>

        <section class="container">
            <div class="contenitore">
                <div class="griglia">
                    <div class="box-color">
                        <h2>Marvel Comics - Tutta la nostra collezione</h2>
                    </div>
                </div>
            </div>
            <div id="results"></div>
        </section>

    </body>

</html>

<?php
    mysqli_close($conn);
?>
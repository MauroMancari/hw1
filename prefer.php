<?php
    require_once 'dbconfig.php';
    session_start();

    if(!isset($_SESSION['id'])){
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="prefer.js" defer></script>
        <link rel="stylesheet" href="prefer.css">
        <link rel="icon" type="image/png" href="assets/logo1.png">
        <title>Comics Corner - Preferiti</title>
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
    <div class="userInfo">      
        <h1>Benvenuto <em><?php echo $userinfo['username'];?></em> ecco la lista di tutti i tuoi preferiti</h1>
    </div>

    <section class="container">
        <div id="results"></div>
    </section>
    
    <section class="container">
        <div id="results2"></div>
    </section>

    <section class="container">
        <div id="results3"></div>
    </section>
</html>

<?php
    mysqli_close($conn);
?>
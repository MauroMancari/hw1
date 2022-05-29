<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);
    ?>

    <head>
        <link rel='stylesheet' href='./style/home.css'>
        <script src='./scripts/home.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="./assets/favicon.png">
        <meta charset="utf-8">

        <title>Applenet</title>
    </head>

    <body <?php if(isset($_GET['user'])) echo "data-user='".$_GET['user']."'"; if($userinfo['dark'] == '1') echo " class='dark'"; ?> >
        
        <div id="modal" class="hidden invisible"> 
            <div class="window">
                <button id="modal_close">Chiudi</button>
                <div class="modal_desc">Persone a cui piace</div>
                <div id="modal_place">
                </div>
            </div>
        </div>

        <header>
            <nav>
                <div id="s_nav">
                </div>
                <div class="l_nav">
                    <h1>Applenet</h1>
                    <a href="./" <?php if(!isset($_GET['user'])) echo "class='here'"; ?> >Home</a>
                    <a href="search.php">Cerca utenti</a>
                    <a href="logout.php">Logout</a><br><br>
                </div>
                <div class="r_nav">
                    <button class="darkmode"></button>
                    <a href="create">New Post</a>
                </div>
            </nav>
        </header>
        <main class="fixed">
            <section id="profile">
                <div class="avatar" style="background-image: url(<?php echo $userinfo['propic'] == null ? "images/default_avatar.png" : $userinfo['propic'] ?>)">
                </div>
                <div class="name">
                    <?php 
                        echo $userinfo['name']." ".$userinfo['surname']." ".($userinfo['verified'] ? "<span class='verified'></span>" : ""); 
                    ?>
                </div>
                <div class="username">
                    #<?php echo $userinfo['username'] ?>
                </div>
                <div class="stats">
                    <div>
                        <span class="count"><?php echo $userinfo['nposts'] ?></span><br>Post
                    </div>
                    <div id="view_followers">
                        <span class="count"><?php echo $userinfo['nfollowers'] ?></span><br>Follower
                    </div>
                    <div id="view_following">
                        <span class="count"><?php echo $userinfo['nfollowing'] ?></span><br>Seguiti
                    </div>
                </div>
            </section>
            <section class="ghost_feed"></section>
            <section id="suggestion"></section>
        </main>
        <!-- ------------------ PARTE DESTINATA ANCHE ALL'IMPLEMENTAZIONE MOBILE ------------------ -->
        <main>
           <section class="ghost_profile"></section>
            <section id="feed">
                <template id="post_template">
                    <article class="post">
                        <div class="userinfo">
                            <div class="avatar">
                                <img src="">
                            </div>
                            <div class="names">
                                <a>
                                <div class="name"></div>
                                <div class="username"></div>
                                </a>
                            </div>
                            <div class="time"></div>
                        </div>
                        <div class="content"></div>
                        <div class="text"></div>
                        <div class="actions">
                            <div class="like"><span></span></div>
                            <div class="comment"><span></span></div> 
                        </div>
                        <div class="comments">
                            <div class="past_messages"></div>
                            <div class="comment_form">
                                <form autocomplete="off">
                                    <input type="text" name="comment" maxlength="254" placeholder="Scrivi un commento..." required="required">
                                    <input type="submit">
                                    <input type="hidden" name="postid">
                                </form>
                            </div>
                        </div>
                    </article>
                </template>
            </section>
            <section class="ghost_suggestion"></section>
        </main>
        <!-- ------------------ SIDEBAR DELLA VERSIONE MOBILE ------------------ -->
        <section id="sidenav" class="invisible hidden">
            <div class="bar" id="sidenav_content">
                <div class="profile">
                    <div class="avatar" style="background-image: url(<?php echo $thisuserinfo['propic'] == null ? "images/default_avatar.png" : $thisuserinfo['propic'] ?>)">
                    </div>
                    <div class="name">
                        <?php 
                            echo $thisuserinfo['name']." ".$thisuserinfo['surname']." ".($thisuserinfo['verified'] ? "<span class='verified'></span>" : ""); 
                        ?>
                    </div>
                    <div class="username">
                        #<?php echo $thisuserinfo['username'] ?>
                    </div>
                </div>
                <a href="./" <?php if(!isset($_GET['user'])) echo "class='here'"; ?> >Home</a>
                <a href="search">Cerca Utenti</a>
                <a href="create">New Post</a>
                <a href="logout.php">Logout</a>
                <button class="darkmode"></button>
            </div>
        </section>

    </body>
    <footer>
        <p>
            Powered by: Mauro Mancari
        </p>
        <p>
            Matricola: 1000006555
        </p>
    </footer>
</html>

<?php mysqli_close($conn); ?>
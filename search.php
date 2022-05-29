<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
    
?>
<html>
<!-- PURTROPPO PER QUESTIONI DI TEMPISTICA NON SONO RIUCITO A COMPLETARE LA PARTE DELLA RICERCA DEGLI UTENTI -->
    <head>
        <link rel='stylesheet' href='./style/search.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="./assets/favicon.png">
        <meta charset="utf-8">

        <title>Applenet - Cerca</title>
    </head>

    <body>
    <header>
        <nav>
            <div id="s_nav">
            </div>
            <div class="l_nav">
                <h1>Applenet</h1>
                <a href="./">Home</a>
                <a href="search.php">Cerca utenti</a>
                <a href="create_post.php">New Post</a><br><br>
            </div>
            <div class="r_nav">
                <a href="logout.php">Logout</a>
            </div>
        </nav>        
    </header> 
    <main>
        <form id="form_all" name = "nome_form" method="post">
            <p id="search-side">  
                <label><input id="myInput" type="text" name="research" ></label>
                <label><input id="button" type='click' name="cerca" value="Cerca"></label>
                <label>oppure <input id="button"  type='click' name="cerca_tutti" value="Cerca tutti"></label>
            </p></br>
            <ul id="myUL">
                <li id="under_section">
                    <!--
                    -- Prototipo degli utenti che appariranno nella ricerca con le proprie classi--
                    <a class="item_list">
                        <label><img class="img_list" src="images/user_img/ads123.jpg" width="50" height="50"></label>
                        <label class="name_list">Nome </label>
                        <label class="user_list">(nome utente)</label>
                        <label class="segui"> Segui</label>
                    </a>
                    -->
                </li>
                     
            </ul>
        </form>
    </main>
    
    
    </body>
</html>
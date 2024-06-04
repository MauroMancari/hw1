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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="index.js" defer></script>
        <link rel="stylesheet" href="index.css">
        <link rel="icon" type="image/png" href="assets/logo1.png">
        <title>Comics Corner</title>
    </head>
    <body>
        <header>
            <a href="index.php" class="log"><img src="assets/logo2.png" alt="" width="140" class="logo"></a>
            <div class="content flex">                
                <nav class="nav">
                    <ul class="menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php">Cerca</a></li>
                        <li><a href="prefer.php">Preferiti</a></li>
                        <li id="menu-item"><a href="#">Altro+</a>
                            <ul class="sub-menu">
                                <li><a href="manga.php">Manga</a></li>
                                <li><a href="marvel.php">Marvel</a></li>
                                <li><a href="dc.php">DC</a></li>
                                <li><a href="funko.php">Funko</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
                <div class="navbar" id="header-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </div>
            
        </header>
            
        <section class="section-img">
            <div class="slider2">
                <div class="slides">                    
                    <input type="radio" name="radio-btn" id="radio1" data-index="primo" checked>
                    <input type="radio" name="radio-btn" id="radio2" data-index="secondo">
                    <input type="radio" name="radio-btn" id="radio3" data-index="terzo">
                    <input type="radio" name="radio-btn" id="radio4" data-index="quarto">
                    
                    <div class="slide first" data-index="primo">
                        <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/Banner-2.png">
                        <div class="home-slider" data-index="primo">
                            <div class="info">
                                <h2>The First Slam Dunk Re: Source</h2>
                                <div class="info2">
                                    <p>Scopri il dietro le quinte del premio per la miglior animazione dell'anno ai "Japan Academy Awards 2023"</p>
                                </div>
                                <span class="button">Guarda</span>
                            </div>
                        </div>
                    </div>
                    <div class="slide" data-index="secondo">
                        <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/Senza-nome-1.png">
                        <div class="home-slider hidden" data-index="secondo">
                            <div class="info">
                                <h2>Make The Exorcist Fall In Love</h2>
                                <div class="info2">
                                    <p>Il nuovo manga di Paninni disponibile sia in versione regular che nella versione variant, in esclusiva per le fumetterie</p>
                                </div>
                                <span class="button">Guarda</span>
                            </div>
                        </div>
                    </div>
                    <div class="slide" data-index="terzo">
                        <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/LOL-banner.png">
                        <div class="home-slider hidden" data-index="terzo">
                            <div class="info">
                                <h2>The Art Of Arcane - Deluxe Hardcover</h2>
                                <div class="info2">
                                    <p>Tutti i retroscena della serie TV di Netflix , in un fantastico volume</p>
                                </div>
                                <span class="button">Guarda</span>
                            </div>
                        </div>
                    </div>
                    <div class="slide" data-index="quarto">
                        <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/Banner-Sin-City-2.png">
                        <div class="home-slider hidden" data-index="quarto">
                            <div class="info">
                                <h2>Sin City (Star Comics)</h2>
                                <div class="info2">
                                    <p>L'epopea neo-noir di Frank Miller ritorna con tre diverse edizioni</p>
                                </div>
                                <span class="button">Guarda</span>
                            </div>
                        </div>
                    </div>
                    <!-- NAVIGAZIONE AUTOMATICA INIZIO --> 
                    <div class="navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>
                    </div>
                    <!-- NAVIGAZIONE AUTOMATICA FINE -->
                </div>
                <!-- NAVIGAZIONE MANUALE INIZIO -->
                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>
                <!-- NAVIGAZIONE MANUALE FINE -->
            </div>
        </section>
        
        <section id="album-view" class="main">
            <div class="boxed-content-column">
                <div class="box-container">
                    <a title="MANGA" href="manga.php">
                        <h3>Manga</h3>
                        <img src="img/home/manga.webp">
                    </a>
                    <a title="MARVEL" href="marvel.php">
                        <h3>Marvel</h3>
                        <img src="img/home/fumetti.webp">
                    </a>
                    <a title="DC" href="dc.php">
                        <h3>DC</h3>
                        <img src="img/home/DC.webp">
                    </a>
                    <a title="FUNKO POP" href="funko.php">
                        <h3>Funko Pop</h3>
                        <img src="img/home/funko.png">
                    </a>
                </div>

                <div class="contenitore">
                    <div class="griglia">
                        <a class="box-color" href="manga.php">
                            <h2>Manga - Ultimi arrivi</h2>
                            <div class="effects">
                                <span class="efx">GUARDA TUTTI</span>
                            </div>
                        </a>

                        <div class="slider">
                            <!--implementazione bottoni di scorrimento -->
                            <div class="arrows">
                                <button class="arrow arrow-prev">
                                    <i class="left" data-index="primo">&#10094;</i> <!-- &#10094; freccia sinistra-->
                                </button>                                
                                <button class="arrow arrow-next">
                                    <i class="right" data-index="primo">&#10095;</i><!-- &#10095; freccia destra-->
                                </button>                                
                            </div>
                            <div class="slider-cont">
                                <div class="list">
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">One Piece 107: Avventure nel paese di Wano</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/onepiece.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Naruto il mito 36 di 72 terza ristampa</h3>
                                                <h4 class="prezzo">
                                                    <span>10.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/naruto.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Slam-Dunk: The first slam dunk contest</h3>
                                                <h4 class="prezzo">
                                                    <span>15.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/slamdunk.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">One-Punch Man: Vol 10</h3>
                                                <h4 class="prezzo">
                                                    <span>15.25€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/punchman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Death Note: Short Stories</h3>
                                                <h4 class="prezzo">
                                                    <span>2.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/death.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Demon Slayer - Kimetsu no yaiba</h3>
                                                <h4 class="prezzo">
                                                    <span>5.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/demon.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Detective Conan: Il mistero del cristallo</h3>
                                                <h4 class="prezzo">
                                                    <span>5.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/conan.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">One Piece Capitolo 1112: Hard Aspect</h3>
                                                <h4 class="prezzo">
                                                    <span>20.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/onepiece2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Naruto Volume 49: Comincia l'assemblea dei cinque Kage</h3>
                                                <h4 class="prezzo">
                                                    <span>16.35€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/naruto2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Demon Slayer Capitolo 191: Chi di noi è il demone</h3>
                                                <h4 class="prezzo">
                                                    <span>8.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/demon2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Lupin III Capitolo 123: Questo capolavoro è mio!</h3>
                                                <h4 class="prezzo">
                                                    <span>14.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/lupinlll.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">One-Punch Man Vol 45: Un solo pugno!</h3>
                                                <h4 class="prezzo">
                                                    <span>13.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/punchman2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Naruto Volume 69: Inizia la primavera cremisi</h3>
                                                <h4 class="prezzo">
                                                    <span>8.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/naruto3.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Lupin III Capitolo 108: Il bollettino di Lupin</h3>
                                                <h4 class="prezzo">
                                                    <span>15.75€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/lupinlll2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contenitore">
                    <div class="griglia">
                        <a class="box-color" href="marvel.php">
                            <h2>Fumetti Marvel - Ultimi arrivi</h2>
                            <div class="effects">
                                <span class="efx">GUARDA TUTTI</span>
                            </div>
                        </a>

                        <div class="slider">
                            <!-- <div></div> bottoni per far girare le immagini-->
                            <div class="arrows">
                                <button class="arrow arrow-prev">
                                    <i class="left" data-index="secondo"> &#10094; </i> <!-- &#10094; -->
                                </button>                                
                                <button class="arrow arrow-next">
                                    <i class="right" data-index="secondo"> &#10095; </i><!-- &#10095; -->
                                </button>                                
                            </div>
                            <div class="slider-cont">
                                <div class="list">
                                    <a class="box-link">
                                        <div class="card pref">
                                            <div class="text-block">
                                                <h3 class="caption">L'incredibile Hulk di Peter David</h3>
                                                <h4 class="prezzo">
                                                    <span>5.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/hulk.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Iron Man: L'invincibile Iron Man 2</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/ironman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Thor vs Hulk: Vessilli di guerra</h3>
                                                <h4 class="prezzo">
                                                    <span>15.20€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/thorvshulk.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">The Amazing Spider-Man: Vol 40</h3>
                                                <h4 class="prezzo">
                                                    <span>10.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/spideman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Captain America: Marvel Knights</h3>
                                                <h4 class="prezzo">
                                                    <span>18.55€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/captainamerica.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Venom: Protettore letale</h3>
                                                <h4 class="prezzo">
                                                    <span>19.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/venom.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Guardiani della Galassia: Retaggio</h3>
                                                <h4 class="prezzo">
                                                    <span>11.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/guardiani.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Deadpool #48: In memoria di Wolverine</h3>
                                                <h4 class="prezzo">
                                                    <span>11.85€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/deadpool.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Wolverine #71: Il corocevia del coyote</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/wolverine.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Marvel Knights: Black Widow</h3>
                                                <h4 class="prezzo">
                                                    <span>10.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/blackwidow.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>                                    
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">La Morte del Venomverse: Uccidere Tutti i Venom</h3>
                                                <h4 class="prezzo">
                                                    <span>13.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/venom2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>                                    
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">X-Men Presenta: Magneto – Mutante Malvagio</h3>
                                                <h4 class="prezzo">
                                                    <span>25.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/xman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>                                    
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Daredevil & Echo: Male Antico</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/daredevil.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Captain Marvel: Tempesta Oscura</h3>
                                                <h4 class="prezzo">
                                                    <span>18.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/captainmarvel.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contenitore">
                    <div class="griglia">
                        <a class="box-color" href="dc.php">
                            <h2>DC Comics - Ultimi arrivi</h2>
                            <div class="effects">
                                <span class="efx">GUARDA TUTTI</span>
                            </div>
                        </a>

                        <div class="slider">
                            <!-- <div></div> bottoni per far girare le immagini-->
                            <div class="arrows">
                                <button class="arrow arrow-prev">
                                    <i class="left" data-index="terzo"> &#10094; </i> <!-- &#10094; -->
                                </button>                                
                                <button class="arrow arrow-next">
                                    <i class="right" data-index="terzo"> &#10095; </i><!-- &#10095; -->
                                </button>                                
                            </div>
                            <div class="slider-cont">
                                <div class="list">
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Super Man: La nascita di un eroe</h3>
                                                <h4 class="prezzo">
                                                    <span>2.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/superman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Green Arrow: Emerald archer</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/arrow.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Acquaman: Profondità marine</h3>
                                                <h4 class="prezzo">
                                                    <span>5.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/acquaman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Wonder Woman: Terra uno</h3>
                                                <h4 class="prezzo">
                                                    <span>8.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/wonderwoman.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Joker: L'uomo che ha smesso di ridere</h3>
                                                <h4 class="prezzo">
                                                    <span>10.60€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/joker.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Harley Devasta l'Universo DC</h3>
                                                <h4 class="prezzo">
                                                    <span>7.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/harley.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Flash 47</h3>
                                                <h4 class="prezzo">
                                                    <span>4.80€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/flash.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Lanterna Verde: Il Potere di Ion</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/lanternaverde.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Cyborg: Le Colpe dei Padri</h3>
                                                <h4 class="prezzo">
                                                    <span>3.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/cyborg.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Justice League: Il Matrimonio di Atom e Jean Loring</h3>
                                                <h4 class="prezzo">
                                                    <span>8.25€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/jl.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Batman: Harley e Ivy</h3>
                                                <h4 class="prezzo">
                                                    <span>16.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/batmanhi.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Superman: Godfall</h3>
                                                <h4 class="prezzo">
                                                    <span>18.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/superman2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Lanterna Verde/ Freccia Verde</h3>
                                                <h4 class="prezzo">
                                                    <span>3.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/lanternaverde2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Batman e Joker: Il Duo Mortale</h3>
                                                <h4 class="prezzo">
                                                    <span>18.85€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/batmanjoker.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contenitore">
                    <div class="griglia">
                        <a class="box-color" href="funko.php">
                            <h2>Funko Pop - Ultimi arrivi</h2>
                            <div class="effects">
                                <span class="efx">GUARDA TUTTI</span>
                            </div>
                        </a>
                        <div class="slider">
                            <!--bottoni per far girare le immagini-->
                            <div class="arrows">
                                <button class="arrow arrow-prev">
                                    <i class="left" data-index="quarto"> &#10094; </i> <!-- &#10094; -->
                                </button>                                
                                <button class="arrow arrow-next">
                                    <i class="right" data-index="quarto"> &#10095; </i><!-- &#10095; -->
                                </button>                                
                            </div>
                            <div class="slider-cont">
                                <div class="list">
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Michael Jordan</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/mj.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Harry Potter - Voldemort</h3>
                                                <h4 class="prezzo">
                                                    <span>15.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/voldemort.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x One Piece - Ace</h3>
                                                <h4 class="prezzo">
                                                    <span>25.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/ace.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Marvel - Black Panther</h3>
                                                <h4 class="prezzo">
                                                    <span>20.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/marvel2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Naruto Shippuden - Gaara</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/gaara.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Marvel - Torcia Umana</h3>
                                                <h4 class="prezzo">
                                                    <span>14.20€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/marvel.jpeg" class="slider-img mdl-img">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x DC Comics - Super Man</h3>
                                                <h4 class="prezzo">
                                                    <span>16.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/dc.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x One Piece - Sanji</h3>
                                                <h4 class="prezzo">
                                                    <span>15.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/sanji.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop Sport Legends - Muhammad Ali</h3>
                                                <h4 class="prezzo">
                                                    <span>19.25€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/ali.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x DC Comics - Batman</h3>
                                                <h4 class="prezzo">
                                                    <span>15.55€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/dc2.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Harry Potter - Harry Potter</h3>
                                                <h4 class="prezzo">
                                                    <span>18.00€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/harry.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x NBA - Lebron James</h3>
                                                <h4 class="prezzo">
                                                    <span>30.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/lebron.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Naruto Shippuden - Itachi</h3>
                                                <h4 class="prezzo">
                                                    <span>25.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/itachi.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                    <a class="box-link">
                                        <div class="card">
                                            <div class="text-block">
                                                <h3 class="caption">Funko Pop x Demon Slayer - Tanjiro</h3>
                                                <h4 class="prezzo">
                                                    <span>15.50€</span>
                                                </h4>
                                            </div>
                                            <img src="img/home/tanjiro.jpeg" class="slider-img mdl-img" draggable="false">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="vetrina">
                    <div class="title">
                        <h2>IN VETRINA</h2>
                    </div>
                    <div id="vet" class="idk">
                        <a class="lnk">
                            <div class="cover">
                                <img src="img/home/batman_dylandog.webp">
                            </div>
                            <div class="txt">
                                <h3>Batman E Dylan Dog 1 Di 3 L'ombra Del Pipistrello</h3>
                                <div class="paragrafo">
                                    <p>
                                        CI SIAMO. E’ SCOCCATA L’ORA FATALE: IL BAT-SEGNALE SI ACCENDE NELLA NOTTE A CHIAMARE IN AZIONE L’INDAGATORE DELL’INCUBO E LE PISTE DI BATMAN E DI DYLAN DOG FINALMENTE SI CONGIUNGONO. IN TRE ALBI SCENEGGIATI DA ROBERTO RECCHIONI E DISEGNATI DA GIGI CAVENAGO, SU MATITE DI WERTHER DELL’EDERA E CON I COLORI DI GIOVANNA NIRO, SI DISPIEGHERA’ LA COMPLESSA VICENDA CHE VEDE IN AZIONE, FIANCO A FIANCO, LA CREATURA DI TIZIANO SCLAVI (TRASFORMATASI NEL TEMPO IN UN AUTENTICO FENOMENO DI COSTUME) E QUEL CAVALIERE OSCURO MADE IN DC COMICS CHE, A PARTIRE DAGLI ANNI QUARANTA, E’ DIVENTATO UNA DELLE ICONE POP PIU’ CONOSCIUTE E AMATE DEI FUMETTI, DEL CINEMA, DELLA TV, DEI VIDEOGIOCHI E DEL MERCHANDISING. E CON LORO DUE, A MUOVERSI NEL LATO OSCURO DEL MONDO, TRA GOTHAM E LONDRA, CI SARANNO GROUCHO E ALFRED, GORDON E BLOCH, XABARAS E JOKER. E ANCORA KILLER CROC, MADAME TRELKOVSKI, CATWOMAN, ETRIGAN. E POI ZOMBI A VOLONTA’. MA POTEVA FORSE MANCARE UN CERTO JOHN CONSTANTINE? APPUNTAMENTO MENSILE A PARTIRE DA GIUGNO, TRA LONDRA E GOTHAM CITY!
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="four-col">
                        <a>
                            <div class="cover2">
                                <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2023/06/l-estate-in-cui-hikaru-e-morto-1-1.jpeg">
                            </div>
                            <div class="txt2">
                                <h3>L’ Estate In Cui Hikaru È Morto 1</h3>
                                <div class="paragrafo2">
                                    <p>
                                        YOSHIKI E HIKARU SONO DUE RAGAZZI COETANEI CRESCIUTI INSIEME IN UN PICCOLO VILLAGGIO. UN GIORNO, YOSHIKI NOTA LA PRESENZA DI UN QUALCOSA DI DIVERSO NEL SUO AMICO: UNA QUALCHE ENTITÀ HA PRESO IL SUO POSTO. PUR SAPENDOLO, YOSHIKI CONTINUA A ESSERGLI AMICO, MA NEL FRATTEMPO NEL VILLAGGIO INIZIANO A VERIFICARSI STRANI INCIDENTI…
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a>
                            <div class="cover2">
                                <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2023/06/the-witcher-compendium-1.webp">
                            </div>
                            <div class="txt2">
                                <h3>The Witcher Compendium 1</h3>
                                <div class="paragrafo2">
                                    <p>
                                        CHI NON CONOSCE THE WITCHER, LA FAMOSISSIMA SERIE DI ROMANZI E VIDEOGIOCHI CHE HA SPOPOLATO ANCHE SU NETFLIX? FORSE, PERO”, NON TUTTI SANNO CHE ESISTONO DELLE AVVENTURE DI GERALT DI RIVIA SCRITTE E DISEGNATE DAI MIGLIORI TALENTI DEL MONDO DEI COMICS. E CHE SONO STORIE ORIGINALI, MAI VISTE PRIMA IN NESSUN’ALTRA FORMA! INIZIATE LA CACCIA AI MOSTRI PIU’ LEGGENDARI DI SEMPRE SULLE PAGINE DELLA NUOVA COLLANA IN FORMATO TASCABILE DI THE WITCHER!
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a>
                            <div class="cover2">
                                <img src="img/home/cofanetto-spiderman.jpeg">
                            </div>
                            <div class="txt2">
                                <h3>La Vita E La Morte Di Superior Spider-man – Cofanetto</h3>
                                <div class="paragrafo2">
                                    <p>
                                        IN PUNTO DI MORTE, IL DOTTOR OCTOPUS TENTA L’AZZARDO FINALE E SCAMBIA IL PROPRIO CORPO CON QUELLO DI PETER PARKER!<br>
                                        L’ARRAMPICAMURI CHE CONOSCIAMO E AMIAMO DA SEMPRE NON C’E’ PIU, RESTA SOLO… SUPERIOR SPIDER-MAN!<br>
                                        IN UN UNICO COFANETTO, UNA DELLE STORIE RAGNESCHE PIU’ AMATE E CONTROVERSE DEGLI ULTIMI ANNI.<br>
                                        CONTIENE SUPERIOR SPIDER-MAN: L’ORIGINE, VOLUME ESCLUSIVO DEL COFANETTO CON LA STORIA CHE HA DATO ORIGINE ALLA SAGA!<br>
                                        SOLO NEL COFANETTO TROVERAI IL VOLUME ESCLUSIVO SUPERIOR SPIDER-MAN: L’ORIGINE
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a>
                            <div class="cover2">
                                <img src="https://comicscorner.b-cdn.net/wp-content/uploads/2023/05/grim-1-non-temere-il-mietitore-300x440.jpg">
                            </div>
                            <div class="txt2">
                                <h3>Grim 1 Non Temere Il Mietitore</h3>
                                <div class="paragrafo2">
                                    <p>
                                        JESSICA HARROW È MORTA, MA IL SUO VIAGGIO È APPENA INIZIATO.<br>
                                        NELL’OLTRETOMBA, INFATTI, JESSICA VIENE RECLUTATA COME MIETITRICE: IL SUO COMPITO CONSISTE NEL TRAGHETTARE LE ANIME DEI MORTI VERSO LA LORO DESTINAZIONE FINALE. MA, A DIFFERENZA DEGLI ALTRI MIETITORI, LEI NON HA ALCUNE MEMORIA DI COME SIA MORTA NÉ DEL PERCHÉ ORA DEBBA SVOLGERE QUESTO LAVORO.<br>
                                        PER SVELARE IL MISTERO DEL SUO TRAPASSO E FARE LUCE SUI NUMEROSI ENIGMI CHE LE GRAVITANO ATTORNO, JESSICA DOVRÀ PRIMA RISOLVERNE UNO ANCORA PIÙ GRANDE: CHE FINE HA FATTO IL VERO TRISTO MIETITORE, OVVERO LA MORTE? LA SCENEGGIATRICE STEPHANIE PHILLIP E IL DISEGNATORE ITALIANO FLAVIANO REALIZZANO GRIM, UNA SERIE DALLE ATMOSFERE PROFONDAMENTE DARK CHE RACCONTA LA MORTE DA UN NUOVO PUNTO DI VISTA: QUELLO DI CHI SI TROVA A ESSERE IL TRISTO MIETITORE IN PERSONA… MA CHE NON VUOLE ESSERLO!
                                    </p>
                                </div>
                            </div>
                        </a>                        
                    </div>
                    <a class="button">Vai ai prodotti</a>
                </div>

            </div>        
        </section>
        
        <section id="modal-view" class="hidden">
        </section>

        <footer>
            <section id="upper-half">
                <div class="upper-first">
                    <div class="upper-second">
                        <div class="upper-details">
                            <h4>Spedizioni gratuite</h4>
                            <div>
                                <p>
                                    Con una spesa minima di 35€.
                                </p>
                            </div>
                        </div>
                        <div class="upper-details">
                            <h4>Imballaggio accurato</h4>
                            <div>
                                <p>
                                    Imballiamo il tuo ordine con cura, usando solo materiale ecologico e biodegradabile.
                                </p>
                            </div>
                        </div>
                        <div class="upper-details">
                            <h4>Abbonati alle tue serie preferite</h4>
                            <div>
                                <p>
                                    Abbonati alle collane che segui, non perdere nemmeno un'uscita. Spedizioni flessibili del solo materiale disponibile.
                                </p>
                            </div>
                        </div>
                        <div class="upper-details">
                            <h4>Paga con 18App o carta docente</h4>
                            <div>
                                <p>
                                    Paga i tuoi acquisti con il bonus 18APP o Carta Docente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>                
            </section>

            <section class="footer-bar">
                <div class="first">
                    <div class="first second">
                        <div class="details">
                            <h4>Aiuto</h4>
                            <div>
                                <p>
                                    <a>Contatti</a><br>
                                    <a>FAQs</a><br>
                                    <a>Termi e condizioni per l'utilizzo</a>
                                </p>
                            </div>
                        </div>
                        <div class="details">
                            <h4>Account</h4>
                            <div>
                                <p>
                                    <a>Il mio account</a><br>
                                    <a>Lista preferiti</a><br>
                                </p>
                            </div>
                        </div>
                        <div class="details">
                            <h4>Società</h4>
                            <div>
                                <p>
                                    <a class="underline" data-name="one">Cerca il Comics Corner più vicino a te</a><br>
                                    <a class="underline" data-name="one">Su di noi</a><br>
                                    <a class="underline" data-name="one">Lavora con noi</a><br>
                                    <a class="underline" data-name="one">Apri un Comics Corner</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>                
            </section>

            <section id="credits">
                <div>
                    <p>Powered by Mauro Mancari - Matricola: 1000006555</p>
                </div>
            </section>        
        </footer>
    </body>
</html>

<?php
    mysqli_close($conn);
?>
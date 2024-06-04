-- CREAZIONE DEL DB CHE DEVO ESPORTARE

/* * * * TABELLE * * * */
create table users(
	id int primary key auto_increment,
	name varchar(255) not null,
    surname varchar(255) not null,
    username varchar(255) not null unique,
    email varchar(255)not null unique,
    password varchar(255),
    dark boolean default 0
);

create table cookies(
	id integer auto_increment primary key,
    hash varchar(255) not null,
    user integer not null,
    expires bigint not null,
    foreign key(user) references users(id) on delete cascade on update cascade
);

CREATE TABLE fumetti(
id_fumetto integer primary key, 
id_utente integer ,
contenuto json ,  /*conterra il mio oggetto*/
index id_idx(id_utente),
data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /*per selezionare quello corrente */
foreign key (id_utente) references users(id) 
)Engine='InnoDB';

CREATE TABLE canzoni(
	id_canzone varchar(255) primary key,
    id_utente integer not null,
    contenuto json,
    index id_idx(id_utente),
    data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /*per selezionare quello corrente */
    foreign key (id_utente) references users(id)
)Engine='InnoDB';

CREATE TABLE gifs(
id_gif varchar(255) primary key, 
id_utente integer ,
contenuto json ,  /*conterra il mio oggetto*/
index id_idx(id_utente),
data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /*per selezionare quello corrente */
foreign key (id_utente) references users(id)
)Engine='InnoDB';

CREATE TABLE manga(
	id_manga integer primary key auto_increment,
    contenuto json
)Engine='InnoDB';

CREATE TABLE marvel(
	id_fumetto integer primary key auto_increment,
    contenuto json
)Engine='InnoDB';

CREATE TABLE dc(
	id_fumetto integer primary key auto_increment,
    contenuto json
)Engine='InnoDB';

CREATE TABLE funko(
	id_funko integer primary key auto_increment,
    contenuto json
)Engine='InnoDB';

/* - - - - INSERIMENTI IN TABELLE STATICHE - - - - */

/* TABELLA MANGA */
INSERT INTO manga(contenuto) values ('{
    "id_manga": "1",
    "title": "One Piece 107: Avventure nel paese di Wano",
    "image": "img/home/onepiece.jpeg",
    "price": "15,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "2",
    "title": "Naruto il mito 36 di 72 terza ristampa",
    "image": "img/home/naruto.jpeg",
    "price": "10,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "3",
    "title": "Slam-Dunk: The first slam dunk contest",
    "image": "img/home/slamdunk.jpeg",
    "price": "15,00€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "4",
    "title": "One-Punch Man: Vol 10",
    "image": "img/home/punchman.jpeg",
    "price": "15,25€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "5",
    "title": "Death Note: Short Stories",
    "image": "img/home/death.jpeg",
    "price": "2,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "6",
    "title": "Demon Slayer - Kimetsu no yaiba",
    "image": "img/home/demon.jpeg",
    "price": "5,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "7",
    "title": "Detective Conan: Il mistero del cristallo",
    "image": "img/home/conan.jpeg",
    "price": "5,00€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "8",
    "title": "One Piece Capitolo 1112: Hard Aspect",
    "image": "img/home/onepiece2.jpeg",
    "price": "20,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "9",
    "title": "Naruto Volume 49: Comincia l assemblea dei cinque Kage",
    "image": "img/home/naruto2.jpeg",
    "price": "16,35€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "10",
    "title": "Demon Slayer Capitolo 191: Chi di noi è il demone",
    "image": "img/home/demon2.jpeg",
    "price": "8,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "11",
    "title": "Lupin III Capitolo 123: Questo capolavoro è mio!",
    "image": "img/home/lupinlll.jpeg",
    "price": "14,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "12",
    "title": "One-Punch Man Vol 45: Un solo pugno!",
    "image": "img/home/punchman2.jpeg",
    "price": "13,00€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "13",
    "title": "Naruto Volume 69: Inizia la primavera cremisi",
    "image": "img/home/naruto3.jpeg",
    "price": "8,00€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "14",
    "title": "Lupin III Capitolo 108: Il bollettino di Lupin",
    "image": "img/home/lupinlll2.jpeg",
    "price": "15,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "15",
    "title": "One Piece 34: Senza rumore",
    "image": "img/home/onepiece3.jpg",
    "price": "25,00€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "16",
    "title": "Naruto Shippuden Vol64: La decima coda",
    "image": "img/home/naruto3.jpg",
    "price": "26,30€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "17",
    "title": "Demon Slayer: All Inferno",
    "image": "img/home/demon3.jpg",
    "price": "20,85€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "18",
    "title": "Detective Conan: Il sorriso di Yukiko",
    "image": "img/home/tyson.jpg",
    "price": "15,50€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "19",
    "title": "Death Note: Tentativo!",
    "image": "img/home/death2.jpg",
    "price": "20,10€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "20",
    "title": "L Attacco dei giganti: Il soldato senza nome",
    "image": "img/home/giganti.jpg",
    "price": "18,05€"
}');

INSERT INTO manga(contenuto) values ('{
    "id_manga": "21",
    "title": "Bleach: Nice to meet you, I will beat you!",
    "image": "img/home/bleach.jpg",
    "price": "22,50€"
}');
/* - - - - - - - - - - - - - - - - - * /

/* TABELLA MARVEL */
INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "1",
    "title": "L incredibile Hulk di Peter David",
    "image": "img/home/hulk.jpeg",
    "price": "5,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "2",
    "title": "Iron Man: L invincibile Iron Man 2",
    "image": "img/home/ironman.jpeg",
    "price": "15,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "3",
    "title": "Thor vs Hulk: Vessilli di guerra",
    "image": "img/home/thorvshulk.jpeg",
    "price": "15,20€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "4",
    "title": "The Amazing Spider-Man: Vol 40",
    "image": "img/home/spideman.jpeg",
    "price": "10,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "5",
    "title": "Captain America: Marvel Knights",
    "image": "img/home/captainamerica.jpeg",
    "price": "18,55€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "6",
    "title": "Venom: Protettore letale",
    "image": "img/home/venom.jpeg",
    "price": "19,00€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "7",
    "title": "Guardiani della Galassia: Retaggio",
    "image": "img/home/guardiani.jpeg",
    "price": "11,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "8",
    "title": "Deadpool #48: In memoria di Wolverine",
    "image": "img/home/deadpool.jpeg",
    "price": "11,85€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "9",
    "title": "Wolverine #71: Il corocevia del coyote",
    "image": "img/home/wolverine.jpeg",
    "price": "15,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "10",
    "title": "Marvel Knights: Black Widow",
    "image": "img/home/blackwidow.jpeg",
    "price": "10,00€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "11",
    "title": "La Morte del Venomverse: Uccidere Tutti i Venom",
    "image": "img/home/venom2.jpeg",
    "price": "13,00€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "12",
    "title": "X-Men Presenta: Magneto – Mutante Malvagio",
    "image": "img/home/xman.jpeg",
    "price": "25,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "13",
    "title": "Daredevil & Echo: Male Antico",
    "image": "img/home/daredevil.jpeg",
    "price": "15,50€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "14",
    "title": "Captain Marvel: Tempesta Oscura",
    "image": "img/home/captainmarvel.jpeg",
    "price": "18,00€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "15",
    "title": "Moon Knight: Nascita e Morte",
    "image": "img/home/moonknight.jpg",
    "price": "33,25€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "16",
    "title": "Miles Morales: Il Vendicativo Avenger!",
    "image": "img/home/morales.jpg",
    "price": "9,40€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "17",
    "title": "Spidey: Anno da Matricola",
    "image": "img/home/spidey.jpg",
    "price": "11,40€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "18",
    "title": "Silver Surfer Rinascita: Legacy",
    "image": "img/home/surfer.jpg",
    "price": "17,10€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "19",
    "title": "Thanos Vince",
    "image": "img/home/thanos.jpg",
    "price": "14,25€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "20",
    "title": "Timeless: Il Futuro dell’Universo Marvel… Svelato!",
    "image": "img/home/timeless.jpg",
    "price": "24,75€"
}');

INSERT INTO marvel(contenuto) values ('{
    "id_fumetto": "21",
    "title": "A.X.E. Judgment Day",
    "image": "img/home/AXE.jpg",
    "price": "27,55€"
}');
/* - - - - - - - - - - - - - - - - - */

/* TABELLA DC COMICS */
INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "1",
    "title": "Super Man: La nascita di un eroe",
    "image": "img/home/superman.jpeg",
    "price": "2,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "2",
    "title": "Green Arrow: Emerald archer",
    "image": "img/home/arrow.jpeg",
    "price": "15,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "3",
    "title": "Acquaman: Profondità marine",
    "image": "img/home/acquaman.jpeg",
    "price": "5,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "4",
    "title": "Wonder Woman: Terra uno",
    "image": "img/home/wonderwoman.jpeg",
    "price": "8,00€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "5",
    "title": "Joker: L uomo che ha smesso di ridere",
    "image": "img/home/joker.jpeg",
    "price": "10,60€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "6",
    "title": ">Harley Devasta l Universo DC",
    "image": "img/home/harley.jpeg",
    "price": "7,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "7",
    "title": "Flash 47",
    "image": "img/home/flash.jpeg",
    "price": "4,80€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "8",
    "title": "Lanterna Verde: Il Potere di Ion",
    "image": "img/home/lanternaverde.jpeg",
    "price": "15,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "9",
    "title": "Cyborg: Le Colpe dei Padri",
    "image": "img/home/cyborg.jpeg",
    "price": "3,00€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "10",
    "title": "Batman e Joker: Il Duo Mortale",
    "image": "img/home/batmanjoker.jpeg",
    "price": "18,85€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "11",
    "title": "Justice League: Il Matrimonio di Atom e Jean Loring",
    "image": "img/home/jl.jpeg",
    "price": "8,25€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "12",
    "title": "Batman: Harley e Ivy",
    "image": "img/home/batmanhi.jpeg",
    "price": "16,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "13",
    "title": "Superman: Godfall",
    "image": "img/home/superman2.jpeg",
    "price": "15,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "14",
    "title": "Lanterna Verde/ Freccia Verde",
    "image": "img/home/lanternaverde2.jpeg",
    "price": "3,50€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "15",
    "title": "Shazam! 1",
    "image": "img/home/shazam.jpg",
    "price": "18,05€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "16",
    "title": "Teen Titans: I Migliori del Mondo – Blitzkrieg",
    "image": "img/home/teen.jpg",
    "price": "19,05€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "17",
    "title": "Batman: Shadow of the Bat 1",
    "image": "img/home/batman3.jpg",
    "price": "32,30€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "18",
    "title": "V Per Vendetta",
    "image": "img/home/v.jpg",
    "price": "36,10€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "19",
    "title": "Batman/Superman: I Migliori del Mondo 1",
    "image": "img/home/batsup.jpg",
    "price": "20,90€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "20",
    "title": "Catwoman 3",
    "image": "img/home/catwoman.jpg",
    "price": "16,15€"
}');

INSERT INTO dc(contenuto) values ('{
    "id_fumetto": "21",
    "title": "Steelworks: Rinascita di un Eroe",
    "image": "img/home/steel.jpg",
    "price": "14,25€"
}');
/* - - - - - - - - - - - - - - - - - */

/* TABELLA FUNKO POP */
INSERT INTO funko(contenuto) values ('{
    "id_funko": "1",
    "title": "Funko Pop x Michael Jordan",
    "image": "img/home/mj.jpeg",
    "price": "15,50€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "2",
    "title": "Funko Pop x Harry Potter - Voldemort",
    "image": "img/home/voldemort.jpeg",
    "price": "15,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "3",
    "title": "Funko Pop x One Piece - Ace",
    "image": "img/home/ace.jpeg",
    "price": "25,50€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "4",
    "title": "Funko Pop x Marvel - Black Panther",
    "image": "img/home/marvel2.jpeg",
    "price": "20,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "5",
    "title": "Funko Pop x Naruto Shippuden - Gaara",
    "image": "img/home/gaara.jpeg",
    "price": "15,50€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "6",
    "title": "Funko Pop x Marvel - Torcia Umana",
    "image": "img/home/marvel.jpeg",
    "price": "14,20€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "7",
    "title": "Funko Pop x DC Comics - Super Man",
    "image": "img/home/dc.jpeg",
    "price": "16,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "8",
    "title": "Funko Pop x One Piece - Sanji",
    "image": "img/home/sanji.jpeg",
    "price": "15,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "9",
    "title": "Funko Pop Sport Legends - Muhammad Ali",
    "image": "img/home/ali.jpeg",
    "price": "19,25€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "10",
    "title": "Funko Pop x DC Comics - Batman",
    "image": "img/home/dc2.jpeg",
    "price": "15,55€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "11",
    "title": "Funko Pop x Harry Potter - Harry Potter",
    "image": "img/home/harry.jpeg",
    "price": "18,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "12",
    "title": "Funko Pop x NBA - Lebron James",
    "image": "img/home/lebron.jpeg",
    "price": "30,50€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "13",
    "title": "Funko Pop x Naruto Shippuden - Itachi",
    "image": "img/home/itachi.jpeg",
    "price": "25,50€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "14",
    "title": "Funko Pop x Demon Slayer - Tanjiro",
    "image": "img/home/tanjiro.jpeg",
    "price": "15,50€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "15",
    "title": "Funko Pop X NBA - Kobe Bryant",
    "image": "img/home/kobe.jpg",
    "price": "35,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "16",
    "title": "Funko Pop X One Piece - Luffy",
    "image": "img/home/luffy.jpg",
    "price": "25,30€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "17",
    "title": "Funko Pop X Naruto Shippuden - Naruto",
    "image": "img/home/naruto.jpg",
    "price": "20,85€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "18",
    "title": "Funko Pop X Sports Legends - Mike Tyson",
    "image": "img/home/tyson.jpg",
    "price": "28,00€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "19",
    "title": "Funko Pop X Dragon Ball Super - Goku",
    "image": "img/home/goku.jpg",
    "price": "20,10€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "20",
    "title": "Funko Pop X Demon Slayer - Kimetsu",
    "image": "img/home/kimetsu.jpg",
    "price": "18,05€"
}');

INSERT INTO funko(contenuto) values ('{
    "id_funko": "21",
    "title": "Funko Pop X Sports Legends - Tom Brady",
    "image": "img/home/tombrady.jpg",
    "price": "22,50€"
}');
/* - - - - - - - - - - - - - - - - */
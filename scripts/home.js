function printNoMoreContent() {
    //AGGIUNGO UN ELEMTNO CHE DERMINA LA FINE DEI POSTO CHE SONO STATI PUBBLICATI.
    const feed = document.getElementById('feed');
    const div = document.createElement('div');
    div.classList.add('the_end');
    const divd = document.createElement('div');
    divd.textContent = "I post pubblicati sono finiti.";
    const img = document.createElement('img');
    img.src = "https://media3.giphy.com/media/3og0IPZcpT7hyEZ7nW/giphy.gif";
    div.appendChild(divd);
    div.appendChild(img);
    feed.appendChild(div);
}

function fetchPosts() {
    //SE NESSUN POSTO E' PUBBLICATO ALLORA TORNA NULL, ALTRIMENTI IMPOSTA L'UTENTE SE Eì SETTATO.
    if (lastFetchedPostId === 0) return null;
    const profile = document.body.dataset.user ? "?user="+document.body.dataset.user : "";

    //ANCORA NESSUN POST E' STATO PUBBLICATO.
    if (lastFetchedPostId === null) 
        fetch("fetch_post.php"+profile).then(fetchResponse).then(fetchPostsJson);
    else 
        //RICAVO I POST CHE SONO STATI PUBBLICTI DOPO L'ULTIMO VISUALIZZATO.
        fetch("fetch_post.php?from="+lastFetchedPostId+profile).then(fetchResponse).then(fetchPostsJson);
}

function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}

function fetchPostsJson(json) {
    console.log("Fetching...");
    console.log(json);
    const feed = document.getElementById('feed');
    
    for (let i in json) {
        const post = document.getElementById('post_template').content.cloneNode(true).querySelector(".post");
        //MEMORIZZO L'ID DEL POST E MOSTRO ANCHE IL NOME DELL'AUTORE.
        post.dataset.id = post.querySelector("input[type=hidden]").value = json[i].postid;
        const name = post.querySelector(".name");
        name.textContent = json[i].name + " " + json[i].surname;
        //CONTROLLO ANCHE SE L'UTENTE E' VERIFICATO.
        if (json[i].verified === '1') {
            const verified = document.createElement('span');
            verified.classList.add('verified');
            name.appendChild(verified);
        }
        post.querySelector(".username").textContent = "#" + json[i].username;
        post.querySelector(".time").textContent = json[i].time;
        post.querySelector(".avatar img").src = json[i].propic;
        post.querySelector(".names > a").href = json[i].username;
        let content;
        //IMPOSTO IL TIPO DI VISUALIZZAZIONE IN BASE AL TIPO DI POST CHE SI VUOLE PUBBLICARE.
        if (json[i].content.type != 'text') {
            switch (json[i].content.type) {
                case 'unsplash':
                    content = document.createElement('img');
                    content.src = 'https://source.unsplash.com/'+json[i].content.id;
                    break;
                case "giphy":
                    content = document.createElement('img');
                    content.src = json[i].content.url;
                    break;
                case "spotify":
                    content = document.createElement('iframe');
                    content.src = "https://open.spotify.com/embed/track/"+json[i].content.id;
                    content.frameBorder = 0;
                    content.setAttribute('allowtransparency', 'true');
                    content.allow = "encrypted-media";
                    content.classList = "track_iframe";
                    break;
                default: break;
            }
            post.querySelector(".content").appendChild(content);
        }
        //AGGIUNGO LA CLASSE, IMPOSTO IL TESTO E CONTROLLO SE L'UTENTE HA MESSO MI PIACE AL POST CORRENTE.
        post.classList.add(json[i].content.type);
        post.querySelector(".text").textContent = json[i].content.text;
        const like = post.querySelector(".like");
        if (json[i].liked == 0) {
            //AGGIUNGO IL LISTENER PER POTER METTERE I LIKE.
            like.addEventListener('click', likePost);
        } else {
            //AGGIUNGO LA CLASSE LIKED ED ANCHE IL LISTENER PER POTER LEVARE IL LIKE.
            like.classList.remove('like');
            like.classList.add('liked');
            like.addEventListener('click', unlikePost);
        }
        const nlike = like.querySelector("span");
        nlike.textContent = json[i].nlikes;
        if (json[i].nlikes) nlike.addEventListener('click', likeView);
        post.querySelector(".comment").textContent = json[i].ncomments;
        post.querySelector(".comment").addEventListener('click', commentPost);
        post.querySelector("form").addEventListener('submit', sendNewComment);

        feed.appendChild(post);
    }
    
    if (json.length < 10) {
        lastFetchedPostId =  0;
        printNoMoreContent();
    } else {
        //MI RICAVO L'ULTIMO ELEMENTO DEL JSON.
        lastFetchedPostId = json.pop().postid;
    }
    console.log("lastfetch"+lastFetchedPostId);
    onScrollCanLoad = true;
}

function likePost(event) {
    button = event.currentTarget;

    const formData = new FormData();
    //PRENDO L'ID DEL POSTO E LO MANDO ALLA PAGINA PHP TRAMITE FETCH.
    formData.append('postid', button.parentNode.parentNode.dataset.id);
    fetch("like_post.php", {method: 'post', body: formData}).then(fetchResponse)
    .then(function (json){ return updateLikes(json, button); });

    //CAMBIO LA CLASSE DEL BOTTONE ED AGGIORNO I LISTENER.
    button.classList.remove('like');
    button.classList.add('liked');

    button.removeEventListener('click', likePost);
    button.addEventListener('click', unlikePost);
}

function updateLikes(json, button) {
    console.log(json.ok);
    if (!json.ok) return null;
    button.querySelector('span').textContent = json.nlikes;
    console.log("UPDAte" + json.nlikes);
    //MOSTRA SOLO SE EFFETTIVAMENTE QUALCUNO HA MESSO UN LIKE.
    if (json.nlikes) 
        button.querySelector('span').addEventListener('click', likeView);
    else 
        button.querySelector('span').removeEventListener('click', likeView);
}

function likeView(event) {
    const button = event.currentTarget;
    const formData = new FormData();
    formData.append('postid', button.parentNode.parentNode.parentNode.dataset.id);
    fetch("fetch_likes.php", {method: 'post', body: formData}).then(fetchResponse).then(displayModalUsers);
    document.querySelector('#modal .modal_desc').textContent = "Persone a cui piace";

    console.log('Vedi Likes');
    event.stopPropagation();
}

function unlikePost(event) {
    //PIU' O MENO SIMILE ALLA FUNZIONE LIKEPOST.
    button = event.currentTarget;

    const formData = new FormData();
    formData.append('postid', button.parentNode.parentNode.dataset.id);
    fetch("unlike_post.php", {method: 'post', body: formData}).then(fetchResponse)
    .then(function (json){ return updateLikes(json, button); });

    button.classList.remove('liked');
    button.classList.add('like');

    button.removeEventListener('click', unlikePost);
    button.addEventListener('click', likePost);
}

function displayModalUsers(json) {
    if (!json.length) return;
    const modal = document.getElementById('modal');
    const place = document.getElementById('modal_place');
    place.innerHTML = '';

    for (i in json) {
        //MOSTRO TUTTI GLI UTENTI CHE HANNO MESSO I LIKE.
        const userinfo = document.createElement('div');
        userinfo.classList.add('userinfo');
        const avatar = document.createElement('div');
        avatar.classList.add('avatar');
        userinfo.appendChild(avatar);
        const names = document.createElement('a');
        names.href = json[i].username;
        names.classList.add('names');
        userinfo.appendChild(names);
        const name = document.createElement('div');
        name.classList.add('name');
        name.textContent = json[i].name + " " + json[i].surname;
        if (json[i].verified === '1') {
            const verified = document.createElement('span');
            verified.classList.add('verified');
            name.appendChild(verified);
        }
        names.appendChild(name);
        const username = document.createElement('div');
        username.classList.add('username');
        username.textContent = "#"+json[i].username;
        names.appendChild(username);
        const propic = document.createElement('img');
        propic.src = json[i].propic;
        avatar.appendChild(propic);

        place.appendChild(userinfo);
    }

    modal.classList.remove('hidden');
    setTimeout(function(){
        modal.classList.remove('invisible');
    }, 20);

    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
    document.documentElement.style.setProperty('--scrollbar-width', scrollbarWidth+"px");
    document.body.classList.add('om');
}

function closeModal(event) {
    //CHIUSURA DELLA MODALE.
    const modal = document.getElementById('modal');
    modal.classList.add('invisible');
    setTimeout(function(){ 
        modal.classList.add('hidden'); 
    }, 300);
    document.body.classList.remove('om');
}

function commentPost(event) {
    const post =  event.currentTarget.parentNode.parentNode;
    const comments = post.querySelector(".comments");

    if (comments.clientHeight == 0) {
        //SE NON E' PRESENTE NESSUN COMMENTO.
        const formData = new FormData();
        formData.append('postid', post.dataset.id);
        fetch("fetch_or_send_comments.php", {method: 'post', body: formData}).then(fetchResponse).then(function (json){ return updateComments(json, post.querySelector(".comments")); });
    } else {
        comments.style.height = 0;
    }
}

function updateComments(json, section) {
    const container = section.querySelector(".past_messages");
    container.innerHTML = '';
    let i;
    //FACCIO SCORRERE L'ARRAY DAL COMMENTO PIU' RECENTE AL COMMENTO PIU' VECCHIO.
    for (i = Object.keys(json).length-1; i >= 0; i--) {
        //FACCIO LA CREAZIO DEGLI OGGETTI CHE CONTENGONO I COMMENTI.
        const message = document.createElement('div');
        const userinfo = document.createElement('div');
        userinfo.classList.add('userinfo');
        message.appendChild(userinfo);
        const avatar = document.createElement('div');
        avatar.classList.add('avatar');
        userinfo.appendChild(avatar);
        const av_img = document.createElement('img');
        av_img.src = json[i].propic;
        avatar.appendChild(av_img);
        const username = document.createElement('a');
        username.href = json[i].username;
        username.classList.add('username');
        username.textContent = "#"+json[i].username;
        if (json[i].verified === '1') {
            const verified = document.createElement('span');
            verified.classList.add('verified');
            username.appendChild(verified);
        }
        userinfo.appendChild(username);
        const time = document.createElement('div');
        time.classList.add('time');
        time.textContent = json[i].time;
        userinfo.appendChild(time);
        const text = document.createElement('div');
        text.classList.add('text');
        text.textContent = json[i].text;
        message.appendChild(text);

        container.appendChild(message);
    } 
    
    container.scrollTop = container.scrollHeight;
    section.style.height = section.scrollHeight;
}

function sendNewComment(event) {
    const cont = event.currentTarget.parentNode.parentNode;
    const formData = new FormData(event.currentTarget);
    fetch("fetch_or_send_comments.php", {method: 'post', body: formData}).then(fetchResponse).then(function (json){ return updateComments(json, cont); });
    const t = event.currentTarget.querySelector('input[type=text]');
    t.blur();
    t.value = "";
    event.preventDefault();
}

//LO SCROLL CHE SERVE PER AGGIORNARE I POST.
window.touchmove =  window.onscroll = function(ev) {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 2 && onScrollCanLoad) {
        onScrollCanLoad = false;
        fetchPosts();
    }
};


function customStopPropagation(event) {
    event.stopPropagation();
}

//NAVBAR MOBILE
document.addEventListener('touchstart', handleTouchStart, false); 
document.addEventListener('touchmove', handleTouchMove, false);
let xDown = null;
let yDown = null;

function handleTouchStart(evt) {
    xDown = evt.touches[0].clientX;
    yDown = evt.touches[0].clientY;
};

function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        return;
    } 
    let xUp = evt.touches[0].clientX;
    let yUp = evt.touches[0].clientY;
    let xDiff = xDown - xUp;
    let yDiff = yDown - yUp;
    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
        if ( xDiff > 0 ) closeSidenav();
        else openSidenav();
    } 

    xDown = null;
    yDown = null;
};

function openSidenav() {
    if(!window.matchMedia("(max-width: 960px)").matches) return;
    const back = document.getElementById('sidenav');
    back.classList.remove('hidden');
    setTimeout(function(){
        back.classList.remove('invisible');
        document.getElementById('sidenav_content').classList.add('open');
    }, 3);
}

function closeSidenav() {
    const back = document.getElementById('sidenav');
    back.querySelector('#sidenav_content').classList.remove('open');
    back.classList.add('invisible');
    setTimeout(function(){ 
        back.classList.add('hidden'); 
    }, 303);
}

document.getElementById('s_nav').addEventListener('click', openSidenav);
document.getElementById('sidenav').addEventListener('click', closeSidenav);
document.getElementById('sidenav').addEventListener('click', customStopPropagation);


//DARKMODE
function darkMode(event) {
    //INVIO UN FORM CON VALORI 0 O 1 CHE SERVONO PER ATTIVARE O DISATTIVARE LA DARK MODE.
    const data = new FormData();
    data.append('action', document.body.classList.contains('dark') ? 0 : 1);

    fetch('dark_mode.php', {method: 'post', body: data}).then(function(response){return response.json();}).then(
        function (json) {
            if(json.ok) document.body.classList.toggle('dark');
        }
    );
}

for (let b of document.querySelectorAll('.darkmode')) b.addEventListener('click', darkMode);


//GLI EVENT LISTENER DELLA MODALE.
let onScrollCanLoad = false;
let lastFetchedPostId = null;
document.getElementById('modal_close').addEventListener('click', closeModal);
document.querySelector('#modal .window').addEventListener('click', customStopPropagation);
document.getElementById('modal').addEventListener('click', closeModal);
fetchPosts();
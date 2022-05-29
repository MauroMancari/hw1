//TUTTO QUELLO CHE RIGUARDA SPOTIFY
function jsonSpotify(json) {
    if (!json.tracks.items.length) {noResults(); return;}
    
    const container = document.getElementById('results');
    container.innerHTML = '';
    container.className = 'spotify';

    for (let track in json.tracks.items) {
        const card = document.createElement('div');
        card.dataset.id = json.tracks.items[track].id;
        card.classList.add('track');
        const img = document.createElement('img');
        img.src = json.tracks.items[track].album.images[0].url;
        card.appendChild(img);
        const info = document.createElement('div');
        info.classList.add('info');
        const name = document.createElement('div');
        name.classList.add('name');
        name.textContent = json.tracks.items[track].name;
        info.appendChild(name);
        const author = document.createElement('div');
        author.classList.add('author');
        author.textContent = json.tracks.items[track].artists[0].name;
        info.appendChild(author);
        card.appendChild(info);
        card.addEventListener('click', selectSpotify);
        container.appendChild(card);
        }
}

function selectSpotify(event) {
    const track = event.currentTarget;
    const modal = document.getElementById('title_modal');
    modal.querySelector('textarea').value = "";
    modal.classList.remove('hidden');
    setTimeout(function(){modal.classList.remove('invisible');}, 3);
    noScroll();

    contentObj.id = track.dataset.id;

    const iframe = document.createElement('iframe');
    iframe.src = "https://open.spotify.com/embed/track/"+contentObj.id;
    iframe.frameBorder = 0;
    iframe.setAttribute('allowtransparency', 'true');
    iframe.allow = "encrypted-media";
    iframe.classList = "track_iframe";
    const placeholder = document.getElementById('modal_preview');
    placeholder.innerHTML = '';
    placeholder.appendChild(iframe);
}

//IMPOSTO TUTTO CHE CHE C'E' DA FARE SIA PER GIPHY CHE PER UNSPLASH
function jsonImage(json, type) {
    const container = document.getElementById('results');
    container.innerHTML = '';
    container.className = type;
    const columns = [];
    for (let i = 0; i < 3; i+=2) {
        let div = document.createElement('div');
        container.appendChild(div);
        for (let j = 0; j < 2; j++) {
            columns[i+j] = document.createElement('div');
            div.appendChild(columns[i+j]);
        }
    }
    columnHeights = [0, 0, 0, 0];
    for (let item in json) {
        const img = document.createElement('img');
        img.dataset.id = json[item].id;
        img.src = json[item].preview;
        img.classList.add('invisible');
        colIndexMin = columnHeights.indexOf(Math.min(...columnHeights));
        columns[colIndexMin].appendChild(img);
        columnHeights[colIndexMin] += 300 * json[item].height / json[item].width;  
        img.onload = function(){img.classList.remove('invisible');};
        img.addEventListener('click', selectImage);
    }
}

function selectImage(event) {
    const modal = document.getElementById('title_modal');
    //modal.querySelector('textarea').value = "";
    modal.classList.remove('hidden');
    setTimeout(function(){modal.classList.remove('invisible');}, 3);
    noScroll();

    const img = document.createElement('img');
    img.src = event.currentTarget.src;
    contentObj.id = event.currentTarget.dataset.id;
    const placeholder = document.getElementById('modal_preview');
    placeholder.innerHTML = '';
    placeholder.appendChild(img);
}

// NOSCROLL 
function noScroll() {
    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
    document.documentElement.style.setProperty('--scrollbar-width', scrollbarWidth+"px");
    document.body.classList.add('om');
}


// CERCA
function noResults() {
    // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
    const container = document.getElementById('results');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "loading";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
}

function search(event)
{
    //LEGGO SIA IL TIPO CHE IL CONTENUTO DA CERCARE E MANDO TUTTE COSE ALLA PAGE PHP.
    contentObj = {};
    const form_data = new FormData(document.querySelector("#newpost form"));
    contentObj.type = form_data.get('type');
    //QUI MANDO TUTTE LE SPECIFICHE DELLA RUCHESTA ALLA PAGE PHP IN MODO CHE PREPARA LA RICHIESTA E LA INOLTRA.
    fetch("do_search_content.php?type="+contentObj.type+"&q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(searchJson);
    document.getElementById('searchbox').blur();

    //ADESSO MOSTRO TUTTI I RISULTATI CHE SONO STATI OTTENUTI.
    const container = document.getElementById('results');
    container.innerHTML = '';
    const loading = document.createElement('img');
    loading.src = "./assets/loading.svg";
    loading.className = "loading";
    container.appendChild(loading);

    //EVITO CHE VENGA ESEGUITA LA RICARICA AUTOMATICA DELLA PAGINA.
    event.preventDefault();
}

function searchResponse(response)
{
    console.log(response);
    return response.json();
}

function searchJson(json)
{
    console.log(json);

    if (!json.length && contentObj.type != 'spotify') { noResults(); return; }

    switch (contentObj.type) {
        case 'unsplash': jsonImage(json, 'unsplash'); break;
        case 'giphy': jsonImage(json, 'giphy'); break;
        case 'spotify': jsonSpotify(json); break;
    }
}


//TUTTA LA PARTE CHE RIGUARDA LA MODALE

function closeModal(event) {
    console.log('chiudo');
    const modal = document.getElementById('title_modal');
    modal.classList.add('invisible');
    setTimeout(function(){ 
        modal.classList.add('hidden'); 
        modal.classList.remove('flip');
        document.getElementById('dispatch_result_fail').classList.add('hidden', 'invisible');
        document.getElementById('dispatch_result_success').classList.add('hidden', 'invisible');
        //document.getElementById('title_form').classList.remove('hidden', 'invisible');
        for (let svg of modal.querySelectorAll('svg')) svg.classList.remove('animated');
        modal.querySelector("#modal_preview").innerHTML = '';
    }, 300);
    document.body.classList.remove('om');
}

function createNewPost(event)
{
    //PREPATO TUTTI I DATI CHE SI DEBBONO MANDARE E AL SERVER E IN VIO LA RICHIESTA CN POST.
    const formData = new FormData(document.querySelector("#title_modal form"));
    formData.append('type', contentObj.type);
    formData.append('id', contentObj.id);
    fetch("post_dispatcher.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);

    event.preventDefault();
}

function dispatchResponse(response) {
    //AGGIUNGO ANIMAZIONI E CONTROLLO IL RISULTATO DELLA RICHIESTA.
    document.getElementById('title_modal').classList.add('flip');

    if(!response.ok) {
        dispatchError();
        return null;
    }
    console.log(response);
    return response.json().then(databaseResponse); 
}

function dispatchError(error) { 
    const result = document.getElementById('dispatch_result_fail');
    result.classList.remove('hidden');
    setTimeout(function(){ result.classList.remove('invisible'); }, 3);
    result.querySelector('svg').classList.add('animated');
}

function databaseResponse(json) {
    if (!json.ok) {
        dispatchError();
        return null;
    }
    /*
    const form = document.getElementById('title_form');
    form.classList.add('invisible');
    setTimeout(function(){ form.classList.add('hidden'); }, 400)
    */
    const result = document.getElementById('dispatch_result_success');
    result.classList.remove('hidden');
    setTimeout(function(){ result.classList.remove('invisible'); }, 3);
    result.querySelector('svg').classList.add('animated');
}

function customStopPropagation(event) {
    event.stopPropagation();
}

let contentObj = {}; 
let columnHeights;
document.querySelector("#newpost form").addEventListener("submit", search);
document.querySelector("#think").addEventListener("click", selectText);
document.getElementById('close_modal').addEventListener('click', closeModal);
document.getElementById('modal_newpost_fail').addEventListener('click', closeModal);
document.getElementById('modal_newpost_success').addEventListener('click', closeModal);
document.getElementById('title_modal').addEventListener('click', closeModal);
document.querySelector('#title_modal .window').addEventListener('click', customStopPropagation);
document.querySelector("#title_modal form").addEventListener("submit", createNewPost);

//AGGIUNGO UN EVENT LISTENER AI BUTTON PER SELEZIONARE IL CONTENUTO DA PUBBLICARE.
for (let r of document.querySelectorAll('#newpost input[type=radio]')) r.addEventListener('click', changeType);
let currentSelection = null;

function changeType(event) {
    //CAMBIO LE CLASSI DEGLI OGGETTI CHE SONO STATI DESELEZIONATI. SE CLICCO SU UN TIPO GIA' SELEZIONATO LO DESELEZIONO.
    for (let v of document.querySelectorAll("header .visible")) v.classList.remove('visible');
    for (let s of document.querySelectorAll("header .selected")) s.classList.remove('selected');
    const searchBox = document.querySelector("#newpost input[type=text]");
    searchBox.disabled = true;
    if (currentSelection === event.currentTarget) {
        currentSelection = null;
        return;
    }

    currentSelection = event.currentTarget;
    currentSelection.parentNode.classList.add('selected');

    //IN BASO A COSA VIENE SELEZIONATO, IMPOSTO GLI ELEMENTI DI PUBBLICAZIONE DEL POST.
    
    if (currentSelection.value === "text") {
        document.querySelector("header ."+currentSelection.value).classList.add('visible');
        document.querySelector(".think").classList.add("visible");
    } else if (currentSelection.value !== "text") {
        searchBox.classList.add('visible');
        searchBox.disabled = false;
        searchBox.value = '';
        document.querySelector("header ."+currentSelection.value).classList.add('visible');
    } else {
        for (let v of document.querySelectorAll("header .visible")) v.classList.remove('visible');
        searchBox.disabled = true;
        return;
    }
}



//NAVBAR
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

//SETTAGGIO DARKMODE
function darkMode(event) {
    const data = new FormData();
    data.append('action', document.body.classList.contains('dark') ? 0 : 1);

    fetch('dark_mode.php', {method: 'post', body: data}).then(function(response){return response.json();}).then(
        function (json) {
            if(json.ok) document.body.classList.toggle('dark');
        }
    );
}

for (let b of document.querySelectorAll('.darkmode')) b.addEventListener('click', darkMode);
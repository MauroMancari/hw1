function saveResponse(response){
    return response.json();
}

function saveJSON(json){
    if(!json.ok){
        console.log('ERRORE');
        return null;
    }
}

function saveFumetto(event){
    console.log('Salvataggio');
    const formData = new FormData(); //CREAO UN OGGETTO NUOVO DEL FORM

    idFumetto = event.currentTarget.parentNode.querySelector('a');
    title = event.currentTarget.parentNode.querySelector('strong');
    image = event.currentTarget.parentNode.querySelector('img');
    year = event.currentTarget.parentNode.querySelector('h5');
    desc = event.currentTarget.parentNode.querySelector('p');

    formData.append('id_fumetto', idFumetto.textContent);
    formData.append('title', title.textContent);
    formData.append('image', image.src);
    formData.append('year', year.textContent);
    formData.append('description', desc.textContent);

    fetch('saveFumetto.php', {method: 'post', body: formData}).then(saveResponse).then(saveJSON);

    bottone = event.currentTarget.parentNode.querySelector('button');
    bottone.textContent = 'Salvato!';

    console.log(event.currentTarget.parentNode); //VISUALIZZO I VARI NODI DEL DOOM
}

function saveCanzone(event){
    console.log('Salvataggio canzone');
    const formData = new FormData();

    idCanzone = event.currentTarget.parentNode.querySelector('h6');
    title = event.currentTarget.parentNode.querySelector('strong');
    image = event.currentTarget.parentNode.querySelector('img');
    author = event.currentTarget.parentNode.querySelector('h2');

    formData.append('id_canzone', idCanzone.textContent);
    formData.append('title', title.textContent);
    formData.append('image', image.src);
    formData.append('author', author.textContent);

    fetch('saveCanzone.php', {method: 'post', body: formData}).then(saveResponse).then(saveJSON);

    bottone = event.currentTarget.parentNode.querySelector('button');
    bottone.textContent = 'Salvato!';

    console.log(event.currentTarget.parentNode);
}

function saveGif(event){
    console.log('Salvataggio gif');
    const button = event.currentTarget;
    const img = document.createElement('img');
    const formData = new FormData();
    
    button.innerHTML = '';
    img.src = 'assets/likeR.svg';
    button.appendChild(img);

    idGif = event.currentTarget.parentNode.querySelector('h6');
    imageGif = event.currentTarget.parentNode.querySelector('img');

    formData.append('id_gif', idGif.textContent);
    formData.append('image', imageGif.src);

    fetch('saveGif.php', {method: 'post', body: formData}).then(saveResponse).then(saveJSON);

    console.log(event.currentTarget.parentNode);    
}

function chiudiModale(event){
    console.log('chiusura modale');
    const box = document.querySelector('.modale');

    event.currentTarget.classList.add('hidden');
    box.classList.remove('modale');
    box.classList.remove('nonModale');
    box.querySelector('.modalInfo').classList.remove('infoModale');
    document.body.classList.remove('no-scroll');
}

function apriModale(event){
    console.log('Apri modale');

    if(!event.currentTarget.classList.contains('modale')){
        document.body.classList.add('no-scroll');
        overlay.style.top = window.pageYOffset + 'px';
        overlay.classList.remove('hidden');
        event.currentTarget.classList.remove('nonModale');
        event.currentTarget.classList.add('modale');
        event.currentTarget.querySelector('.modalInfo').classList.add('infoModale');
    }else{
        console.log('Già selezionata');
    }
}

function marvelOnJSON(json){
    console.log(json); //MI SERVE PER VEDERE L'OGGETTO SERIALIZZATO
    const container = document.querySelector('#results');
    const result = json.data.results;

    container.innerHTML = '';
    if(!json.data.results.length){
        nessunRisultato();
        return;
    }

    for(let i = 0; i < result.length; i++){
        const box = document.createElement('div');
        const valore = result[i]; //SALVO I VALORI DELL'ARRAY IN QUESTA COSTANTE.
        const idContainer = document.createElement('a');
        const titleContainer = document.createElement('strong');
        const buttonContainer = document.createElement('button');
        const imageContainer = document.createElement('img');
        const yearContainer = document.createElement('h5');
        const descContainer = document.createElement('p');
        const boxInfo = document.createElement('div');

        box.classList.add('box');
        buttonContainer.classList.add('bottone');

        idContainer.textContent = valore.id;
        titleContainer.textContent = valore.title;
        buttonContainer.textContent = 'Salva tra i preferiti';
        imageContainer.src = valore.thumbnail.path +'/portrait_uncanny.jpg'; //PER OTTENERE L'IMMAGINE DEVO RICAVARMI ANCHE IL PATH
        yearContainer.textContent = 'Anno uscita: ' + valore.startYear;
        descContainer.textContent = valore.description;

        boxInfo.classList.add('boxInfo');
        boxInfo.appendChild(titleContainer);
        boxInfo.appendChild(imageContainer);
        boxInfo.appendChild(idContainer);
        boxInfo.appendChild(yearContainer);
        boxInfo.appendChild(buttonContainer);
        boxInfo.appendChild(descContainer);

        const fumettoInfo = document.createElement('div');
        fumettoInfo.classList.add('modalInfo');
        fumettoInfo.appendChild(descContainer);
        boxInfo.appendChild(fumettoInfo);

        box.appendChild(boxInfo);

        const bottone = box.querySelector('button');
        bottone.addEventListener('click', function(event){
            event.stopPropagation(); //MI PERMETTE DI EVITARE CHE QUANDO CLICCO IL BOTTONE MI SI APRE LA MODALE
        });

        bottone.addEventListener('click', saveFumetto); //APPENA CLICCO SALVO IL FUMETTO.

        box.classList.add('nonModale');
        box.addEventListener('click', apriModale);

        container.appendChild(box);
    }
}

function spotifyOnJSON(json){
    console.log(json);
    const container = document.querySelector('#results');

    container.innerHTML = '';
    if(!json.tracks.items.length){
        nessunRisultato();
        return;
    }

    for(let track in json.tracks.items){
        const box = document.createElement('div');
        const idContainer = document.createElement('h6');
        const titleContainer = document.createElement('strong');
        const buttonContainer = document.createElement('button');
        const imageContainer = document.createElement('img');
        const authContainer = document.createElement('h2');
        const boxInfo = document.createElement('div');
        
        box.classList.add('box');
        buttonContainer.classList.add('bottone');

        idContainer.textContent = json.tracks.items[track].id;
        titleContainer.textContent = json.tracks.items[track].name;
        buttonContainer.textContent = 'Salva tra i preferiti';
        imageContainer.src = json.tracks.items[track].album.images[0].url;
        authContainer.textContent = json.tracks.items[track].artists[0].name;
        
        boxInfo.classList.add('boxInfo');
        boxInfo.appendChild(titleContainer);
        boxInfo.appendChild(imageContainer);
        boxInfo.appendChild(buttonContainer);
        boxInfo.appendChild(authContainer);
        
        const spotifyInfo = document.createElement('div');
        spotifyInfo.classList.add('modalInfo');
        spotifyInfo.appendChild(authContainer);
        spotifyInfo.appendChild(idContainer);
        boxInfo.appendChild(spotifyInfo);
        
        box.appendChild(boxInfo);
        
        const bottone = box.querySelector('button');
        bottone.addEventListener('click', function(event){
            event.stopPropagation(); //MI PERMETTE DI EVITARE CHE QUANDO CLICCO IL BOTTONE MI SI APRE LA MODALE
        });

        bottone.addEventListener('click', saveCanzone); //APPENA CLICCO SALVO LA CANZONE.
        
        box.classList.add('nonModale');
        box.addEventListener('click', apriModale);

        container.appendChild(box);
    }
}

function gifOnJSON(json){
    console.log(json);
    const container = document.querySelector('#results');

    container.innerHTML = '';
    container.className = 'gif';
    if(!json.length){
        nessunRisultato();
        return;
    }

    for(let i = 0; i < json.length; i++){
        const album = document.createElement('div');
        const idGif = document.createElement('h6');
        const imageGif = document.createElement('img');
        const img = document.createElement('img');
        const buttonContainer = document.createElement('button');

        img.src = 'assets/likeW.svg';

        album.classList.add('album');
        imageGif.classList.add('gif');
        buttonContainer.classList.add('likeButton');
        
        idGif.textContent = json[i].id;
        imageGif.src = json[i].preview;
        buttonContainer.appendChild(img);

        album.appendChild(imageGif);
        album.appendChild(idGif);
        album.appendChild(buttonContainer);

        const bottone = album.querySelector('button');
        bottone.addEventListener('click', saveGif);

        album.classList.add('nonModale');
        container.appendChild(album);
    }

}

function nessunRisultato(){
    const container = document.querySelector('#results');
    const div = document.createElement('div');

    container.innerHTML = '';
    div.textContent = 'Nessun risultato.';
    container.appendChild(div);

}

function searchResponse(response){
    console.log(response);
    return response.json();
}

function search(event){
    event.preventDefault(); //IMPEDISCO IL COMPORTAMENTO DI DEFAULT DEL SUBMIT IN MODO DA PREVENIRE L'ERROR NOT FOUND
    const content = document.querySelector('.searchBar').value;
    const tipo = document.querySelector('#tipo').value;

    if(tipo === 'titolo'){
        console.log('Stai cercando il fumetto che si chiama: '+ encodeURIComponent(content));
        const URL = 'searchTitle.php?q='+encodeURIComponent(content);

        fetch(URL).then(searchResponse).then(marvelOnJSON);
    }else if(tipo === 'musica'){
        console.log('Stai cercando la canzone: ' + encodeURIComponent(content));
        const URL = 'searchSong.php?q='+encodeURIComponent(content);

        fetch(URL).then(searchResponse).then(spotifyOnJSON);
    }else if(tipo === 'gif'){
        console.log('Stai cercando la gif di: ' + encodeURIComponent(content));
        const URL = 'searchGif.php?q='+encodeURIComponent(content);

        fetch(URL).then(searchResponse).then(gifOnJSON);
    }
}

function openSideMenu(event){
    const nav = document.querySelector('.nav');

    nav.classList.toggle('wide');
}

// SELEZIONO IL FORM PER LA RICERCA DEI FUMETTI
const form = document.querySelector('#search form');
form.addEventListener('submit', search);

const overlay = document.querySelector('#overlay');
overlay.addEventListener('click', chiudiModale);

//APRO IL MENU LATERALE
const showMenu = document.querySelector('.navbar');
showMenu.addEventListener('click', openSideMenu);
function chiudiModale(event){
    console.log('Modale chiusa');
    event.currentTarget.classList.add('hidden');
    const box = document.querySelector('.modale');
    const fumettoInfo = box.querySelector('.modalInfo');

    box.classList.remove('modale');
    box.classList.remove('nonModale');

    if(fumettoInfo) fumettoInfo.classList.remove('infoModale');
    document.body.classList.remove('no-scroll');

}

function apriModale(event){
    if(!event.currentTarget.classList.contains('modale')){
        document.body.classList.add('no-scroll');
        overlay.style.top = window.pageYOffset + 'px';
        overlay.classList.remove('hidden');
        event.currentTarget.classList.remove('nonModale');
        event.currentTarget.classList.add('modale');
        event.currentTarget.querySelector('.modalInfo').classList.add('infoModale');
    }
}

function deleteResponse(response){
    return response.json();
}

function deleteJSON(json){
    if(!json.ok){
        console.log('errore');
        return null;
    }
}

function rimuoviFumetto(event){
    console.log('Fumetto rimosso');
    const formData = new FormData(); //CREO UN NUOVO OPGGETTO DEL FORM

    id_fumetto = event.currentTarget.parentNode.querySelector('a');
    title = event.currentTarget.parentNode.querySelector('strong');
    image = event.currentTarget.parentNode.querySelector('img');
    year = event.currentTarget.parentNode.querySelector('h5');
    desc = event.currentTarget.parentNode.querySelector('p');

    formData.append('id_fumetto', id_fumetto.textContent);
    formData.append('title', title.textContent);
    formData.append('image', image.src);
    formData.append('year', year.textContent);
    formData.append('description', desc.textContent);

    fetch('deleteFumetto.php', {
        method: 'post',
        body: formData
    }).then(deleteResponse).then(deleteJSON);

    bottone = event.currentTarget.parentNode.querySelector('button');
    bottone.textContent = 'Rimosso!';
}

function rimuoviCanzone(event){
    console.log('Canzone rimossta!');
    const formData = new FormData();

    idCanzone = event.currentTarget.parentNode.querySelector('h6');
    title = event.currentTarget.parentNode.querySelector('strong');
    image = event.currentTarget.parentNode.querySelector('img');
    author = event.currentTarget.parentNode.querySelector('h2');

    formData.append('id_canzone', idCanzone.textContent);
    formData.append('title', title.textContent);
    formData.append('image', image.src);
    formData.append('author', author.textContent);

    fetch('deleteCanzone.php', {method: 'post', body: formData}).then(deleteResponse).then(deleteJSON);

    bottone = event.currentTarget.parentNode.querySelector('button');
    bottone.textContent = 'Rimosso!';

    console.log(event.currentTarget.parentNode);
}

function rimuoviGif(event){
    console.log('Gif rimossa!');
    const button = event.currentTarget;
    const img = document.createElement('img');
    const formData = new FormData();

    button.innerHTML = '';
    img.src = 'assets/closeX2.png';
    button.appendChild(img);

    idGif = event.currentTarget.parentNode.querySelector('h6');
    imageGif = event.currentTarget.parentNode.querySelector('img');

    formData.append('id_gif', idGif.textContent);
    formData.append('image', imageGif.src);

    fetch('deleteGif.php', {method: 'post', body: formData}).then(deleteResponse).then(deleteJSON);

    console.log(event.currentTarget.parentNode);
}

function fumettiJSON(json){
    console.log('Ricerca..');
    console.log(json);
    const container = document.querySelector('#results');

    container.innerHTML = '';
    if(!json.length){
        nessunRisultato();
        return;
    }

    for(let i = 0; i < json.length; i++){
        const box = document.createElement('div');
        const valore = json[i].contenuto;
        const idContainer = document.createElement('a');
        const titleContainer = document.createElement('strong');
        const buttonContainer = document.createElement('button');
        const imageContainer = document.createElement('img');
        const yearContainer = document.createElement('h5');
        const descContainer = document.createElement('p');

        box.classList.add('box');
        buttonContainer.classList.add('bottone');

        idContainer.textContent = valore.id_fumetto;
        titleContainer.textContent = valore.title;
        buttonContainer.textContent = 'Rimuovi dai preferiti';
        imageContainer.src = valore.image;
        yearContainer.textContent = 'Anno uscita: ' + valore.year;
        descContainer.textContent = valore.descrizione;

        const boxInfo = document.createElement('div');
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
            event.stopPropagation();
        });
        bottone.addEventListener('click', rimuoviFumetto);

        box.classList.add('nonModale');
        box.addEventListener('click', apriModale);

        container.appendChild(box);
    }
}

function canzoniJSON(json){
    console.log(json);
    const container = document.querySelector('#results2');

    container.innerHTML = '';
    if(!json.length){
        nessunRisultato();
        return;
    }

    for(let i = 0; i < json.length; i++){
        const box = document.createElement('div');
        const valore = json[i].contenuto;
        const idContainer = document.createElement('h6');
        const titleContainer = document.createElement('strong');
        const buttonContainer = document.createElement('button');
        const imageContainer = document.createElement('img');
        const authContainer = document.createElement('h2');
        const boxInfo = document.createElement('div');

        box.classList.add('box');
        buttonContainer.classList.add('bottone');

        idContainer.textContent = valore.id_canzone;
        titleContainer.textContent = valore.title;
        buttonContainer.textContent = 'Rimuovi dai preferiti';
        imageContainer.src = valore.image;
        authContainer.textContent = valore.author;

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

        bottone.addEventListener('click', rimuoviCanzone);
        
        box.classList.add('nonModale');
        box.addEventListener('click', apriModale);

        container.appendChild(box);
    }
}

function gifJSON(json){
    console.log(json);
    const container = document.querySelector('#results3');

    container.innerHTML = '';
    container.className = 'gif';
    if(!json.length){
        nessunRisultato();
        return;
    }
    
    for(let i = 0; i < json.length; i++){
        const album = document.createElement('div');
        const valore = json[i].contenuto;
        const idGif = document.createElement('h6');
        const imageGif = document.createElement('img');
        const buttonContainer = document.createElement('button');
        const img = document.createElement('img');

        img.src = 'assets/closeX.png';

        album.classList.add('album');
        imageGif.classList.add('gif');
        buttonContainer.classList.add('likeButton');
        
        idGif.textContent = valore.id_gif;
        imageGif.src = valore.image;
        buttonContainer.appendChild(img);

        album.appendChild(imageGif);
        album.appendChild(idGif);
        album.appendChild(buttonContainer);

        const bottone = album.querySelector('button');
        bottone.addEventListener('click', rimuoviGif);

        album.classList.add('nonModale');
        container.appendChild(album);
    }
}

function nessunRisultato(){
    const container = document.querySelector('#results');
    const div = document.createElement('div');

    container.innerHTML = '';
    div.textContent = 'Nessun elemento salvato!';

    container.appendChild(div);
}

function onResponse(response){
    return response.json();
}

function openSideMenu(event){
    const nav = document.querySelector('.nav');

    nav.classList.toggle('wide');
}

fetch('fumettiSelection.php').then(onResponse).then(fumettiJSON);
fetch('canzoniSelection.php').then(onResponse).then(canzoniJSON);
fetch('gifSelection.php').then(onResponse).then(gifJSON);

const overlay = document.querySelector('#overlay');
overlay.addEventListener('click', chiudiModale);

const showMenu = document.querySelector('.navbar');
showMenu.addEventListener('click', openSideMenu)
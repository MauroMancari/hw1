function dcJSON(json){
    console.log(json);
    const container = document.querySelector('#results');
    
    if(!json.length){
        nessunRisultato();
        return;
    }

    for(let i = 0; i < json.length; i++){
        const valore = json[i].contenuto;
        const list = document.createElement('div');
        const boxLink = document.createElement('a');
        const card = document.createElement('div');
        const textBlock = document.createElement('div');
        const titleContainer = document.createElement('h3');
        const priceContainer = document.createElement('h4');
        const price = document.createElement('span');
        const imageContainer = document.createElement('img');

        list.classList.add('list');
        boxLink.classList.add('box-link')
        card.classList.add('card');
        textBlock.classList.add('text-block');
        titleContainer.classList.add('caption');
        priceContainer.classList.add('prezzo');
        imageContainer.classList.add('slider-img');

        titleContainer.textContent = valore.title;
        price.textContent = valore.price;
        imageContainer.src = valore.image;       
        
        textBlock.appendChild(titleContainer);
        textBlock.appendChild(priceContainer);
        priceContainer.appendChild(price);
        card.appendChild(textBlock);
        card.appendChild(imageContainer);

        boxLink.appendChild(card);

        container.appendChild(boxLink);
    }

}

function openSideMenu(event){
    const nav = document.querySelector('.nav');

    nav.classList.toggle('wide');
}

function dropDownMenu(event){
    const subMenu = document.querySelector('.sub-menu');

    subMenu.classList.toggle('show');
}

function nessunRisultato(){
    const container = document.querySelector('#results');
    const div = document.createElement('div');

    container.innerHTML = '';
    div.textContent = 'Nessun elemento presente!';

    container.appendChild(div);
}

function onResponse(response){
    return response.json();
}

fetch('dcSelection.php').then(onResponse).then(dcJSON);

const showMenu = document.querySelector('.navbar');
showMenu.addEventListener('click', openSideMenu)

const dropButton = document.querySelector('#menu-item');
dropButton.addEventListener('click', dropDownMenu);
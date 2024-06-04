function createImage(src){
    const image = document.createElement('img');

    image.src = src;
    return image;
}

function onImageClick(event){
    console.log('Hai cliccato l immagine');
    const image = createImage(event.currentTarget.src);

    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    modalView.appendChild(image);
    modalView.classList.remove('hidden');
}

function onModalClick(){
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
}

function autoScroll(){
    //FUNZIONE CHE SERVE PER FAR GIRARE AUTOMATICAMENTE LE IMMAGINI PRESENTI NELLA SEZIONE (SECTION-IMG)
    document.querySelector('#radio' + counter).checked = true; //PRENDO TUTTI GLI ELEMENTI CHE HANNO ID RADIO E GLI CONCATENO UN NUMERO CHE VIENE INCREMENTATO FINO A 4. QUESTO PERCHE' GLI ID SONO RADIO1, RADIO2.. ECC.
    const buttons = document.querySelector('#radio' + counter);
    const home = document.querySelectorAll('.home-slider');
    const container = document.querySelector('.isVisible');

    counter++;
    
    if(counter > 4){
        counter = 1;
    }

    for(let i = 0; i < home.length; i++){
        if(buttons.dataset.index === 'primo' && home[0].dataset.index === 'primo'){
            home[0].classList.remove('hidden');
            
            home[1].classList.add('hidden');
            home[2].classList.add('hidden');
            home[3].classList.add('hidden');            
        }
        if(buttons.dataset.index === 'secondo' && home[1].dataset.index === 'secondo'){
            home[1].classList.remove('hidden');

            home[0].classList.add('hidden');
            home[2].classList.add('hidden');
            home[3].classList.add('hidden');
        }
        if(buttons.dataset.index === 'terzo' && home[2].dataset.index === 'terzo'){
            home[2].classList.remove('hidden');

            home[0].classList.add('hidden');
            home[1].classList.add('hidden');
            home[3].classList.add('hidden');
        }
        if(buttons.dataset.index === 'quarto' && home[3].dataset.index === 'quarto'){
            home[3].classList.remove('hidden');

            home[0].classList.add('hidden');
            home[1].classList.add('hidden');
            home[2].classList.add('hidden');
        }
    }
}
setInterval(autoScroll, 3000); //SETTO UN INTERVALLO DI 3S PER FAR SCORRERE LE IMMAGINI.

function slideInfo(event){
    const sliderInfo = event.currentTarget;
    const slide = document.querySelectorAll('.slide');
    const container = document.createElement('div');
    const info = document.createElement('div');
    const info2 = document.createElement('div');

    const titolo = document.createElement('h2');
    const button = document.createElement('span');
    const txt = document.createElement('p');

    const image0 = document.createElement('img');
    const image1 = document.createElement('img');
    const image2 = document.createElement('img');
    const image3 = document.createElement('img');

    container.classList.add('isVisible');
    button.classList.add('button');
    info.classList.add('info');
    info2.classList.add('info2');

    image0.src = 'https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/Banner-2.png';
    image1.src = 'https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/Senza-nome-1.png';
    image2.src = 'https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/LOL-banner.png';
    image3.src = 'https://comicscorner.b-cdn.net/wp-content/uploads/2024/03/Banner-Sin-City-2.png';
    button.textContent = 'Guarda';    
    
    for(let i = 0; i < slide.length; i++){
        if(sliderInfo.dataset.index === 'primo' && slide[0].dataset.index === 'primo'){
            //0           
            titolo.textContent = 'The First Slam Dunk Re: Source';
            txt.textContent = "Scopri il dietro le quinte del premio per la miglior animazione dell'anno ai ''Japan Academy Awards 2023''";
            info.appendChild(titolo);
            info.appendChild(info2);
            info2.appendChild(txt);
            container.appendChild(info);
            container.appendChild(button);
            slide[0].appendChild(container);

            slide[1].innerHTML = '';
            slide[2].innerHTML = '';
            slide[3].innerHTML = '';

            slide[1].appendChild(image1);
            slide[2].appendChild(image2);
            slide[3].appendChild(image3);
        }
        
        if(sliderInfo.dataset.index === 'secondo' && slide[1].dataset.index === 'secondo'){
            //1           
            titolo.textContent = 'Make The Exorcist Fall In Love';
            txt.textContent = "Il nuovo manga di Paninni disponibile sia in versione regular che nella versione variant, in esclusiva per le fumetterie";
            info.appendChild(titolo);
            info.appendChild(info2);
            info2.appendChild(txt);
            container.appendChild(info);
            container.appendChild(button);
            slide[1].appendChild(container);

            slide[0].innerHTML = '';
            slide[2].innerHTML = '';
            slide[3].innerHTML = '';

            slide[0].appendChild(image0);
            slide[2].appendChild(image2);
            slide[3].appendChild(image3);
        }

        if(sliderInfo.dataset.index === 'terzo' && slide[2].dataset.index === 'terzo'){
            //2
            titolo.textContent = 'The Art Of Arcane - Deluxe Hardcover';
            txt.textContent = "Tutti i retroscena della serie TV di Netflix , in un fantastico volume";
            info.appendChild(titolo);
            info.appendChild(info2);
            info2.appendChild(txt);
            container.appendChild(info);
            container.appendChild(button);        
            slide[2].appendChild(container);

            slide[0].innerHTML = '';
            slide[1].innerHTML = '';
            slide[3].innerHTML = '';

            slide[0].appendChild(image0);
            slide[1].appendChild(image1);
            slide[3].appendChild(image3);
        }

        if(sliderInfo.dataset.index === 'quarto' && slide[3].dataset.index === 'quarto'){
            //3
            titolo.textContent = 'Sin City (Star Comics)';
            txt.textContent = "L'epopea neo-noir di Frank Miller ritorna con tre diverse edizioni";
            info.appendChild(titolo);
            info.appendChild(info2);
            info2.appendChild(txt);
            container.appendChild(info);
            container.appendChild(button);            
            slide[3].appendChild(container);

            slide[0].innerHTML = '';
            slide[1].innerHTML = '';
            slide[2].innerHTML = '';

            slide[0].appendChild(image0);
            slide[1].appendChild(image1);
            slide[2].appendChild(image2);
        }        
    }
}

function changeSliderRight(event){
    const btnR = event.currentTarget;

    for(let i = 0; i < carousel.length; i++){
        const firstCardWidth = carousel[i].querySelector('.card').offsetWidth;
        
        if(btnR.dataset.index === 'primo'){
            carousel[0].scrollLeft += firstCardWidth;
        }else if(btnR.dataset.index === 'secondo'){
            carousel[1].scrollLeft += firstCardWidth;
        }
        else if(btnR.dataset.index === 'terzo'){
            carousel[2].scrollLeft += firstCardWidth;
        }
        else if(btnR.dataset.index === 'quarto'){
            carousel[3].scrollLeft += firstCardWidth;
        }
    }
}
function changeSliderLeft(event){
    const btnL = event.currentTarget;

    for(let i = 0; i < carousel.length; i++){
        const firstCardWidth = carousel[i].querySelector('.card').offsetWidth;
        
        if(btnL.dataset.index === 'primo'){
            carousel[0].scrollLeft += -firstCardWidth;
        }else if(btnL.dataset.index === 'secondo'){
            carousel[1].scrollLeft += -firstCardWidth;
        }
        else if(btnL.dataset.index === 'terzo'){
            carousel[2].scrollLeft += -firstCardWidth;
        }
        else if(btnL.dataset.index === 'quarto'){
            carousel[3].scrollLeft += -firstCardWidth;
        }
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


/* - - - - - - DICHIARAZIONI GENERALI - - - - - - */
let isVisible = false;
let isClicked = false;
let isOver = false;
let isComics = false;
let i = 0;
let counter = 2;
let inc = 1;
const res = 10;

/* LA SEGUENTE PARTE DI CODICE L'HO PRESA SEGUENDO UN VIDEO IN QUANTO HO AVUTO DIFFICOLTA' CON LA REALIZZAZIONE DI UNO SLIDER PER IL CONTENUTO DELLA SEZIONE ALBUM-VIEW */
const carousel = document.querySelectorAll('.list');
let isDragging = false, startX, startScrollLeft;

for(let caro of carousel){
    const firstCardWidth = caro.querySelector('.card').offsetWidth;
    let cardPerView = Math.round(caro.offsetWidth / firstCardWidth);
    const carouselChildrens = [...caro.children];

    carouselChildrens.slice(-cardPerView).reverse().forEach(card =>{
        caro.insertAdjacentHTML('afterbegin', card.outerHTML);
    });
    carouselChildrens.slice(0, cardPerView).forEach(card =>{
        caro.insertAdjacentHTML('beforeend', card.outerHTML);
    });

    const dragStart = (e) =>{
        isDragging = true;
        caro.classList.add('dragging');
        startX = e.pageX;
        startScrollLeft = caro.scrollLeft;
    }

    const dragging = (e) =>{
        if(!isDragging) return;

        caro.scrollLeft = startScrollLeft - ( e.pageX - startX);
    }

    const dragStop = () =>{
        isDragging = false;
        caro.classList.remove('dragging');
    }

    const infiniteScroll = () =>{
        if(caro.scrollLeft === 0){
            caro.classList.add('no-transition');
            caro.scrollLeft = caro.scrollWidth - (2 * caro.offsetWidth);
            caro.classList.remove('no-transition');
        }else if(caro.scrollLeft === caro.scrollWidth - caro.offsetWidth){
            caro.classList.add('no-transition');
            caro.scrollLeft = caro.offsetWidth;
            caro.classList.remove('no-transition');
        }
    }
    
    caro.addEventListener('mousedown', dragStart);
    caro.addEventListener('mousemove', dragging);
    document.addEventListener('mouseup', dragStop);
    caro.addEventListener('scroll', infiniteScroll);
}
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  */

const sliderImage = document.querySelectorAll('.mdl-img');
for(let items of sliderImage){
    items.addEventListener('click', onImageClick);
}

const modalView = document.querySelector('#modal-view');
modalView.addEventListener('click', onModalClick);

while(inc <= 4){
    const sliderInfo = document.querySelectorAll('#radio' + inc);
    
    for(let info of sliderInfo){
        info.addEventListener('click', slideInfo);    
    }

    inc++;
}

const btnsR = document.querySelectorAll('.right');
const btnsL = document.querySelectorAll('.left');
for(let btnR of btnsR){
    btnR.addEventListener('click', changeSliderRight);
}

for(let btnL of btnsL){
    btnL.addEventListener('click', changeSliderLeft);
}

//APRO IL MENU LATERALE
const showMenu = document.querySelector('.navbar');
showMenu.addEventListener('click', openSideMenu);

const dropButton = document.querySelector('#menu-item');
dropButton.addEventListener('click', dropDownMenu);
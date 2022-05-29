function validazione(event)
{
    //VERIFICO SE TUTTI I CAMPI SONO STATI RIEMPITI, ALTRIMENTI MANDO UN WARNING.
    if(form.username.value.length == 0 ||
       form.password.value.length == 0){
        
        alert("Devi compilare tutti i campi.");
        
        event.preventDefault();
    }      
}

//RIFERIMENTO AL NOME DEL FORM DELLA PAGINA PHP.
const form = document.forms['login'];
//AGGIUNGO IL LISTENER.
form.addEventListener('submit', validazione);
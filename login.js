function validazione(event){
    //VERIFICO CHE TUTTI I CAMPI SIANO RIEMPITO, IN CASO NEGATIVO MANDO UN WARNING
    if(form.username.value.length == 0 || form.password.value.length ==0){
        alert("Devi compilare tutti i campi");

        event.preventDefault(); //IMPEDISCO IL COMPORTAMENTO DI DEFAULT DEL SUBMIT
    }
}


const form = document.forms['login'];
form.addEventListener('submit', validazione);
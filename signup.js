function checkName(event) {
    const input = event.currentTarget;    
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.parentNode.classList.add('errorj');
    }
    
    checkForm();
}

function jsonCheckUsername(json) {
    //CONTROLLO IL CAMPO EXISTS CHE VIENE RITORNATO DAL JSON.
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errorj');
    }
    checkForm();
}

function jsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
    checkForm();
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        input.parentNode.parentNode.classList.add('errorj');
        formStatus.username = false;
        checkForm();
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
        checkForm();
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');

    if (formStatus.password = passwordInput.value.length < 8) {
        document.querySelector('.password').classList.add('errorj');
    }
    else if(formStatus.password = !/[0-9]/.test(passwordInput.value)){ //CONTROLLO SE C'E' ALMENO UN NUMERO
        document.querySelector('.password span').textContent = "Inserisci almeno un numero";
        document.querySelector('.password').classList.add('errorj');
    }
    else if(formStatus.password = !/[A-Z]/.test(passwordInput.value)){ //CONTROLLO SE C'E' ALMENO UNA LETTERE MAIUSCOLA
        document.querySelector('.password span').textContent = "Inserisci almeno una lettera Maiuscola ";
        document.querySelector('.password').classList.add('errorj');
    }
    else {
        document.querySelector('.password').classList.remove('errorj');
    }
    
    checkForm();
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('.confirm_password input');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('errorj');
    } else {
        document.querySelector('.confirm_password').classList.add('errorj');
    }
    checkForm();
}

function checkForm() {
    // CONTROLLO IL BUTTON PER IL CONSENSO, CHE TUTTI I CAMPI SIANO RIEMPITI E CHE I CAMPI NON SIANO FALSE.
    document.getElementById('submit').disabled = !document.querySelector('.allow input').checked || 
    Object.keys(formStatus).length !== 7 || 
    Object.values(formStatus).includes(false);

    console.log(formStatus);
}

const formStatus = {'allow': true}; //CREO UN OGGETTO PER MONITORARE I CAMPI

document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkName);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.allow input').addEventListener('change', checkForm);

if (document.querySelector('.error') !== null) {
    checkUsername(); checkPassword(); checkConfirmPassword(); checkEmail();
    document.querySelector('.name input').dispatchEvent(new Event('blur'));
    document.querySelector('.surname input').dispatchEvent(new Event('blur'));
}
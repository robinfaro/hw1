function checkPassword(password) {
    if (password.length < 8) {
        return false;
    }
    if (!/[A-Z]/.test(password)) {
        return false;
    }
    if (!/[0-9]/.test(password)) {
        return false;
    }
    return true;
}

function onSubmit(event){

    psw = document.querySelector("form").password.value

    if(document.querySelector("form").nome.value.length == 0 || document.querySelector("form").cognome.value.length == 0 || 
    document.querySelector("form").mail.value.length == 0 || document.querySelector("form").username.value.length == 0 || psw.length == 0){
        event.preventDefault()
        document.getElementById('error-comp').classList.remove('hidden')
        document.getElementById('error-comp').classList.add('error')
    } 
    else{
        

        if(!checkPassword(psw)){
            event.preventDefault()
            document.getElementById('error-password').classList.remove('hidden')
            document.getElementById('error-password').classList.add('error')

        }
    }


}

function onResponse(response){
    return response.json();
}


function onMailBlur(event){
    const field = event.currentTarget
    const value = field.value
    const fetchURL = 'http://localhost/Homework4/checkSignup.php?input=' + value + "&type=" + field.name

    fetch(fetchURL).then(onResponse).then(onMailJson)

    function onMailJson(json){
        if(!json.ok){
            document.getElementById('error-mail').classList.remove('hidden')
            document.getElementById('error-mail').classList.add('error')
        }
        else{
            document.getElementById('error-mail').classList.add('hidden')
            document.getElementById('error-mail').classList.remove('error')
        }
    }

}

function onUsernameBlur(event){
    const field = event.currentTarget
    const value = field.value
    const fetchURL = 'http://localhost/Homework4/checkSignup.php?input=' + value + "&type=" + field.name

    fetch(fetchURL).then(onResponse).then(onUsernameJson)

    function onUsernameJson(json){

        if(!json.ok){
            document.getElementById('error-username').classList.remove('hidden')
            document.getElementById('error-username').classList.add('error')
        }
        else{
            document.getElementById('error-username').classList.add('hidden')
            document.getElementById('error-username').classList.remove('error')
        }
    }

}

document.querySelector("form").addEventListener("submit", onSubmit)

inputMail = document.querySelector("form input[name='mail']")
inputMail.addEventListener('blur', onMailBlur)

inputUsername = document.querySelector("form input[name='username']")
inputUsername.addEventListener('blur', onUsernameBlur)

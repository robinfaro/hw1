function onResponse(response){
    return response.json()
}

function onJson(json){
    const gallery = document.querySelector('.gallery')
    for(avatar of json){
        const box = document.createElement('div')
        box.classList.add('container')
        box.addEventListener('click', onClick)
        const img = document.createElement('img')
        img.classList.add('avatar')
        img.src = avatar
        box.appendChild(img)
        gallery.appendChild(box)
    }

}

function isSelected(img){
    classes = img.classList
    for(c of classes){
        if(c == 'selected'){
            return true
        }

    }
    return false
}

function onClick(event){
    const img = event.currentTarget
    if(!isSelected(img)){
        const containers = document.querySelectorAll('.container')

        for(cont of containers){
            if(isSelected(cont)){
                cont.classList.remove('selected')
            }
        }
        img.classList.add('selected')

        const confirm = document.querySelector('.confirm')
        confirm.classList.remove('hidden')
        confirm.scrollIntoView()
    }
    else{
        img.classList.remove('selected')
    }
}

function redirect(response){

    window.location.href = 'http://localhost/Homework4/profile.php'
}

function onConfirm(event){
    const containers = document.querySelectorAll('.container')
    let input = ''
        for(cont of containers){
            if(isSelected(cont)){
                input = cont.querySelector('img').src
            }
        }
    
    fetch('http://localhost/Homework4/avatar.php?action=set&input=' + input).then(redirect)

}

fetch('http://localhost/Homework4/avatar.php?action=search').then(onResponse).then(onJson)

document.querySelector('.confirm button').addEventListener('click', onConfirm)


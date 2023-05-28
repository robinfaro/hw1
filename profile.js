function onResponse(response){
    return response.json()
}

function onImageHide(event){
    document.querySelector('.gallery').innerHTML = ''
    const imgButton = event.currentTarget
    imgButton.removeEventListener('click', onImageHide)
    imgButton.addEventListener('click', onImageRequest)
    imgButton.textContent = 'MOSTRA LE IMMAGINI CHE TI SONO PIACIUTE'
}

function isLiked(box){
    for (c of box.classList){
        if( c == 'liked'){
            return true
        }

    }
}

function onLike(event){
    const box = event.currentTarget.parentNode
    console.log(box)
    const icon = box.querySelector('.like-button img')
    if (isLiked(box)){
        icon.src = 'images/like.png'
        box.classList.remove('liked')
        box.classList.add('not-liked')
        //fetch per rimuovere il like dal DB
        fetch('http://localhost/Homework4/likedPaintings.php', {
            method: 'post',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'action=delete&url=' + encodeURIComponent(box.querySelector('.artwork').src) 
        })
        return

    }

    icon.src = 'images/liked.png'
    box.classList.remove('not-liked')
    box.classList.add('liked')
//    fetch per aggiungere il like al DB
    console.log('action=add&url=' + encodeURIComponent(box.querySelector('.artwork').src))
    fetch('http://localhost/Homework4/likedPaintings.php', {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'action=add&url=' + encodeURIComponent(box.querySelector('.artwork').src) + '&title=' + encodeURIComponent(box.querySelector('.title').textContent)
    })

}

function onJson(json){
    console.log(json)
   if(document.querySelector('.imageAdder')){
    document.querySelector('.imageAdder').remove()
   }
   const gallery = document.querySelector('.gallery')
   gallery.classList.remove('hidden')
   gallery.innerHTML = ''

   if (json.length != 0){
        for (likes of json){
            const img = document.createElement('img')
            img.classList.add('artwork')
            img.addEventListener('dblclick', onLike)
            const imgBox = document.createElement('div')
            imgBox.classList.add('imgBox')
            const likeIcon = document.createElement('img')
            imgBox.classList.add('liked')
            likeIcon.src = 'images/liked.png'
            const likeButton = document.createElement('button')
            likeButton.classList.add('like-button')
            likeButton.addEventListener('click', onLike)
            likeButton.appendChild(likeIcon)
            img.src = likes.url
            const title = document.createElement('div')
            title.textContent = likes.title
            title.classList.add('hidden')
            title.classList.add('title')
            imgBox.appendChild(title)
            imgBox.appendChild(img)
            imgBox.appendChild(likeButton)
            gallery.appendChild(imgBox)
            //console.log(artwork)
        }

        const imgButton = document.querySelector('.showImage')
        imgButton.textContent = 'NASCONDI LE IMMAGINI CHE TI SONO PIACIUTE'
        imgButton.removeEventListener('click', onImageRequest)
        imgButton.addEventListener('click', onImageHide)
    }
    else{
        
        gallery.innerHTML = ''
    }
}


function onImageRequest(event){
    fetch('http://localhost/Homework4/likedPaintings.php', {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'action=search'
    }).then(onResponse).then(onJson)
}


function confirmChoice(event){
    if (confirm("Sei sicuro di voler modificare la tua foto di profilo?")) {
        window.location.href = "profile-picture-choice.php";
      }
}

const button = document.querySelector('.liked-paintings button')

button.addEventListener('click', onImageRequest)

const modifyButton = document.querySelector('.modify')
modifyButton.addEventListener('click', confirmChoice)

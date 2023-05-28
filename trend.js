function onResponse(response){
    return response.json()
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

    const gallery = document.querySelector('.gallery')
    gallery.classList.remove('hidden')
    gallery.innerHTML = ''

    if (json.length != 0){
        for (image of json){
            const img = document.createElement('img')
            img.classList.add('artwork')
            img.addEventListener('dblclick', onLike)
            const imgBox = document.createElement('div')
            imgBox.classList.add('imgBox')
            const likeIcon = document.createElement('img')
            if(image.isLiked == false){
                imgBox.classList.add('not-liked')
                likeIcon.src = 'images/like.png'
            }     
            else{
                imgBox.classList.add('liked')
                likeIcon.src = 'images/liked.png'
            }
            const likeButton = document.createElement('button')
            likeButton.classList.add('like-button')
            likeButton.addEventListener('click', onLike)
            likeButton.textContent = image.total_likes + '  Mi Piace'
            likeButton.appendChild(likeIcon)
            img.src = image.url
            const title = document.createElement('div')
            title.textContent = image.title
            title.classList.add('hidden')
            title.classList.add('title')
            imgBox.appendChild(title)
            imgBox.appendChild(img)
            imgBox.appendChild(likeButton)
            gallery.appendChild(imgBox)
            //console.log(artwork)
        }
    }
    else{
        gallery.innerHTML = 'Nessun mi piace'
    }
}


fetch('http://localhost/Homework4/likedPaintings.php', {
    method: 'post',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: 'action=top'
}).then(onResponse).then(onJson)
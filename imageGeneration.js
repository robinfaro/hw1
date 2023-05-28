function onResponse(response){
    console.log(response)
    return response.json()
}


function onMoreImageJson(json){
    document.querySelector('.loader').classList.add('hidden')
    document.querySelector('.imageAdder').remove()
    const gallery = document.querySelector('.gallery')

    const img = document.createElement('img')
    img.classList.add('aiImage')
    img.addEventListener('dblclick', onLike)
    const imgBox = document.createElement('div')
    imgBox.classList.add('imgBoxAI')
    const likeIcon = document.createElement('img')
    if(json.isLiked == false){
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
    likeButton.appendChild(likeIcon)
    img.src = json.data[0].url
    imgBox.appendChild(img)
    imgBox.appendChild(likeButton)
    gallery.appendChild(imgBox)
 
    const moreElements = document.createElement('button')
    moreElements.innerHTML = 'Carica altre immagini'
    moreElements.classList.add('imageAdder')
    moreElements.addEventListener('click', onMoreElements)
    document.querySelector('body').appendChild(moreElements)
 }

function onMoreElements(event){
    const input = encodeURIComponent(document.querySelector("#content").value)
    const fetchURL = 'http://localhost/Homework4/openAI.php?input=' + input
    document.querySelector('.loader').classList.remove('hidden')
    fetch(fetchURL).then(onResponse).then(onMoreImageJson);

}

function onJson(json){
   console.log(json)
   document.querySelector('.loader').classList.add('hidden')
   if(document.querySelector('.imageAdder')){
    document.querySelector('.imageAdder').remove()
   }
   const gallery = document.querySelector('.gallery')
   gallery.classList.remove('hidden')
   gallery.innerHTML = ''
   const img = document.createElement('img')
   img.classList.add('aiImage')
   img.addEventListener('dblclick', onLike)
   const imgBox = document.createElement('div')
   imgBox.classList.add('imgBoxAI')
   const likeIcon = document.createElement('img')
   if(json.isLiked == false){
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
   likeButton.appendChild(likeIcon)
   img.src = json.data[0].url
   const title = document.createElement('div')
   title.textContent = json.title
   title.classList.add('hidden')
   title.classList.add('title')
   imgBox.appendChild(title)
   imgBox.appendChild(img)
   imgBox.appendChild(likeButton)
   gallery.appendChild(imgBox)
   const moreElements = document.createElement('button')
   moreElements.innerHTML = 'Carica altre immagini'
   moreElements.classList.add('imageAdder')
   moreElements.addEventListener('click', onMoreElements)
   document.querySelector('body').appendChild(moreElements)

}



function onSubmit(event){
    event.preventDefault()
    const input = encodeURIComponent(document.querySelector("#content").value)
    const fetchURL = 'http://localhost/Homework4/openAI.php?input=' + input
    document.querySelector('.loader').classList.remove('hidden')
    fetch(fetchURL).then(onResponse).then(onJson);
}

function isLiked(box){
    for (c of box.classList){
        if( c == 'liked'){
            return true
        }

    }
}

function logJson(json){
    console.log(json)
    console.log(json.data[0].url)
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
            body: 'action=delete&url=' + encodeURIComponent(box.querySelector('.aiImage').src)
        })
        return
    }

    icon.src = 'images/liked.png'
    box.classList.remove('not-liked')
    box.classList.add('liked')
//    fetch per aggiungere il like al DB
    console.log('action=add&url=' + encodeURIComponent(box.querySelector('.aiImage').src) + encodeURIComponent(box.querySelector('.title').textContent))
    fetch('http://localhost/Homework4/likedPaintings.php', {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'action=add&url=' + encodeURIComponent(box.querySelector('.aiImage').src)+  '&title=' +encodeURIComponent(box.querySelector('.title').textContent) 
    })

}



const form = document.querySelector("form")

form.addEventListener('submit', onSubmit)

let currentOffset = 0

function onResponse(response){
    console.log(response)
    return response.json()
}


function onMoreImageJson(json){
    document.querySelector('.imageAdder').remove()
    const gallery = document.querySelector('.gallery')
    console.log(json)

    if (json.total_count != 0){
         for (artwork of json._embedded.results){
             const img = document.createElement('img')
             img.classList.add('artwork')
             img.addEventListener('dblclick', onLike)
             const imgBox = document.createElement('div')
             imgBox.classList.add('imgBox')
             const likeIcon = document.createElement('img')
             if(artwork.isLiked == false){
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
             img.src = artwork._links.thumbnail.href
             const title = document.createElement('div')
             title.textContent = artwork.title
             title.classList.add('hidden')
             title.classList.add('title')
             imgBox.appendChild(title)
             imgBox.appendChild(img)
             gallery.appendChild(imgBox)
             imgBox.appendChild(likeButton)
             //console.log(artwork)
         }
         const moreElements = document.createElement('button')
         moreElements.innerHTML = 'Carica altre immagini'
         moreElements.classList.add('imageAdder')
         moreElements.addEventListener('click', onMoreElements)
         document.querySelector('body').appendChild(moreElements)
     }
     else{
        const fine = document.createElement('div')
        fine.innerHTML = 'FINE'
        gallery.appendChild(fine)

    }
 }

function onMoreElements(event){
    currentOffset = currentOffset + 10
    const input = encodeURIComponent(document.querySelector("#content").value)
    const fetchURL = 'http://localhost/Homework4/artsy.php?offset=' + currentOffset + '&input=' + input
    fetch(fetchURL).then(onResponse).then(onMoreImageJson);

}

function onJson(json){
   currentOffset = 0
   console.log(json)
   if(document.querySelector('.imageAdder')){
    document.querySelector('.imageAdder').remove()
   }
   const gallery = document.querySelector('.gallery')
   gallery.classList.remove('hidden')
   gallery.innerHTML = ''

   if (json.total_count != 0){
        for (artwork of json._embedded.results){
            const img = document.createElement('img')
            img.classList.add('artwork')
            img.addEventListener('dblclick', onLike)
            const imgBox = document.createElement('div')
            imgBox.classList.add('imgBox')
            const likeIcon = document.createElement('img')
            if(artwork.isLiked == false){
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
            img.src = artwork._links.thumbnail.href
            const title = document.createElement('div')
            title.textContent = artwork.title
            title.classList.add('hidden')
            title.classList.add('title')
            imgBox.appendChild(title)
            imgBox.appendChild(img)
            imgBox.appendChild(likeButton)
            gallery.appendChild(imgBox)
            //console.log(artwork)
        }
        const moreElements = document.createElement('button')
        moreElements.innerHTML = 'Carica altre immagini'
        moreElements.classList.add('imageAdder')
        moreElements.addEventListener('click', onMoreElements)
        document.querySelector('body').appendChild(moreElements)
    }
    else{
        const error = document.createElement('div')
        error.classList.add('error')
        error.innerHTML = "<img src= 'images/error.png'> Nessun Risultato"
        document.querySelector('body').appendChild(error)
    }
}



function onSubmit(event){
    event.preventDefault()
    const input = encodeURIComponent(document.querySelector("#content").value)
    const fetchURL = 'http://localhost/Homework4/artsy.php?input=' + input
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
        body: 'action=add&url=' + encodeURIComponent(box.querySelector('.artwork').src) + '&title=' + encodeURIComponent(box.querySelector('.title').innerHTML) 
    })

}



const form = document.querySelector("form")

form.addEventListener('submit', onSubmit)


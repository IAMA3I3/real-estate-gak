const propertyPic = document.querySelector('#property-pic')
const propertyPicThumb = document.querySelectorAll('#property-pic-thumb')
const propertyPicThumbAll = document.querySelectorAll('#property-pic-thumb-all')
const imgDisplay = document.querySelector('#img-display')
const popImg = document.querySelector('#img-display img')
const leftBtn = document.querySelector('#img-display #left')
const rightBtn = document.querySelector('#img-display #right')
let currentPropertyImgIndex = 0
let currentImgGroup = ''
let imgIndex = -1

const displayImg = (index, gal) => {
    popImg.src = gal[index].querySelector('img').getAttribute('src')
    imgDisplay.classList.add('show')
}

if (imgDisplay) {
    imgDisplay.onclick = () => {
        imgDisplay.classList.remove('show')
    }
}
if (popImg) {
    popImg.onclick = (e) => {
        e.stopPropagation()
    }
}

const setPropertyPic = (index) => {
    propertyPic.querySelector('img').src = propertyPicThumb[index].querySelector('img').getAttribute('src')
}

if (propertyPic && propertyPicThumb) {
    setPropertyPic(currentPropertyImgIndex)
    propertyPicThumb.forEach((item, index) => {
        item.onclick = () => {
            currentPropertyImgIndex = index
            setPropertyPic(currentPropertyImgIndex)
            for (let i = 0; i < propertyPicThumb.length; i++) {
                propertyPicThumb[i].classList.remove('active')
                if (currentPropertyImgIndex === i) {
                    propertyPicThumb[i].classList.add('active')
                }
            }
        }
    })

    propertyPic.onclick = () => {
        displayImg(currentPropertyImgIndex, propertyPicThumb)
        imgIndex = currentPropertyImgIndex
        currentImgGroup = 'propertyImg'
    }
}



// control
if (leftBtn) {
    leftBtn.onclick = (e) => {
        e.stopPropagation()
        if (currentImgGroup === 'propertyImg') {
            imgIndex = imgIndex - 1
            if (imgIndex < 0) {
                imgIndex = propertyPicThumbAll?.length - 1
            }
            displayImg(imgIndex, propertyPicThumbAll)
        }
    }
}
if (rightBtn) {
    rightBtn.onclick = (e) => {
        e.stopPropagation()
        if (currentImgGroup === 'propertyImg') {
            imgIndex = imgIndex + 1
            if (imgIndex === propertyPicThumbAll?.length) {
                imgIndex = 0
            }
            displayImg(imgIndex, propertyPicThumbAll)
        }
    }
}
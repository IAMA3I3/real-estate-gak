const propertyPic = document.querySelector('#property-pic')
const propertyPicThumb = document.querySelectorAll('#property-pic-thumb')
const propertyPicThumbAll = document.querySelectorAll('#property-pic-thumb-all')
const imgDisplay = document.querySelector('#img-display')
const videoDisplay = document.querySelector('#video-display')
const popImg = document.querySelector('#img-display img')
const popVideo = document.querySelector('#video-display video')
const leftBtn = document.querySelector('#img-display #left')
const rightBtn = document.querySelector('#img-display #right')
const videoLeftBtn = document.querySelector('#video-display #left')
const videoRightBtn = document.querySelector('#video-display #right')
let currentPropertyImgIndex = 0
let currentImgGroup = ''
let imgIndex = -1

const displayMedia = (index, gal) => {
    const mediaElement = gal[index]
    const mediaType = mediaElement.getAttribute('data-type')
    
    if (mediaType === 'video') {
        const videoSrc = mediaElement.querySelector('video').getAttribute('src')
        popVideo.src = videoSrc
        videoDisplay.classList.add('show')
        imgDisplay.classList.remove('show')
    } else {
        const imgSrc = mediaElement.querySelector('img').getAttribute('src')
        popImg.src = imgSrc
        imgDisplay.classList.add('show')
        videoDisplay.classList.remove('show')
    }
}

// Close handlers
if (imgDisplay) {
    imgDisplay.onclick = () => {
        imgDisplay.classList.remove('show')
    }
}

if (videoDisplay) {
    videoDisplay.onclick = () => {
        videoDisplay.classList.remove('show')
    }
}

if (popImg) {
    popImg.onclick = (e) => {
        e.stopPropagation()
    }
}

if (popVideo) {
    popVideo.onclick = (e) => {
        e.stopPropagation()
    }
}

const setPropertyPic = (index) => {
    const selectedThumb = propertyPicThumb[index]
    const mediaType = selectedThumb.getAttribute('data-type')
    
    if (mediaType === 'video') {
        const videoSrc = selectedThumb.querySelector('video').getAttribute('src')
        const mainContainer = propertyPic
        mainContainer.innerHTML = `
            <video src="${videoSrc}" class="w-full h-full object-cover" muted></video>
            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                <div class="invisible opacity-0 w-0 group-hover:visible group-hover:opacity-100 group-hover:w-[60px] transition-all duration-500 aspect-square rounded-full border-white border-2 bg-black/20 text-white flex justify-center items-center text-lg">
                    <i class="fa-solid fa-play"></i>
                </div>
            </div>
        `
    } else {
        const imgSrc = selectedThumb.querySelector('img').getAttribute('src')
        const mainContainer = propertyPic
        mainContainer.innerHTML = `
            <img src="${imgSrc}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="">
            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                <div class="invisible opacity-0 w-0 group-hover:visible group-hover:opacity-100 group-hover:w-[60px] transition-all duration-500 aspect-square rounded-full border-white border-2 bg-black/20 text-white flex justify-center items-center text-lg">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </div>
            </div>
        `
    }
}

if (propertyPic && propertyPicThumb.length > 0) {
    setPropertyPic(currentPropertyImgIndex)
    
    propertyPicThumb.forEach((item, index) => {
        item.onclick = () => {
            currentPropertyImgIndex = index
            setPropertyPic(currentPropertyImgIndex)
            
            // Update active state
            propertyPicThumb.forEach(thumb => thumb.classList.remove('active'))
            propertyPicThumb[currentPropertyImgIndex].classList.add('active')
        }
    })

    propertyPic.onclick = () => {
        displayMedia(currentPropertyImgIndex, propertyPicThumbAll)
        imgIndex = currentPropertyImgIndex
        currentImgGroup = 'propertyImg'
    }
}

// Navigation controls for image display
if (leftBtn) {
    leftBtn.onclick = (e) => {
        e.stopPropagation()
        if (currentImgGroup === 'propertyImg' && propertyPicThumbAll.length > 0) {
            imgIndex = imgIndex - 1
            if (imgIndex < 0) {
                imgIndex = propertyPicThumbAll.length - 1
            }
            displayMedia(imgIndex, propertyPicThumbAll)
        }
    }
}

if (rightBtn) {
    rightBtn.onclick = (e) => {
        e.stopPropagation()
        if (currentImgGroup === 'propertyImg' && propertyPicThumbAll.length > 0) {
            imgIndex = imgIndex + 1
            if (imgIndex >= propertyPicThumbAll.length) {
                imgIndex = 0
            }
            displayMedia(imgIndex, propertyPicThumbAll)
        }
    }
}

// Add navigation controls for video display (if they exist)
if (videoLeftBtn) {
    videoLeftBtn.onclick = (e) => {
        e.stopPropagation()
        if (currentImgGroup === 'propertyImg' && propertyPicThumbAll.length > 0) {
            imgIndex = imgIndex - 1
            if (imgIndex < 0) {
                imgIndex = propertyPicThumbAll.length - 1
            }
            displayMedia(imgIndex, propertyPicThumbAll)
        }
    }
}

if (videoRightBtn) {
    videoRightBtn.onclick = (e) => {
        e.stopPropagation()
        if (currentImgGroup === 'propertyImg' && propertyPicThumbAll.length > 0) {
            imgIndex = imgIndex + 1
            if (imgIndex >= propertyPicThumbAll.length) {
                imgIndex = 0
            }
            displayMedia(imgIndex, propertyPicThumbAll)
        }
    }
}

// Add close buttons for both displays
const imgCloseBtn = document.querySelector('#img-display .fa-xmark')
const videoCloseBtn = document.querySelector('#video-display .fa-xmark')

if (imgCloseBtn) {
    imgCloseBtn.onclick = (e) => {
        e.stopPropagation()
        imgDisplay.classList.remove('show')
    }
}

if (videoCloseBtn) {
    videoCloseBtn.onclick = (e) => {
        e.stopPropagation()
        videoDisplay.classList.remove('show')
    }
}
// info alert
const infoAlert = document.querySelectorAll('#info-alert')

const showInfoAlert = () => {
    infoAlert.forEach((item) => {
        item.classList.remove('top-0', 'invisible', 'opacity-0')
        item.classList.add('top-20', 'visible', 'opacity-100')
    })
}
const hideInfoAlert = () => {
    infoAlert.forEach((item) => {
        item.classList.add('top-0', 'invisible', 'opacity-0')
        item.classList.remove('top-20', 'visible', 'opacity-100')
    })
}

showInfoAlert()
setTimeout(hideInfoAlert, 2000)

document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.app-form');

    forms.forEach(form => {
        form.addEventListener('submit', function () {
            const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');

            submitButtons.forEach(button => {
                button.disabled = true;

                // Change button text if it's a <button>, not <input>
                if (button.tagName.toLowerCase() === 'button') {
                    button.dataset.originalText = button.innerHTML;
                    button.innerHTML = 'Loading...';
                } else if (button.tagName.toLowerCase() === 'input') {
                    button.dataset.originalValue = button.value;
                    button.value = 'Loading...';
                }
            });
        });
    });
});

// side nav
const sideNavToggle = document.querySelectorAll('.side-nav-toggle')
const navOverlay = document.querySelector('.nav-overlay')
const sideNav = document.querySelector('.side-nav')

if (sideNavToggle && navOverlay && sideNav) {
    sideNavToggle.forEach((item) => {
        item.addEventListener('click', () => {
            navOverlay.classList.toggle('open')
            sideNav.classList.toggle('open')
        })
    })
}

// search pop
const searchToggle = document.querySelectorAll('.search-toggle')
const searchContainer = document.querySelector('.search-container')
const searchOverlay = document.querySelector('.search-overlay')
const searchMain = document.querySelector('.search-overlay .main')

if (searchToggle && searchContainer && searchOverlay && searchMain) {
    searchToggle.forEach((item) => {
        item.addEventListener('click', () => {
            searchContainer.classList.toggle('open')
            searchOverlay.classList.toggle('open')
        })
    })
    searchOverlay.addEventListener('click', () => {
        searchContainer.classList.toggle('open')
        searchOverlay.classList.toggle('open')
    })
    searchMain.addEventListener('click', (e) => {
        e.stopPropagation()
    })
}

// sticky nav bar
const stickyTopNavbar = document.querySelector('.sticky-navbar')
// scroll up btn
const scrollUpBtn = document.querySelector('.scroll-up')
// Set the scroll point (in pixels) where you want to log the message
const scrollPoint = 100;

// Add an event listener for the scroll event
window.addEventListener('scroll', () => {
    // Get the current scroll position
    const scrollPosition = window.scrollY || document.documentElement.scrollTop;

    // Check if the scroll position has reached the defined point
    if (scrollPosition >= scrollPoint) {
        // console.log(`You've scrolled past ${scrollPoint}px!`);
        if (stickyTopNavbar) {
            stickyTopNavbar.classList.add('open')
        }
        if (scrollUpBtn) {
            scrollUpBtn.classList.add('open')
            scrollUpBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                })
            })
        }
    } else {
        // console.log(`You've scrolled back bellow ${scrollPoint}px!`);
        if (stickyTopNavbar) {
            stickyTopNavbar.classList.remove('open')
        }
        if (scrollUpBtn) {
            scrollUpBtn.classList.remove('open')
        }
    }
});

// drop menu
const dropMenu = document.querySelectorAll('.drop-menu')

if (dropMenu) {
    dropMenu.forEach(menu => {
        const ic = menu.querySelector('.ic')
        const subMenu = menu.querySelector('.sub-menu')
        menu.addEventListener('mouseenter', () => {
            if (ic && subMenu) {
                ic.classList.remove('rotate-0')
                ic.classList.add('rotate-180')
                subMenu.classList.remove('-translate-y-8', 'opacity-0', 'invisible')
                subMenu.classList.add('translate-y-0', 'opacity-100', 'visible')
            }
        })
        menu.addEventListener('mouseleave', () => {
            if (ic && subMenu) {
                ic.classList.remove('rotate-180')
                ic.classList.add('rotate-0')
                subMenu.classList.remove('translate-y-0', 'opacity-100', 'visible')
                subMenu.classList.add('-translate-y-8', 'opacity-0', 'invisible')
            }
        })
    })
}
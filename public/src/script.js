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



// app container with side bar
const toggleDashboardNav = document.querySelectorAll('#toggle-dashboard-nav')
const dashboardSideNav = document.querySelector('.dashboard-nav-container')
const dashboardMain = document.querySelector('.dashboard-main')
const dashboardNavOverlay = document.querySelector('.dashboard-nav-overlay')

if (toggleDashboardNav && dashboardSideNav) {
    toggleDashboardNav.forEach(btn => {
        btn.addEventListener('click', () => {
            dashboardSideNav.classList.toggle('slide')
            dashboardMain.classList.toggle('expand')
            dashboardNavOverlay.classList.toggle('show')
        })
    })
}

// side bar drop downs
const dashboardNavDropdownToggle = document.querySelectorAll('.dashboard-nav-dropdown-toggle')
const dashboardNavDropdown = document.querySelectorAll('.dashboard-nav-dropdown')

if (dashboardNavDropdownToggle && dashboardNavDropdown) {
    for (let i = 0; i < dashboardNavDropdownToggle.length; i++) {
        dashboardNavDropdownToggle[i].addEventListener('click', () => {
            const ic = dashboardNavDropdownToggle[i].querySelector('.drop-ic')
            ic.classList.toggle('rotate')

            for (let j = 0; j < dashboardNavDropdown.length; j++) {
                if (j === i) {
                    dashboardNavDropdown[j].classList.toggle('open')
                }
            }
        })
    }
}

// top bar drop down
const dashboardTopDropdownToggle = document.querySelectorAll('.dashboard-top-dropdown-toggle')
const dashboardTopDropdown = document.querySelectorAll('.dashboard-top-dropdown')

if (dashboardTopDropdownToggle) {
    for (let i = 0; i < dashboardTopDropdownToggle.length; i++) {
        dashboardTopDropdownToggle[i].addEventListener('click', (e) => {
            e.stopPropagation()
            const ic = dashboardTopDropdownToggle[i].querySelector('.drop-ic')
            ic.classList.toggle('rotate')

            for (let j = 0; j < dashboardTopDropdown.length; j++) {
                if (j === i) {
                    dashboardTopDropdown[j].classList.toggle('open')
                }
            }
        })
    }
}

// double click footer logo to go to admin dashboard
document.getElementById("footer-logo")?.addEventListener("dblclick", () => {
    window.location.href = "./dashboard.php";
})
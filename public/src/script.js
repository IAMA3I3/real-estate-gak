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
document.addEventListener("DOMContentLoaded", function () {
    const menuDefaultOpen = true;
    const buttons = document.querySelectorAll('.fi-sidebar-item-button');
    
    buttons.forEach(button => {
        const submenu = button.nextElementSibling;
        const icon = button.querySelector('.fi-icon-btn p');

        if (menuDefaultOpen && submenu && submenu.classList.contains('submenu')) {
            submenu.classList.add('open');
            icon.classList.toggle('pi-angle-up');
            icon.classList.toggle('pi-angle-down');
            button.querySelector('.fi-icon-btn').classList.add('open');
        }

        button.addEventListener('click', function () {
            if (submenu && submenu.classList.contains('submenu')) {
                submenu.classList.toggle('open');
            }

            icon.classList.toggle('pi-angle-up');
            icon.classList.toggle('pi-angle-down');

            button.querySelector('.fi-icon-btn').classList.toggle('open');
        });
    });
});
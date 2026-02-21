const checkbox = document.getElementById('nav-toggle');
const navMobile = document.querySelector('.nav-mobile');

checkbox.addEventListener('change', () => {
    const visible = navMobile.getAttribute('data-visible') === 'true';
    if (!visible) {
        navMobile.style.animation = "slide-in 0.5s";
        navMobile.setAttribute('data-visible', 'true');
        console.log('Menu opened');
    } else {
        navMobile.style.animation = "slide-down 0.5s";
        navMobile.setAttribute('data-visible', 'false');
        console.log('Menu closed');
    }
});
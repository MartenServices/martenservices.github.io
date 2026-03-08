const checkbox = document.getElementById('nav-toggle');
const navMobile = document.querySelector('.nav-mobile');

checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        navMobile.style.animation = "slide-in 0.3s";
        navMobile.setAttribute('data-visible', 'false');
        console.log('Menu opened');
    }  
});

checkbox.addEventListener('change', () => {
    if (!checkbox.checked) {
         navMobile.style.animation = "slide-down 0.3s ";
        navMobile.setAttribute('data-visible', 'true');
        console.log('Menu closed');
    }  else{
      
    }
});
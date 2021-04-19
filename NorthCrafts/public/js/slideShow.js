const navSlider = () => {
    const hiddenNav = document.querySelector('.nav-mobile');
    const nav = document.querySelector('.nav-links');

    hiddenNav.addEventListener('click', () => {
        console.log('dsdds');
        nav.classList.toggle('nav-active');
    });
}

navSlider();
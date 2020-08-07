const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const links = document.querySelectorAll('.nav-links li');

hamburger.addEventListener('click', () => {
    console.log("menu opened");
    navLinks.classList.toggle('open');
    // links.forEach(link => {
    //     link.classList.toggle("fade");
    // });
});
const navSlide = () => {
    const burger = document.querySelector('.menu-btn');
    const nav = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link, .button-primary');
    burger.addEventListener('click',()=>{
        
        nav.classList.toggle('nav-menu-active'); 
        
        navLinks.forEach((link, index) => {
            if(link.style.animation) {
                link.style.animation = '';
            }
            else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
            }
        });
    
    
    });
    
}

navSlide();
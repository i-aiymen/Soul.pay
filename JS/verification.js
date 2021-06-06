const track = document.querySelector('.carousel-track');
const slides = Array.from(track.children)
const nextButton = document.querySelector('.carousel-button-right');
const prevButton = document.querySelector('.carousel-button-left');
const dotsNav = document.querySelector('.carousel-nav');
console.log("dotsNav found"+dotsNav);
const dots = Array.from(dotsNav.children)


const slideSize = slides[0].getBoundingClientRect().width;

const setSlidePosition = function (slide,index) {
    slide.style.left = slideSize*index + 'px';
    console.log(slide.style.left);
}
slides.forEach(setSlidePosition);

const moveToSlide = (currentSlide,targetSlide) => {
    // console.log(targetSlide.style.left)
    track.style.transform = 'translateX(-'+targetSlide.style.left+')';
    currentSlide.classList.remove('current-slide');
    targetSlide.classList.add('current-slide');
}

const updateDots = (currentDot, targetDot) => {
    currentDot.classList.remove('current-slide');
    targetDot.classList.add('current-slide');
}

// prevButton.addEventListener('click', e => {
//     const currentSlide = track.querySelector('.current-slide');
//     const previousSlide = currentSlide.previousElementSibling;
//     const currentDot = dotsNav.querySelector('.current-slide');
//     const prevDot = currentDot.previousElementSibling;

//     moveToSlide(currentSlide,previousSlide);
//     updateDots(currentDot,prevDot);
// })

// nextButton.addEventListener('click', e => {
//     const currentSlide = track.querySelector('.current-slide');
    
//     const nextSlide = currentSlide.nextElementSibling;
//     const currentDot = dotsNav.querySelector('.current-slide');
//     const nextDot = currentDot.nextElementSibling;

//     moveToSlide(currentSlide,nextSlide);
//     updateDots(currentDot,nextDot);
// });

dotsNav.addEventListener('click', e => {
    console.log("made it");
    const targetDot = e.target.closest('button');

    
    if(!targetDot) return;
    const currentSlide = track.querySelector('.current-slide');
    const currentDot = dotsNav.querySelector('.current-slide');
    const targetIndex = dots.findIndex(dot => dot === targetDot);
    const targetSlide = slides[targetIndex];

    moveToSlide(currentSlide,targetSlide);
    updateDots(currentDot,targetDot);
})
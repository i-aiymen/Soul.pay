const track = document.querySelector('.carousel-track');
const slides = Array.from(track.children)
const nextButtons = document.getElementsByClassName('slide-next');
var nextButtonsArr = [].slice.call(nextButtons);
const prevButtons = document.getElementsByClassName('slide-prev');
var prevButtonsArr = [].slice.call(prevButtons);
const dotsNav = document.querySelector('.carousel-nav');
const dots = Array.from(dotsNav.children)
const finalBtn = document.getElementById("finalsubmit");
finalBtn.disabled = true;

const slideSize = slides[0].getBoundingClientRect().width;

const setSlidePosition = function (slide, index) {
    slide.style.left = slideSize * index + 'px';
    console.log(slide.style.left);
}
slides.forEach(setSlidePosition);



const moveToSlide = (currentSlide, targetSlide) => {
    track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
    currentSlide.classList.remove('current-slide');
    targetSlide.classList.add('current-slide');
}

const updateDots = (currentDot, targetDot) => {
    currentDot.classList.remove('current-slide');
    targetDot.classList.add('current-slide');
}

prevButtonsArr.forEach(function (button) {
    button.addEventListener('click', e => {
        const currentSlide = track.querySelector('.current-slide');
        const previousSlide = currentSlide.previousElementSibling;
        const currentDot = dotsNav.querySelector('.current-slide');
        const prevDot = currentDot.previousElementSibling;

        moveToSlide(currentSlide, previousSlide);
        updateDots(currentDot, prevDot);
    });
});

nextButtonsArr.forEach(function (button) {
    button.addEventListener('click', e => {
        const currentSlide = track.querySelector('.current-slide');

        const nextSlide = currentSlide.nextElementSibling;
        const currentDot = dotsNav.querySelector('.current-slide');
        const nextDot = currentDot.nextElementSibling;

        moveToSlide(currentSlide, nextSlide);
        updateDots(currentDot, nextDot);
    });
});

dotsNav.addEventListener('click', e => {
    console.log("made it");
    const targetDot = e.target.closest('button');


    if (!targetDot) return;
    const currentSlide = track.querySelector('.current-slide');
    const currentDot = dotsNav.querySelector('.current-slide');
    const targetIndex = dots.findIndex(dot => dot === targetDot);
    const targetSlide = slides[targetIndex];

    moveToSlide(currentSlide, targetSlide);
    updateDots(currentDot, targetDot);
})


//displaying selected file (for aadhar) in the form
var inputs = document.getElementsByClassName('file');
var infoAreas = document.getElementsByClassName('disp-file-name');
var inputsArr = [].slice.call(inputs);
var infoAreasArr = [].slice.call(infoAreas);
console.log(inputsArr)

inputsArr.forEach(function (input, index) {
    input.addEventListener('change', e => {
        console.log("index inside shofilename: " + index);
        var input = e.srcElement;
        // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
        var fileName = input.files[0].name;
        // use fileName however fits your app best, i.e. add it into a div
        infoAreasArr[index].textContent = 'File name: ' + fileName;
        // console.log("hello");
    });
});


const spin = document.getElementById('spin');
const spinRpt = document.getElementById('spinrepeat');
const errorlog = document.getElementById('pinerror');
console.log(spinRpt);
spinRpt.addEventListener('keyup', e=>{
    pin1 = spin.value;
    pin2 = spinRpt.value;

    if (pin1 != pin2) {
        errorlog.innerHTML="<i class=\"fas fa-exclamation-circle\"></i> Pins don't match";//<i class=\"fas fa-exclamation-circle\"></i>
        finalBtn.disabled = true;
    }
    else{
        errorlog.innerHTML="";
        finalBtn.disabled = false;
    }
});

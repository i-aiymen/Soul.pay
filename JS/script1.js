function toggle() {
    var blur = document.getElementById('blur');
            blur.classList.toggle('show');
    var pop = document.getElementById('modal_container');
    pop.classList.toggle('show');

}

function toggle1() {
    var blur1 = document.getElementById('blur');
            blur1.classList.toggle('show1');
    var pop1 = document.getElementById('modal_container1');
    pop1.classList.toggle('show1');

}

function toggle2() {
    var blur1 = document.getElementById('blur');
            blur1.classList.toggle('show1');
    var pop1 = document.getElementById('modal_container2');
    pop1.classList.toggle('show1');

}
function toggle3() {
    var blur1 = document.getElementsById('blur');
            blur1.classList.toggle('show1');
    var pop1 = document.getElementById('modal_container3');
    pop1.classList.toggle('show1');
    if(!pop1.classList.contains('show1')){
        toggle2();
    }

}
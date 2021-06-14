function printDiv(divName) {
    var printcontents = document.getElementById(divName).innerHTML;
    var orginalcontents = document.body.innerHTML;
    document.body.innerHTML = printcontents;
    window.print();
    document.body.innerHTML = orginalcontents;
    
}
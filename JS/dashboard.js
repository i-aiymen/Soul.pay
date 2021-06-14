const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");

const optionsList = document.querySelectorAll(".option");

// selected.addEventListener("click", () => {
//   optionsContainer.classList.toggle("active");
// });

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
  });
});



//-------ajax load content--------//

window.onload=function(){
  var canvasObj = {"myProfile": "showProfile.dash.php", "debitCard": "debitCards.dash.php"};
  
  for (const [key, value] of Object.entries(canvasObj)) {
    var elem = document.getElementById(key);

    elem.addEventListener("click", e=>{
      const ajaxreq = new XMLHttpRequest();
      ajaxreq.open('GET', "http://localhost/mini_project_s4/INCLUDES/"+value);
      ajaxreq.send();
      ajaxreq.onreadystatechange = function () {
        if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
          document.getElementById("home-content").innerHTML = ajaxreq.responseText;
        }
      }
    });
  }
}


function submit(){
  var inputs = document.getElementById("debitAppln").elements;
  var cardtype= document.getElementsByClassName("selected").value;
  var ajaxreq = new XMLHttpRequest();
  ajaxreq.open("POST", "http://localhost/mini_project_s4/INCLUDES/debitAppln.php?house="+inputs['house'].value+"&street="+inputs['street'].value+"&district="+inputs['district'].value+"&state="+inputs['state'].value+"&pincode="+inputs['pincode'].value+"&cardtype="+inputs['cardtype'].value, true);
  ajaxreq.send();
      ajaxreq.onreadystatechange = function () {
        if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
          document.getElementById("debitAppln").innerHTML = ajaxreq.responseText;
    }
  }
}

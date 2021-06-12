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
function changeCanvas() {
  console.log("hello");
  const ajaxreq = new XMLHttpRequest();
  ajaxreq.open('GET', "http://localhost/projects/Banking/includes/showProfile.dash.php");
  ajaxreq.send();
  ajaxreq.onreadystatechange = function () {
    if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
      document.getElementById("home-content").innerHTML = ajaxreq.responseText;
    }
  };
}
window.onload=function(){
  const myProfile= document.getElementById("myProfile");
  myProfile.addEventListener("click", changeCanvas);
}
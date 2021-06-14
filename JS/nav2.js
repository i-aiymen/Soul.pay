var menuList = document.getElementById("menuList");
menuList.style.maxHeight = "0px";
function togglemenu() {
    if(menuList.style.maxHeight == "0px") {
        menuList.style.maxHeight = "550px";
        menuList.style.boxShadow = "0 6px 4px -4px rgba(19, 1, 2, 0.18)";
    }
    else {
        menuList.style.maxHeight = "0px";
        menuList.style.boxShadow = "none"
    }
}
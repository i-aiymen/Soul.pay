<div class="header w-nav">
        <div class="container-default-1310px navbar" style="padding-left:0px;">
            <div class="split-left-container">
                <a href="#" aria-current="page" class="brand w-nav-brand w--current">
                    <img src="ASSETS/photo3.svg" alt="" height=150 max-width=100% class="header-logo"/>
                </a>
                <nav id="menuList" role="navigation" class="nav-menu w-nav-menu">        
                    <a href="#" aria-current="page" class="nav-link w-nav-link w--current">
                        Home
                    </a>
                    <a href="#" aria-current="page" class="nav-link w-nav-link w--current">
                        About Us
                    </a>
                    <a href="#" aria-current="page" class="nav-link w-nav-link w--current">
                        Policies
                    </a>
                    <a href="#" aria-current="page" class="nav-link w-nav-link w--current">
                        Branches & Atms
                    </a>
                    <div class="nav-menu-button-wrapper">
                        <a href="#" class="button-primary w-button">Open account</a>
                    </div>
                </nav>
            </div>
            <div class="split-right-container" >
                <div class="menu-btn" onclick="togglemenu()">
                    <div class="menu-btn__burger"></div>
                </div>
                <a href="#"  class="button-secondary v w-button">Open account</a>
            </div>
        </div>
    </div>
    <script src="JS/main.js"></script>
    <script src="JS/nav.js"></script>
    <script>
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
    </script>
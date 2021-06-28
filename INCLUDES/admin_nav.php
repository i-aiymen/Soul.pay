<div class="header w-nav">
        <div class="container-default-1310px navbar" style="padding-left:0px;">
            <div class="split-left-container">
                <a href="#" aria-current="page" class="brand w-nav-brand w--current">
                    <img src="http://localhost/mini_project_s4/Assets/images/photo3.svg" alt="" height=150 max-width=100% class="header-logo"/>
                </a>
                <nav id="menuList" role="navigation" class="nav-menu w-nav-menu" style="height: 20vh; background: #f1f5f9">        
                    <div class="nav-menu-button-wrapper" style="padding-top:0;">
                        <a href="logout.php" class="button-primary w-button">Sign out</a>
                    </div>
                </nav>
            </div>
            <div class="split-right-container" >
                <div class="menu-btn" onclick="togglemenu()">
                    <div class="menu-btn__burger"></div>
                </div>
                <a href="logout.php"  class="button-secondary v w-button">Sign out</a>
            </div>
        </div>
    </div>
    <script src="http://localhost/mini_project_s4/JS/main.js"></script>
    <script src="http://localhost/mini_project_s4/JS/nav.js"></script>
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
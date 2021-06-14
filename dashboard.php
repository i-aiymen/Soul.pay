<div class="container" id="blur" style="filter: blur(5px);">
        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <img src="Assets/images/PureSoul.svg" width="100%" height="100px" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Soul.pay</span>
                    </a>

                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-chevron-left sidebarBtn'></i>
                    </div>

                    <ul class="nav__list">
                        <a href="#" class="nav__link active">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Home</span>
                        </a>
                        <div  class="nav__link nav__link1 collapse">
                            <i class='bx bx-transfer nav__icon' ></i>
                            <span class="nav__text">Transfer Funds</span>

                            <i class='bx bx-sm bx-chevron-down collapse__link'></i>

                            <ul class="collapse__menu">
                                <a href="#" class="collapse__sublink" onclick="toggle()">Soul Accounts</a>
                                <a href="#" class="collapse__sublink" onclick="toggle1()">Other Accounts</a>
                            </ul>
                        </div>
                        <a href="#" class="nav__link">
                            <i class='bx bx-history nav__icon' ></i>
                            <span class="nav__text">History</span>
                        </a>
                        <a href="#" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__text">My Profile</span>
                        </a>
                        <a href="#" class="nav__link">
                            <i class='bx bxs-credit-card nav__icon' ></i>
                            <span class="nav__text">Debit Card Services</span>
                        </a>                 
                    </ul>
                </div>
                <a href="#" class="nav__link">           
                    <i class='bx bx-log-out-circle nav__icon'></i>
                    <span class="nav__text">Log out</span>
                </a>
            </nav>
        </div>

        
        <section class="home-section">
            <nav>
                <div class="date">
                <?php echo date("d.m.Y"); ?>
                </div>
                <div class="auto_logout">
                <?php  echo "Auto logout in ";  ?>    <span id="countdown"></span>
                </div>
                <button type="button" class="icon-button">
    <span class="material-icons">notifications</span>
    <span class="icon-button__badge">2</span>
  </button>
            </nav>

            <div class="home-content">
                <div class="overview-boxes">
                    <div class="box" style="width: 100%">
                    <i class='bx bxs-chevron-left icon'></i>
                        <div class="right-side" style="margin-left: 100px; margin-right: 100px">
                            <div class="box-topic" style="font-size: 25px; white-space: nowrap;">Muhammed Ayimen</div>
                            <div class="number" style="font-size: 25px; margin-top: 10px">12345678</div>
                        </div>
                        <i class='bx bxs-chevron-right icon' ></i>
                    </div>
                </div>
            </div>

            <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                <div class="right-side right1">
                    <div class="box-topic">Your Balance</div>
                    <div class="number">40,876</div>

                </div>
                <i class='bx bx-rupee rupee'></i>
                </div>
                <div class="box">
                <div class="right-side right2">
                    <div class="box-topic">Account Status</div>
                    <div class="number">Active</div>

                </div>
                <i class='bx bx-user-circle rupee two'></i>
                </div>
                <div class="box">
                <div class="right-side right3">
                    <div class="box-topic">Soul Transactions</div>
                    <div class="number">4</div>

                </div>
                <i class='bx bx-transfer-alt rupee three'></i>

                </div>
                <div class="box">
                <div class="right-side right4">
                    <div class="box-topic">Other Transactions</div>
                    <div class="number">4</div>
                </div>
                <i class='bx bx bx-transfer-alt rupee four' ></i>
                </div>
            </div>
            </div>

            
        </section>
    </div>
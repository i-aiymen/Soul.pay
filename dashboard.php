<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <title>Document</title>

  <style>
    .list {
      width: 100%;
      text-align-last: center;
    }

    .custom-select {
      padding: 32px;
    }

    .custom-select:before {
      content: "";
      position: absolute;
      top: 35.5%;
      right: 55px;
      border: 8px solid;
      border-color: #aaadab transparent transparent transparent;
      pointer-events: none;
    }

    select {
      font-family: 'Quicksand', sans-serif;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      font-size: 0.938rem;
      width: 400px;
      border-radius: 5px;
      padding: 12px 24px;
      outline: none;
      background: #1a233d;
      color: white;
      border: 0;
      cursor: pointer;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }

    option {
      width: 400px;
      text-align-last: center;
    }
  </style>

</head>

<body>
  <div class="container" id="blur">
    <div class="l-navbar" id="navbar">
      <nav class="nav">
        <div>
          <a href="#" class="nav__logo">
            <img src="logo.svg" alt="" class="nav__logo-icon">
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
            <div class="nav__link nav__link1 collapse">
              <i class='bx bx-transfer nav__icon'></i>
              <span class="nav__text">Transfer Funds</span>

              <i class='bx bx-sm bx-chevron-down collapse__link'></i>

              <ul class="collapse__menu">
                <a href="#" class="collapse__sublink" id="open" onclick="toggle()">Soul Accounts</a>
                <a href="#" class="collapse__sublink" onclick="toggle1()">Other Accounts</a>
              </ul>
            </div>
            <a href="#" class="nav__link">
              <i class='bx bx-history nav__icon'></i>
              <span class="nav__text">History</span>
            </a>
            <a href="#" class="nav__link" id="myProfile">
              <i class='bx bx-user nav__icon'></i>
              <span class="nav__text">My Profile</span>
            </a>
            <a href="#" class="nav__link">
              <i class='bx bxs-phone nav__icon'></i>
              <span class="nav__text">Customer Service</span>
            </a>
            <a href="#" class="nav__link">
              <i class='bx bxs-credit-card nav__icon'></i>
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
          25-05-2021
        </div>
        <div class="auto_logout">
          Auto logout in 9:45
        </div>
        <div class="logout">
          <ul>
            <li><a href="#"><i class="fas fa-bell"></i></a></li>
            <li><a href="#"><i class="fas fa-power-off power"></i></a></li>
          </ul>
        </div>
      </nav>

      <div class="home-content" id="home-content">
      </div>
    </section>
  </div>

  <div class="modal-container mod" id="modal_container">
    <div class="modal">
      <button id="close" onclick="toggle()" class="cross">
        <svg data-testid="test-svg" width="14" height="100%" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Artboard-Copy-43" transform="translate(-5.000000, -5.000000)">
            <g id="close">
              <path d="M5.57098982,5.65032324 C5.78968342,5.43162963 6.14425581,5.43162963 6.36294941,5.65032324 L6.36294941,5.65032324 L11.9059696,11.194303 L17.450383,5.65032324 C17.6447773,5.45592892 17.9465326,5.43432955 18.1647849,5.58552513 L18.2423426,5.65032324 C18.4610362,5.86901684 18.4610362,6.22358923 18.2423426,6.44228283 L18.2423426,6.44228283 L12.6979696,11.985303 L18.2423426,17.5297164 C18.4367369,17.7241107 18.4583363,18.025866 18.3071407,18.2441184 L18.2423426,18.321676 C18.023649,18.5403696 17.6690766,18.5403696 17.450383,18.321676 L17.450383,18.321676 L11.9059696,12.777303 L6.36294941,18.321676 C6.1685551,18.5160703 5.86679977,18.5376697 5.64854745,18.3864741 L5.57098982,18.321676 C5.35229621,18.1029824 5.35229621,17.74841 5.57098982,17.5297164 L5.57098982,17.5297164 L11.1149696,11.985303 L5.57098982,6.44228283 C5.3765955,6.24788852 5.35499614,5.94613319 5.50619171,5.72788087 Z" id="Combined-Shape"></path>
            </g>
          </g>
        </svg>
      </button>

      <h2>SOUL GATEWAY</h2>
      <div class="form">
        <div class="card space icon-relative">
          <label class="label">Recipient: <span style="color: red;">*</span></label>
          <input type="text" class="input" placeholder="Name">
          <i class="far fa-user"></i>
        </div>
        <div class="card space icon-relative">
          <label class="label">Account Number: <span style="color: red;">*</span></label>
          <input type="text" class="input" data-mask="0000000000" placeholder="**********">
          <i class="far fa-credit-card"></i>
        </div>
        <div class="card space icon-relative">
          <label class="label">Amount: <span style="color: red;">*</span></label>
          <input type="text" class="input" data-mask="00000" placeholder="">
          <i class="bx bx-sm bx-rupee far"></i>
        </div>
        <div class="card space icon-relative">
          <label class="label">Remark:</label>
          <input type="text" class="input">
        </div>

        <div class="card-grp space">
          <div class="card-item icon-relative">
            <label class="label">OTP: <span style="color: red;">*</span></label>
            <input type="text" class="input" data-mask="0-0-0-0" placeholder="####">
            <i class="fas fa-lock"></i>
          </div>
          <div class="card-item1 space1">
            <button class="resend">Resend?</button>
          </div>
        </div>
        <span><label>9:45</label></span> <span><i class='bx bx-time'></i></span>
        <div class="btn">
          Transfer
        </div>

      </div>

    </div>
  </div>



  <div class="modal-container" id="modal_container1">
        <div class="modal">
            <button id="close1" onclick="toggle1()" class="cross">
                <svg data-testid="test-svg" width="14" height="100%" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Artboard-Copy-43" transform="translate(-5.000000, -5.000000)"><g id="close"><path d="M5.57098982,5.65032324 C5.78968342,5.43162963 6.14425581,5.43162963 6.36294941,5.65032324 L6.36294941,5.65032324 L11.9059696,11.194303 L17.450383,5.65032324 C17.6447773,5.45592892 17.9465326,5.43432955 18.1647849,5.58552513 L18.2423426,5.65032324 C18.4610362,5.86901684 18.4610362,6.22358923 18.2423426,6.44228283 L18.2423426,6.44228283 L12.6979696,11.985303 L18.2423426,17.5297164 C18.4367369,17.7241107 18.4583363,18.025866 18.3071407,18.2441184 L18.2423426,18.321676 C18.023649,18.5403696 17.6690766,18.5403696 17.450383,18.321676 L17.450383,18.321676 L11.9059696,12.777303 L6.36294941,18.321676 C6.1685551,18.5160703 5.86679977,18.5376697 5.64854745,18.3864741 L5.57098982,18.321676 C5.35229621,18.1029824 5.35229621,17.74841 5.57098982,17.5297164 L5.57098982,17.5297164 L11.1149696,11.985303 L5.57098982,6.44228283 C5.3765955,6.24788852 5.35499614,5.94613319 5.50619171,5.72788087 Z" id="Combined-Shape"></path></g></g></svg>
            </button>

              <h2>OTHER BANK GATEWAY</h2>
              <div class="form">
                <div class="card space icon-relative">
                  <label class="label">Recipient: <span style="color: red;">*</span></label>
                  <input type="text" class="input" placeholder="Name">
                  <i class="far fa-user"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">Account Number: <span style="color: red;">*</span></label>
                  <input type="text" class="input" data-mask="0000000000" placeholder="**********">
                  <i class="far fa-credit-card"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">IFSC: <span style="color: red;">*</span></label>
                  <input type="text" class="input" data-mask="0000000000">
                  <i class="far fa-credit-card"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">Amount: <span style="color: red;">*</span></label>
                  <input type="text" class="input" data-mask="00000" placeholder="">
                  <i class="bx bx-sm bx-rupee far"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">Remark:</label>
                  <input type="text" class="input">
                </div>
                
                <div class="card-grp space">
                  <div class="card-item icon-relative">
                    <label class="label">OTP: <span style="color: red;">*</span></label>
                    <input type="text" class="input" data-mask="0-0-0-0" placeholder="####">
                    <i class="fas fa-lock"></i>
                  </div>
                  <div class="card-item1 space1">
                    <button class="resend">Resend?</button> 
                  </div>
                </div>
                <span><label>9:45</label></span> <span><i class='bx bx-time'></i></span>
                <div class="btn">
                  Transfer
                </div> 
                
              </div>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="JS/script.js"></script>
  <script src="JS/script1.js"></script>
  <script src="JS/dashboard.js"></script>
</body>
</html>
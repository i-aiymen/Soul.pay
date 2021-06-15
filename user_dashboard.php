<?php
session_start();
if(!isset($_SESSION["user_id"])){
  header("location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="refresh" content="601;url=logout.php">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/user_dashboard.css">
    <link rel="stylesheet" href="CSS/debitcard.css">
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <title>Document</title>

</head>
<body>
<?php
  if ($_SESSION["verified"] == false) {
    echo "<div class=\"container show1\" id=\"blur\">";
  } else {
    echo "<div class=\"container\" id=\"blur\">";
  }
  ?>
<?php


require_once('DBCONFIG/dbconfig.php');

if (class_exists('DATABASE_CONNECT'))
{

    $obj_conn  = new DATABASE_CONNECT;
    
    $host = $obj_conn->connect[0];
    $user = $obj_conn->connect[1];
    $pass = $obj_conn->connect[2];
    $db   = $obj_conn->connect[3];


    $conn = new mysqli($host,$user,$pass,$db);
    
    if ($conn->connect_error)
    {
        die ("Cannot connect " .$conn->connect_error);
    }
    else 
    {
        $email = $_SESSION["user_email"];
        $sql = "select * from users where user_email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $accountno = $row['user_accountno'];
        $ifsc      = $row['user_ifsc'];

        $sql2 = "select user_balance,user_accounttype from accounts where user_email = '$email'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();

        $sql3 = "select COUNT(*) from transactions_soul_bank
                 where _from_customer_account_no = '$accountno' or _to_customer_account_no = '$accountno'";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();

        $sql4 = "select COUNT(*) from transactions_other_bank
                 where _from_customer_ifsc = '$ifsc' or _to_customer_ifsc = '$ifsc'";
        $result4 = $conn->query($sql4);
        $row4 = $result4->fetch_assoc();
        
        ?>

    <div class="container" id="blur">
        <div class="l-navbar" id="navbar">
            
            <nav class="nav">
                <div>
                    <a href="user_dashboard.php" class="nav__logo">
                        <img src="Assets/images/PureSoul.svg" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Soul.pay</span>
                    </a>

                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-chevron-left sidebarBtn'></i>
                    </div>

                    <ul class="nav__list">
                        <a href="user_dashboard.php" class="nav__link active">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Home</span>
                        </a>
                        <div  class="nav__link nav__link1 collapse">
                            <i class='bx bx-transfer nav__icon' ></i>
                            <span class="nav__text">Transfer Funds</span>

                            <i class='bx bx-sm bx-chevron-down collapse__link'></i>
        
                            <ul class="collapse__menu">
                                <a href="transact_soul.php?otp_true" class="collapse__sublink" onclick="toggle()">Soul Accounts</a>
                                <a href="transact_other.php?otp_true" class="collapse__sublink" onclick="toggle()">Other Accounts</a>
                            </ul>
                        </div>
                        <a href="history.php" class="nav__link">
                            <i class='bx bx-history nav__icon' ></i>
                            <span class="nav__text">History</span>
                        </a>
                        <a href="#" class="nav__link" id="myProfile">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__text">My Profile</span>
                        </a>
                        <a href="#" class="nav__link" id="debitCard">
                            <i class='bx bxs-credit-card nav__icon' ></i>
                            <span class="nav__text">Debit Card Services</span>
                        </a>                 
                    </ul>
                </div>
                <a href="logout.php" class="nav__link">           
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
    <span class="icon-button__badge"></span>
  </button>
            </nav>

            <div class="home-content" id="home-content">
        

            <div class="home-content">
                <div class="overview-boxes">
                    <div class="box" style="width: 100%">
                    <i class='bx bxs-chevron-left icon'></i>
                        <div class="right-side" style="margin-left: 100px; margin-right: 100px">
                            <div class="box-topic" style="font-size: 25px; white-space: nowrap;"><?php echo $row['user_firstname'] . " " . $row['user_lastname']?></div>
                            <div class="number" style="font-size: 25px; margin-top: 10px"><?php echo $row['user_accountno']?></div>
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
                    <div class="number">
                      <?php if(!empty($row2['user_balance'])) {echo $row2['user_balance'];}?>
                    </div>

                </div>
                <i class='bx bx-rupee rupee'></i>
                </div>
                <div class="box">
                <div class="right-side right2">
                    <div class="box-topic">Account Status</div>
                    <div class="number">
                      <?php if(!empty($row2['user_balance'])) 
                                { 
                                  if($row2['user_accounttype']=="block")
                                  echo "Blocked";
                                }
                      ?>
                    </div>

                </div>
                <i class='bx bx-user-circle rupee two'></i>
                </div>
                <div class="box">
                <div class="right-side right3">
                    <div class="box-topic">Soul Transactions</div>
                    <div class="number"><?php echo $row3['COUNT(*)']?></div>

                </div>
                <i class='bx bx-transfer-alt rupee three'></i>

                </div>
                <div class="box">
                <div class="right-side right4">
                    <div class="box-topic">Other Transactions</div>
                    <div class="number"><?php echo $row4['COUNT(*)']?></div>
                </div>
                <i class='bx bx bx-transfer-alt rupee four' ></i>
                </div>
            </div>
            </div>
        </section>
    </div> 
    </div>
    <div class="modal-container" id="modal_container2">
    <div class="modal">
      <button id="close1" onclick="toggle2()" class="cross">
        <svg data-testid="test-svg" width="14" height="100%" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Artboard-Copy-43" transform="translate(-5.000000, -5.000000)">
            <g id="close">
              <path d="M5.57098982,5.65032324 C5.78968342,5.43162963 6.14425581,5.43162963 6.36294941,5.65032324 L6.36294941,5.65032324 L11.9059696,11.194303 L17.450383,5.65032324 C17.6447773,5.45592892 17.9465326,5.43432955 18.1647849,5.58552513 L18.2423426,5.65032324 C18.4610362,5.86901684 18.4610362,6.22358923 18.2423426,6.44228283 L18.2423426,6.44228283 L12.6979696,11.985303 L18.2423426,17.5297164 C18.4367369,17.7241107 18.4583363,18.025866 18.3071407,18.2441184 L18.2423426,18.321676 C18.023649,18.5403696 17.6690766,18.5403696 17.450383,18.321676 L17.450383,18.321676 L11.9059696,12.777303 L6.36294941,18.321676 C6.1685551,18.5160703 5.86679977,18.5376697 5.64854745,18.3864741 L5.57098982,18.321676 C5.35229621,18.1029824 5.35229621,17.74841 5.57098982,17.5297164 L5.57098982,17.5297164 L11.1149696,11.985303 L5.57098982,6.44228283 C5.3765955,6.24788852 5.35499614,5.94613319 5.50619171,5.72788087 Z" id="Combined-Shape"></path>
            </g>
          </g>
        </svg>
      </button>

      <form action="debitAppln.php" id="debitAppln">
        <h2>Apply For New Card</h2>
        <div class="form" id="debitform">

          <div class="card-transaction space icon-relative debit">
            <label class="label">Pick card type:<span style="color: red;">*</span></label>
            <div class="card-types">
              <input type="radio" name="cardtype" value="visa" class="card-type selected" checked><i class="fab fa-cc-visa"></i></input>
              <input type="radio" name="cardtype" value="paypal" class="card-type"><i class="fab fa-cc-paypal"></i></input>
              <input type="radio" name="cardtype" value="mastercard" class="card-type"><i class="fab fa-cc-mastercard"></i></input>
              <input type="radio" name="cardtype" value="amex" class="card-type"><i class="fab fa-cc-amex"></i></input>
            </div>
          </div>
          <label class="label">Set Delivery Address:</label>
          <div class="debit-address">
            <div class="card-transaction space icon-relative" id="debit-details">
              <label class="label">House No: <span style="color: red;">*</span></label>
              <input type="text" class="input" name="house" required>
            </div>
            <div class="card-transaction space icon-relative">
              <label class="label">Street: <span style="color: red;">*</span></label>
              <input type="text" class="input" name="street" required>
            </div>
            <div class="card-transaction space icon-relative">
              <label class="label">District: <span style="color: red;">*</span></label>
              <input type="text" class="input" name="district" onkeypress="return /[a-z]/i.test(event.key)" required>
            </div>
            <div class="card-transaction space icon-relative">
              <label class="label">State: <span style="color: red;">*</span></label>
              <input type="text" class="input" name="state" onkeypress="return /[a-z]/i.test(event.key)" required>
            </div>
            <div class="card-transaction space icon-relative">
              <label class="label">Pin Code: <span style="color: red;">*</span></label>
              <input type="number" class="input" name="pincode" onKeyPress="if(this.value.length==6) return false;" required>
            </div>
          </div>
          <div class="btn" onclick="submit();">
            Confirm Application
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php
  if ($_SESSION["verified"] == false) {
    echo "<div class=\"modal-container show1\" id=\"modal_container3\">
    <div class=\"modal\">
      <form action=\"verification.php\" id=\"debitAppln\">
        <h2>Please verify your identity before you can avail our services!</h2>
        <div class=\"form\" id=\"verifyprompt\">
          <a href=\"verification.php\" id=\"apply-debit\">
          <span class=\"nav__text\">Get Verified</span>
      </a>
      </div>
      </form>
    </div>
  </div>";
  }
  ?>

    <?php
        }
    }
    
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="JS/script.js"></script>
<script src="JS/script1.js"></script>
<script src="JS/dashboard.js"></script>
<script src="JS/timer.js"></script>

</body>
    
</html>
<?php
session_start();

if(!isset($_SESSION["user_email"]))
{
    header('Location: index.php');
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

    <style>
        .list { 
          width: 100%;
          text-align-last:center; 
        }

        .custom-select {
        position: relative;
          padding: 32px;
        }

        .custom-select:before {
            content: "";
            position: absolute;
            top: 50px;
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
            -moz-appearance:   none;
            appearance:        none;
        }

        option { 
          width: 400px; 
          text-align-last:center; 
        }
    </style>
</head>
<body>
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

                        

                        while ($row = $result->fetch_assoc())
                        {

                          $account_no = $row['user_accountno'];
                          $ifsc       = $row['user_ifsc'];

                          $sql2 = "select user_balance, user_accounttype from accounts where user_email = '$email'";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();

                        $sql3 = "select COUNT(*) from transactions_soul_bank
                                where _from_customer_account_no = '$account_no' or _to_customer_account_no = '$account_no'";
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
                        <img src="Assets/images/PureSoul.svg" width="100%" height="100px" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Soul.pay</span>
                    </a>

                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-chevron-left sidebarBtn'></i>
                    </div>

                    <ul class="nav__list">
                        <a href="user_dashboard.php" class="nav__link">
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
                        <a href="history.php" class="nav__link active">
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
                    <div class="number"><?php echo $row2['user_balance']?></div>

                </div>
                <i class='bx bx-rupee rupee'></i>
                </div>
                <div class="box">
                <div class="right-side right2">
                    <div class="box-topic">Account Status</div>
                    <div class="number"><?php echo $row2['user_accounttype'] ?></div>

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

       <?php                     
                          echo "<div align='center' class='custom-select'
                                <form>
                                  <select name='transactions' class='list' id='bank' onchange='showTransaction(this.value)'>
                                    <option selected disabled> Select Transactions </option> 
                                    <option value='All_banks'> All Banks </option>
                                    <option value='$account_no'> Soul Bank </option>
                                    <option value='$ifsc '>  Other Bank </option>
                                  </select>
                                </form>  
                                <div id='txtHint'></div>
                              </div>";
                        }
                    }
                }
            ?>

   
        </section>
    </div>
        
            </div>
    <?php
    require('script.php');

?>
    
      


</body>
</html>
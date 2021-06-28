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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/user_dashboard.css">
    <link rel="shortcut icon" href="Assets/favicons/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <title>Soul.pay | Other-Transfer</title>
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
                if (strpos($_SERVER['REQUEST_URI'], "?otp_true") !== false)
                {
                    $email = $_SESSION["user_email"];

                    $length_code = 4;
                    $otp = substr(str_shuffle("123456789"),0, $length_code);


                    $sql = "update accounts set otp = '$otp', otptime = NOW() where user_email = '$email'";
                    $result = $conn->query($sql);

                    $sql2 = "select user_accounttype from accounts where user_email = '$email'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    if($row2['user_accounttype'] == 'block')
                    {
                        echo '<script type="text/javascript">alert("Your account is not activated. Try again later");
                        </script>';
                        echo ("<script>location.href='user_dashboard.php'</script>");
                        exit;
                    }

                    if ($result == true)
                    {    

                      require 'phpmailer/PHPMailerAutoload.php';
                      $mail = new PHPMailer;
                      $mail ->isSMTP();
                  
                      $mail ->Host='smtp.gmail.com';
                      $mail ->port=587;
                      $mail ->SMTPAuth=true;
                      $mail ->SMTPSecure='tls';
                      
                      
                      $mail ->Username='soul.payy@gmail.com';
                      $mail ->Password='miniproject123';
                  
                      $mail ->setFrom('soul.payy@gmail.com','Soul.pay');
                      $mail ->addAddress($email);
                      $mail ->addReplyTo('soul.payy@gmail.com');
                  
                      $mail ->isHTML(true);
                      $mail ->Subject='OTP for Other Bank Transaction';
                      $mail ->Body="Dear Customer, <br><br> $otp is the OTP for completing your Other bank transaction.
                              Never share this OTP with anyone including Bank officials.
                              <br><br>Thank you,<br>Soul.pay";

                            if(!$mail->send())
                            {
                                echo '<script type="text/javascript">alert("OTP error. Please try again.");
                                </script>';
                                echo ("<script>location.href='user_dashboard.php'</script>");
                            } 
                            else
                            {
                                echo '<script type="text/javascript">alert("Check your mail for OTP");
                                </script>';
                                echo ("<script>location.href='transact_other.php?otp_one'</script>");
                            }  
                    }
                    echo "Found";
                }
            }
            $conn->close();
        }
      require_once ('dashboard.php');
    ?>

    <div class="modal-container show" id="modal_container1">
        <div class="modal">
            <button id="close1" onclick="window.location.href = 'user_dashboard.php';" class="cross">
                <svg data-testid="test-svg" width="14" height="100%" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Artboard-Copy-43" transform="translate(-5.000000, -5.000000)"><g id="close"><path d="M5.57098982,5.65032324 C5.78968342,5.43162963 6.14425581,5.43162963 6.36294941,5.65032324 L6.36294941,5.65032324 L11.9059696,11.194303 L17.450383,5.65032324 C17.6447773,5.45592892 17.9465326,5.43432955 18.1647849,5.58552513 L18.2423426,5.65032324 C18.4610362,5.86901684 18.4610362,6.22358923 18.2423426,6.44228283 L18.2423426,6.44228283 L12.6979696,11.985303 L18.2423426,17.5297164 C18.4367369,17.7241107 18.4583363,18.025866 18.3071407,18.2441184 L18.2423426,18.321676 C18.023649,18.5403696 17.6690766,18.5403696 17.450383,18.321676 L17.450383,18.321676 L11.9059696,12.777303 L6.36294941,18.321676 C6.1685551,18.5160703 5.86679977,18.5376697 5.64854745,18.3864741 L5.57098982,18.321676 C5.35229621,18.1029824 5.35229621,17.74841 5.57098982,17.5297164 L5.57098982,17.5297164 L11.1149696,11.985303 L5.57098982,6.44228283 C5.3765955,6.24788852 5.35499614,5.94613319 5.50619171,5.72788087 Z" id="Combined-Shape"></path></g></g></svg>
            </button>

              <h2>OTHER BANK GATEWAY</h2>
              <form action="" method="post">
              <div class="form">
                <div class="card space icon-relative">
                  <label class="label">Recipient: <span style="color: red;">*</span></label>
                  <input type="text" class="input" name="name" placeholder="Name" pattern="[A-Za-z]{1,32}" title="Only Characters" required>
                  <i class="far fa-user"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">Account Number: <span style="color: red;">*</span></label>
                  <input type="text" class="input" name="account_no" data-mask="000000000" placeholder="**********" required>
                  <i class="far fa-credit-card"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">IFSC: <span style="color: red;">*</span></label>
                  <input type="text" class="input"  name="ifsc" pattern="[A-Z]{4}[0-9]{7}" title="The first 4 uppercase letters and then up to 7 digits" required>
                  <i class="far fa-credit-card"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">Amount: <span style="color: red;">*</span></label>
                  <input type="text" class="input" name="main_amount" data-mask="00000" placeholder="" required>
                  <i class="bx bx-sm bx-rupee far"></i>
                </div>
                <div class="card space icon-relative">
                  <label class="label">Remark:</label>
                  <input type="text" class="input" required>
                </div>

                
                <div class="card-grp space">
                  <div class="card-item icon-relative">
                    <label class="label">OTP: <span style="color: red;">*</span></label>
                    <input type="text" class="input" name="otp" data-mask="0000" placeholder="####" required>
                    <i class="fas fa-lock"></i>
                  </div>
                  <div class="card-item1 space1">
                    <a href="otp_other.php" class="resend" onclick="return clearForm(this.form);">Resend?</a> 
                  </div>
                  <script>
                        function clearForm(form) {
                            var $f = $(form);
                            var $f = $f.find(':input').not(':button, :submit, :reset, :hidden');
                            $f.val('').attr('value','').removeAttr('checked').removeAttr('selected');
                        }
                    </script>
                </div>
                <div class="btn">
                  <button type="submit" name="transfer_other_bank" style="background-color: transparent; outline: none; background-repeat: no-repeat ; border: none; overflow: hidden; color: #f8f8f8; font-size: 1rem; cursor: pointer; font-family: 'Quicksand', sans-serif;">
                      Transfer 
                  </button>
                </div> 
                
              </div>
              </form>
            
                
        </div>
    </div>
    <?php
      require_once ('transact_other_pay.php');
      require ('script.php');
    ?>


</body>
</html>
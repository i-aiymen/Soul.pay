<?php

session_start();

    if(!isset($_SESSION["user_email"]))
    {
        header('Location: index.php');
    }
    require_once('DBCONFIG/dbconfig.php');
    if (class_exists('DATABASE_CONNECT'))
    {
        $obj_conn = new DATABASE_CONNECT;
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
            $length_code = 4;
            $otp = substr(str_shuffle("123456789"),0, $length_code);
            $sql = "update accounts set otp = '$otp', otptime = NOW() where user_email = '$email'";
            $result = $conn->query($sql);
            if ($result == true)
            {
                require 'phpmailer/PHPMailerAutoload.php';
                      $mail = new PHPMailer;
                      $mail ->isSMTP();
                  
                      $mail ->Host='smtp.gmail.com';
                      $mail ->port=587;
                      $mail ->SMTPAuth=true;
                      $mail ->SMTPSecure='tls';
                      
                      
                      $mail ->Username='Youremail@gmail.com';
                      $mail ->Password='Your password';

                      $mail ->setFrom('Youremail@gmail.com','');
                      $mail ->addAddress($email);
                      $mail ->addReplyTo('Youremail@gmail.com');
                  
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
            else
            { 
                exit;
            }
        }
    }
?>

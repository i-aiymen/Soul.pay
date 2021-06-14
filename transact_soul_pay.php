<?php


if(!isset($_SESSION["user_email"]))
  {
      header('Location: index.php');
  }

    if (isset($_POST['transfer_soul_bank'])) 
    {

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
                $lastname                  =   $_POST['lastname'];                 
                $account_no                =   $_POST['account_no'];
                $reason                    =   $_POST['reason'];
                $main_amount               =   $_POST['main_amount'];
                $otp                    =   $_POST['otp'];
                $email = $_SESSION["user_email"];



                $sql = "select user_accountno from accounts 
                        where user_email = '$email' ";
                $result = $conn->query($sql);

                $sql2 = "select user_lastname, user_accountno from accounts
                         where user_accountno = '$account_no' and user_accounttype = 'active' ";
                $result2 = $conn->query($sql2);

                while ($row = $result->fetch_assoc())
                {
                    $current_customer_acc_no = $row['user_accountno'];

                    if($current_customer_acc_no == $account_no)
                    {
                        echo '<script type="text/javascript">alert("INVALID TRANSFER - YOU CANNOT TRANSFER TO YOUR OWN ACCOUNT");
                                </script>';
                        exit;
                    }
                    else
                    {
                        if ($result2->num_rows>0)
                        {

                            while  ($row = $result2->fetch_assoc())
                            {
                
                                $lastname0   = $row['user_lastname'];   
                                $account_no0 = $row['user_accountno'];

                                if ($lastname0 == $lastname && $account_no0 == $account_no)           
                                { 
                                
                                }
                                else  
                                {
                                    echo '<script type="text/javascript">alert("YOUR ELEMENT IS INVALID");
                                    </script>';
                                    exit;
                                }  
                            } 
                        } 
                        else  
                        {
                            echo '<script type="text/javascript">alert("YOUR ELEMENT IS INVALID");
                                    </script>';
                                    exit;
                        }
                    }
                }


                $sql = "select limit_per_day_transfer from accounts where  user_email = '$email'";
                $result = $conn->query($sql);

                while  ($row = $result->fetch_assoc())
                {

                    if ($main_amount > $row['limit_per_day_transfer'])
                    {
                        echo '<script type="text/javascript">alert("You have exceeded the <strong> overtransfer limit.");
                                    </script>';
                                    exit;
                    }        

                }


                $sql = "select otp, otptime from accounts where  user_email = '$email'";
                $result = $conn->query($sql);

                while  ($row = $result->fetch_assoc())
                {
                    if ($otp != $row['otp'])
                    {
                        echo '<script type="text/javascript">alert("OTP error. Please try again.");
                        </script>';
                        exit;
                    }
                    if ($otp = $row['otp'])
                    {
                        $time_db = $row['otptime'];

                        $time_now = strtotime($time_db);
                        if (time() - $time_now > 10 * 60) 
                        {
                            echo '<script type="text/javascript">alert("Verification code expired  Get new code to finish transferring.");
                            </script>';
                            echo ("<script>location.href='transact_soul.php'</script>");
                        }
                        $sql2 = "update accounts set otp = null where user_email = '$email'";     
                        $result2 = $conn->query($sql2);
                    } 
                    else
                    {
                        echo'<script type="text/javascript">alert("The verification code is a mistake <strong> You can not make out the transaction.");
                        </script>';  
                        exit;                    
                    }
                }
                

                $sql = "select user_balance from accounts where user_email = '$email'";
                $result  = $conn->query($sql);

                while ($row = $result->fetch_assoc())
                {

                    $total_balance = $row['user_balance'];

                    if ($main_amount < 0)
                    { 
                        echo '<script type="text/javascript">alert("Negative value is Invalid. Please try again.");
                        </script>';
                        exit;
                    }
                    else if ($main_amount == 0)
                    { 
                        echo '<script type="text/javascript">alert("Invalid Value. Please try again.");
                        </script>';
                        exit;
                    }
                    else if ($main_amount > $total_balance)
                    { 
                        echo '<script type="text/javascript">alert("You do not have enough balance to do this transfer.");
                        </script>';
                        exit;
                    }
                    else if ($main_amount <= $total_balance)
                    {
                        $sql2 = "update accounts set amounts_transferred = amounts_transferred + $main_amount,
                                user_balance = user_balance - $main_amount
                                where user_email = '$email'";
                        $result2  = $conn->query($sql2);

                        $sql3 = "update accounts set amounts_from_others = amounts_from_others + $main_amount ,
                                user_balance = user_balance + $main_amount
                                where user_lastname= '$lastname' and user_accountno = '$account_no' ";
                        $result3  = $conn->query($sql3);
                    } 
                    else
                    {
                        exit;
                    }
                }


                $length_number = 16;
                $transaction_number = substr(str_shuffle("0123456789"),0, $length_number);

                $sql = "select user_lastname, user_accountno from users 
                         where user_email = '$email' ";
                $result  = $conn->query($sql);

                while ($row = $result->fetch_assoc())
                {
        
                    $_from_customer_lastname = $row['user_lastname'];
                    $_from_customer_account_no = $row['user_accountno'];

                    $sql2 = "insert into transactions_soul_bank  
                            (_from_customer_lastname, _from_customer_account_no,
                            _to_customer_lastname, _to_customer_account_no,
                            reason, transaction_number, amount)
                            values  
                            ('$_from_customer_lastname','$_from_customer_account_no',
                            '$lastname','$account_no',
                            '$reason', '$transaction_number', '$main_amount')";

                    $result2 = $conn->query($sql2);

                    $sql3 = "insert into transactions_all  
                            (_from_customer_lastname, _from_customer_accno_iban,
                            _to_customer_lastname, _to_customer_accno_iban,
                            reason, transaction_number, amount)
                            values  
                            ('$_from_customer_lastname','$_from_customer_account_no',
                            '$lastname','$account_no',
                            '$reason', '$transaction_number', '$main_amount')";

                    $result3 = $conn->query($sql3);

                    if ($result2 == true && $result3 == true)
                    {
                        echo '<script type="text/javascript">alert("This transfer was held successfully.");
                            </script>';
                        echo ("<script>location.href='user_dashboard.php'</script>");
                        exit;
                    }
                    else
                    {
                        echo "Error";
                    }
                }      
            } 
        } 
    } 
?>


<?php

    session_start();

     if(!isset($_SESSION["user_email"]))
    {
        header('Location: index.php');
    }

    if (isset($_POST['transfer_other_bank'])) 
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
                $name                  =   $_POST['name'];                 
                $account_no                =   $_POST['account_no'];
                $ifsc                      =   $_POST['ifsc'];
                $reason                    =   $_POST['reason'];
                $main_amount               =   $_POST['main_amount'];

                $otp                       =   $_POST['otp'];
                $email = $_SESSION["user_email"];



                $sql = "select user_accountno from accounts 
                        where user_email = '$email' ";
                $result = $conn->query($sql);

                $sql2 = "select Name, IFSC from other_bank
                         where IFSC = '$ifsc'";
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
                
                                $name0   = $row['Name'];   
                                $ifsc0 = $row['IFSC'];

                                if ($name0 == $name && $ifsc0 == $ifsc)           
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
                    if ($otp!= $row['otp'])
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
                            echo ("<script>location.href='transact_other.php'</script>");
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

                    $amount_reserve = 20;
                    $total_amount_with_reserve = $main_amount + $amount_reserve;
                    
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
                    else if ($total_amount_with_reserve > $total_balance)
                    { 
                        echo '<script type="text/javascript">alert("You do not have enough balance to do this transfer.");
                        </script>';
                        exit;
                    }
                    else if ($total_amount_with_reserve <= $total_balance)
                    {
                        $sql2 = "update accounts set amounts_transferred = amounts_transferred + $main_amount,
                                amounts_from_reserve = amounts_from_reserve + $amount_reserve,
                                user_balance = user_balance - $total_amount_with_reserve
                                where user_email = '$email'";
                        $result2  = $conn->query($sql2);

                        $sql3 = "update other_bank set Amount_from_others = Amount_from_others + $main_amount ,
                                Balance = Balance + $main_amount
                                where Name= '$name' and IFSC = '$ifsc' ";
                        $result3  = $conn->query($sql3);
                    } 
                    else
                    {
                        exit;
                    }
                }


                $length_number = 16;
                $transaction_number = substr(str_shuffle("0123456789"),0, $length_number);

                $sql = "select user_lastname, user_ifsc from users 
                         where user_email = '$email' ";
                $result  = $conn->query($sql);

                while ($row = $result->fetch_assoc())
                {
        
                    $amount_reserve =20;
                    $total_amount = $main_amount + $amount_reserve;

                    $_from_customer_lastname = $row['user_lastname'];
                    $_from_customer_ifsc = $row['user_ifsc'];

                    $sql2 = "insert into transactions_other_bank  
                            (_from_customer_lastname, _from_customer_ifsc,
                            _to_customer_lastname,_to_customer_ifsc,
                            reason, transaction_number, 
                            amount_from_reserve, amount, total_amount)
                            values  
                            ('$_from_customer_lastname',
                            '$_from_customer_ifsc',
                            '$name','$ifsc',
                            '$reason', '$transaction_number', 
                            '$amount_reserve', '$main_amount', '$total_amount')";
                    $result2 = $conn->query($sql2);

                    $sql3 = "insert into transactions_all  
                            (_from_customer_lastname,_from_customer_accno_iban,
                            _to_customer_lastname,_to_customer_accno_iban,
                            reason, transaction_number, amount)
                            values  
                            ('$_from_customer_lastname',
                            '$_from_customer_ifsc',
                            '$name',
                            '$ifsc',
                            '$reason', '$transaction_number', '$total_amount')";
                    $result3 = $conn->query($sql3);

                    $sql4 = "insert into soulbank_reserve
                            (_from_customer_lastname,_from_customer_ifsc,
                            _to_customer_lastname, _to_customer_ifsc,
                            transaction_number, amount_reserve)
                            values  
                            ('$_from_customer_lastname',
                            '$_from_customer_ifsc',
                            '$name',
                            '$ifsc',
                            '$transaction_number', '$amount_reserve')";
                    $result4 = $conn->query($sql4);

                    $sql5 = "update soulbank_total_reserves 
                            set total_reserve = total_reserve + '$amount_reserve'
                            where soul_bank_id = 'SOUL_PAY_1010'";
                    $result5 = $conn->query($sql5);

                    if ($result2 == true && $result3 == true && $result4 == true && $result5 == true)
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


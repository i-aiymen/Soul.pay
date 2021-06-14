<?php
session_start();

if(!isset($_SESSION["user_email"]))
{
    header('Location: index.php');
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="CSS/pdf.css">

    <title>DOWNLOAD | STATEMENT</title>

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
                $row = $result->fetch_assoc();

                $sql3 = "select user_balance from accounts where user_email = '$email'";
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();


                          $account_no = $row['user_accountno'];
                          $ifsc       = $row['user_ifsc'];
                          
                    $sql2 = "select date_transfer, _from_customer_lastname,
                            _from_customer_ifsc, _to_customer_lastname,
                            _to_customer_ifsc, transaction_number, amount                 
                            from transactions_other_bank 
                            where  _from_customer_ifsc = '$ifsc' or _to_customer_ifsc = '$ifsc' 
                            order by date_transfer desc";
                    $result2 = $conn->query($sql2);
            
    ?>
<button type="button" class="button" onclick="printDiv('printarea')" style="margin-left: 280px;">
  <span class="button__icon">
    <ion-icon name="cloud-download-outline"></ion-icon>
  </span>
</button>
    <div class="my-5 page" size="A4" id="printarea" style="width: 22cm;">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="photo3.svg" alt="" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Acc Statement</p>
                    </div>
                    <div class="position-relative">
                        <p>Date. <span><?php echo date("d.m.Y"); ?></span></p>
                    </div>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <div class="col-7">
                            <h2>Soul<span class="span-primary-color">.</span>pay</h2>
                            <p class="address"> Soul Towers, TVM <br> Street 750, Kerala, 456765</p>
                            <div class="txn mt-2">Phone: 1800 420 1112</div>
                        </div>
                        <div class="col-5">
                            <h2><?php echo $row['user_firstname'] . " " . $row['user_lastname']?></h2>
                            <p class="address"> <?php echo $row['use_street'] . ", " . $row['user_houseno']?><br> 
                            <?php echo $row['user_district'] . ", " . $row['user_state']?></p>
                            <div class="txn mt-2">Phone: <?php echo $row['user_phone']?></div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Account No: <span> <?php echo $row['user_accountno']?></span></p>
                            <p>Account Status: <span>Active</span></p>
                        </div>
                        <div class="col-5">
                            <p>IFSC: <span><?php echo $row['user_ifsc']?></span></p>
                            <p>Balance: <span><?php echo $row3['user_balance']?></span></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="product-area mt-4">

                
                <table class="table table-hover" style="margin-bottom:50px;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction.No</th>
                            <th>Amount</th>
                            <th>DB/CR</th>
                            <th>From/To</th>
                            <th>IFSC</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row2 = $result2->fetch_assoc())
                    { 
    ?>
                        <tr>
                        <td data-heading='Date'><?php echo $row2['date_transfer']?></td>
                        <td data-heading='Transaction.No'><?php echo  $row2['transaction_number']?></td>
                        <td data-heading='Amount'><?php echo $row2['amount']?> ₹</td>
                        <td data-heading='DB/CR'>
                            <?php 
                                
                                if($row['user_lastname'] == $row2['_to_customer_lastname'])
                                {
                                    echo 'Credit';
                                }
                                else
                                {
                                    echo 'Debit';
                                }
                            ?>
                        </td>
                        <td data-heading='From/To'>
                            <?php 
                                if($row['user_lastname'] == $row2['_to_customer_lastname'])
                                {
                                    echo $row2['_from_customer_lastname'];
                                }
                                else
                                {
                                    echo $row2['_to_customer_lastname'];
                                }
                            ?>
                        </td>
                        <td data-heading='IFSC'>
                            <?php 
                                if($row['user_lastname'] == $row2['_to_customer_lastname'])
                                {
                                    echo $row2['_from_customer_ifsc'];
                                }
                                else
                                {
                                    echo $row2['_to_customer_ifsc'];
                                }
                            ?>
                        </td>
                        </tr>
                        <?php
                    }
    ?>        
                    </tbody>
                </table>
                <?php
                        }
                    }
                        ?>
            
            </section>

                <div align="left" style="margin-left:-15px; font-size:13px; margin-bottom: 15px">
                    Abbreviations Used:
                    <span style="margin-left:10px">DB : Debit</span>   
                    <span style="margin-left:10px">CR : Credit</span>
                </div>
                <div class="row">
                        <p class="m-0 font-weight-bold" style="font-size: 10px;"> DISCLAIMER: </p>
                        <p style="font-size: 10px;">This computer generated statement contains the particulars of the transaction(s) in the account that have been updated till the time of day end operations of the Bank on the
previous working day and the same will not reflect the transaction(s) that have occurred in the account, if any, subsequent thereto. The <span style="font-weight: 700;"> Soul.pay</span> shall not be liable/responsible for want of full
particulars of the transaction(s) at the time of the generation of this statement.</p>
                        <p style="font-size: 10px;">This is a computer generated statement which need not normally be signed. Contents of this statement will be considered correct if no error is reported within 21 days of the statement date.</p>
    
                    
                </div>
            <div class="footer">
                <hr>
                <p class="m-0 text-center">
                    END OF STATEMENT
                </p>
                <div class="social pt-3">
                    
                    <span class="pr-2">
                        <i class="fas fa-envelope"></i>
                        <span>soul.payy@gmail.com</span>
                    </span>

                </div>
            </div>
            
        </div>
    </div>
    <?php
    require ('script.php');

?>






</body></html>
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
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <style>

        .content-table {
        border-radius: 5px;
        }

        .table-container1 {
        padding-top: 15px;
        padding-bottom: 32px;
        padding-left: 0;
        padding-right: 0;
        }

        .table-container1 h2.table-heading {
        text-align: center;
        text-transform: uppercase;
        font-size: 24px;
        margin-bottom: 32px;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
        }

        .table-container1 table {
        width: 100%;
        background: #fff;
        color: #222;
        padding: 24px;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.4);
        border-collapse: collapse;
        overflow: hidden;

        }

        .table-container1 table thead tr {
        background: #1a233d;
        color: #fff;
        }

        .table-container1 table td,
        .table-container1 table th {
        padding: 25px 20px;
        text-align: center;
        }

        .table-container1 table tr {
        border-bottom: 1px solid #eee;
        }

        a {
        text-decoration: none;
        cursor: pointer;
        background: none;
        font-size: 16px;
        outline: none;
        border: none;
        display: block;
        color: #878787;
        margin-top: 10px;
        }

        a:hover {
            color: black;
        }

        @media (max-width: 1000px) {

                .content-table {
            border-radius: 12px;
            }

            
            .table-container1 table thead {
                display: none;
            }

            .table-container1 table tr {
                border-bottom: 2px solid #eee;
            }

            .table-container1 table td {
                display: block;
                padding-bottom: 0;
                text-align: left;
            }


            .table-container1 table td::before {
                content: attr(data-heading) ": ";
                font-weight: bold;
            }
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
                $q = $_GET['bank'];
                $email = $_SESSION["user_email"];
                $sql = "select user_lastname from accounts where user_email = '$email'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if (strpos($q, 'SOUL') !== false) 
                {
                    $sql1 = "select date_transfer, _from_customer_lastname, 
                            _from_customer_ifsc, _to_customer_lastname,
                            _to_customer_ifsc, transaction_number, amount                 
                            from transactions_other_bank 
                            where  _from_customer_ifsc = '".$q."' or _to_customer_ifsc = '".$q."' 
                            order by date_transfer desc";
                    $result1 = $conn->query($sql1);
            
    ?>
                    <div class='table-container1'>
                        <table class='content-table'>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>DB/CR</th>
                                    <th>From/To</th>
                                    <th>IFSC</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
                    while ($row1 = $result1->fetch_assoc())
                    { 
    ?>
                            <tr>
                                <td data-heading='Date'><?php echo $row1['date_transfer']?></td>
                                <td data-heading='Transaction.No'><?php echo  $row1['transaction_number']?></td>
                                <td data-heading='Amount'><?php echo $row1['amount']?> ₹</td>
                                <td data-heading='DB/CR'>
                                    <?php 
                                        
                                        if($row['user_lastname'] == $row1['_to_customer_lastname'])
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
                                        if($row['user_lastname'] == $row1['_to_customer_lastname'])
                                        {
                                            echo $row1['_from_customer_lastname'];
                                        }
                                        else
                                        {
                                            echo $row1['_to_customer_lastname'];
                                        }
                                    ?>
                                </td>
                                <td data-heading='IFSC'  style='padding-bottom: 25px;'>
                                    <?php 
                                        if($row['user_lastname'] == $row1['_to_customer_lastname'])
                                        {
                                            echo $row1['_from_customer_ifsc'];
                                        }
                                        else
                                        {
                                            echo $row1['_to_customer_ifsc'];
                                        }
                                    ?>
                                </td>        
                            </tr>
    <?php
                    }
    ?>
                            </tbody>
                        </table>
                    </div>            
    <?php
                    echo    '<div align="left">
                                Abbreviations Used:  <span style="margin-left: 30px;">DB : Debit</span>   <span style="margin-left: 30px;">CR : Credit</span> 
                            </div>';
                    echo    '<div align="center" style="margin-top:15px"> 
                                <i class="bx bx-sm bx-download"></i> 
                                <a href="otherstatement.php">
                                    Download Transactions of Other Banks
                                </a> 
                            </div>';
                
                }

                else  if (strpos($q, 'All') !== false) 
                {
                    $email = "aiymenarbaaz03@gmail.com";
                    $sql1 = "select user_accountno, user_ifsc from accounts where user_email = '$email'";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_assoc();

                    $account_no = $row1['user_accountno'];
                    $ifsc       = $row1['user_ifsc'];

                    $sql3 = "select date_transfer, _from_customer_lastname,
                            _from_customer_accno_iban, _to_customer_lastname,
                            _to_customer_accno_iban, transaction_number, amount                
                            from transactions_all 
                            where  _from_customer_accno_iban = '$account_no' or _from_customer_accno_iban = '$ifsc' or _to_customer_accno_iban = '$account_no' or _to_customer_accno_iban = '$ifsc'
                            order by date_transfer desc";
                    $result3 = $conn->query($sql3);
    ?>
                    <div class='table-container1'>
                        <table class='content-table'>
                            <thead>
                                <tr>
                                <th>Date</th>
                                <th>Transaction.No</th>
                                <th>Amount</th>
                                <th>DB/CR</th>
                                <th>From/To</th>
                                <th>Acc.No/IFSC</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
                    while ($row3 = $result3->fetch_assoc())
                    { 
    ?>                     
                            <tr>
                                <td data-heading='Date'><?php echo $row3['date_transfer']?></td>
                                <td data-heading='Transaction.No'><?php echo $row3['transaction_number']?></td>
                                <td data-heading='Amount' ><?php echo $row3['amount']?> ₹</td>
                                <td data-heading='DB/CR'>
                                    <?php 
                                        
                                        if($row['user_lastname'] == $row3['_to_customer_lastname'])
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
                                        if($row['user_lastname'] == $row3['_to_customer_lastname'])
                                        {
                                            echo $row3['_from_customer_lastname'];
                                        }
                                        else
                                        {
                                            echo $row3['_to_customer_lastname'];
                                        }
                                    ?>
                                </td>
                                <td data-heading='Acc.No/IFSC'  style='padding-bottom: 25px;'>
                                    <?php
                                        if($row['user_lastname'] == $row3['_to_customer_lastname'])
                                        {
                                            echo $row3['_from_customer_accno_iban'];
                                        }
                                        else
                                        {
                                            echo $row3['_to_customer_accno_iban'];
                                        } 
                                    ?>
                                </td>
                                
                                
                            </tr>
    <?php
                    }
    ?>
                            </tbody>
                        </table>
                    </div>
    <?php
                    echo    '<div align="left">
                                Abbreviations Used:  <span style="margin-left: 30px;">DB : Debit</span>   <span style="margin-left: 30px;">CR : Credit</span> 
                            </div>';
                    echo    '<div align="center"  style="margin-top:15px"> 
                                <i class="bx bx-sm bx-download"></i>
                                <a href="allstatement.php"> 
                                    Download Transactions of All Banks
                                </a> 
                            </div>';
        
                }

                else
                {
                    $sql4 = "select date_transfer, _from_customer_lastname, 
                            _from_customer_account_no, _to_customer_lastname,
                            _to_customer_account_no, transaction_number, amount                 
                            from transactions_soul_bank 
                            where  _from_customer_account_no = '".$q."' or _to_customer_account_no = '".$q."'
                            order by date_transfer desc";
                    $result4 = $conn->query($sql4);

    ?>
                    <div class='table-container1'>
                        <table class='content-table'>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction.No</th>
                                    <th>Amount</th>
                                    <th>DB/CR</th>
                                    <th>From/To</th>
                                    <th>Account.No</th>  
                                </tr>
                            </thead>
                            <tbody>
    <?php
                            while ($row4 = $result4->fetch_assoc())
                            { 
    ?> 
                            <tr>
                                <td data-heading='Date'><?php echo $row4['date_transfer']?></td>
                                <td data-heading='Transaction.No'><?php echo $row4['transaction_number']?></td>
                                <td data-heading='Amount'><?php echo $row4['amount']?> ₹</td>
                                <td data-heading='DB/CR'>
                                    <?php 
                                        
                                        if($row['user_lastname'] == $row4['_to_customer_lastname'])
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
                                        if($row['user_lastname'] == $row4['_to_customer_lastname'])
                                        {
                                            echo $row4['_from_customer_lastname'];
                                        }
                                        else
                                        {
                                            echo $row4['_to_customer_lastname'];
                                        }
                                    ?>
                                </td>
                                <td data-heading='Account.No'  style='padding-bottom: 25px;'>
                                    <?php 
                                        if($row['user_lastname'] == $row4['_to_customer_lastname'])
                                        {
                                            echo $row4['_from_customer_account_no'];
                                        }
                                        else
                                        {
                                            echo $row4['_to_customer_account_no'];
                                        }
                                    ?>
                                </td>    
                            </tr>
    <?php
                            }
    ?>
                            </tbody>
                        </table>
                    </div>
    <?php
                    echo    '<div align="left">
                                Abbreviations Used:  <span style="margin-left: 30px;">DB : Debit</span>   <span style="margin-left: 30px;">CR : Credit</span> 
                            </div>';
                    echo    '<div align="center"  style="margin-top:15px"> 
                                <i class="bx bx-sm bx-download"></i>
                                <a href="soulstatement.php">  
                                    Download Transactions of Soul Bank
                                </a> 
                            </div>';
                }
        
            }

        }
    ?>
</body>
</html>
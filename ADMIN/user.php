<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soul.pay | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'> 
    <link rel="shortcut icon" href="http://localhost/Soulbank/Assets/favicons/favicon-16x16.png" type="image/x-icon">   
    <link rel="stylesheet" href="http://localhost/Soulbank/CSS/admin_nav.css">
    <link rel="stylesheet" href="http://localhost/Soulbank/CSS/admin.css">

</head>
<body>
    <div class="page-wrapper">
<?php
    include ($_SERVER['DOCUMENT_ROOT']."/INCLUDES/admin_nav.php");
?>
    <div class="item1">
    <h1>SOUL<span class="span-primary-color">.</span>PAY PANEL</h1>
    </div> 
<?php 

    if (!isset($_SESSION['login']))
    {
        header("Location: admin.php");
    }
    else
    {

        require_once($_SERVER['DOCUMENT_ROOT']."/DBCONFIG/dbconfig.php");

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
                $sql = "select * from users order by user_lastname asc";
                $result = $conn->query($sql);

?>
                <section class="recent">
                  <div class="activity-card">
                    <div class="table-responsive">
                      <table>
                        <thead>
                            <tr>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Date of Birth</th>
                              <th>Aadhar No</th>
                              <th>Mobile No</th>
                              <th>ID Front</th>
                              <th>ID Back</th>
                              <th>Status</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>

<?php
                        while ($row = $result->fetch_assoc())
                        {
                                if ($row['user_accountstate'] == 'block' )
                                {
                                    $acc_condition1 = 'checked';
                                    $acc_condition2 = '';
                                }
                                else if ($row['user_accountstate'] == 'active' )
                                {
                                    $acc_condition1 = '';
                                    $acc_condition2 = 'checked';
                                }
                            
?>
                            <tr>
                                <td><?php echo $row['user_firstname']?></td>
                                <td><?php echo $row['user_lastname']?></td>
                                <td><?php echo $row['user_dob']?></td>
                                <td><?php echo $row['user_aadharno']?></td>
                                <td><?php echo $row['user_phone']?></td>
                                <td><?php echo $row['user_aadharfrontname']?></td>
                                <td><?php echo $row['user_aadharbackname']?></td>
                                <td>
<?php
                                    if ($row['user_accountstate'] == 'active' )
                                    {
?>
                                        <span class="badge success"><?php echo $row['user_accountstate']?></span>
<?php
                                    }
                                    else if($row['user_accountstate'] == 'block' ) 
                                    {
?> 
                                        <span class="badge warning"><?php echo $row['user_accountstate']?></span>
<?php
                                    }
?>
                                </td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='lastname_account_condition' value='<?php echo $row['user_lastname']?>'>
                                        <input type='hidden' name='firstname_account_condition' value='<?php echo $row['user_firstname']?>'>
                                        <input type='hidden' name='account_no' value='<?php echo $row['user_accountno']?>'>
                                        <input type='hidden' name='account_ifsc' value='<?php echo $row['user_ifsc']?>'>
                                        <input type='hidden' name='id_account_condition' value='<?php echo $row['user_id']?>'>
                                        <span class='block'>Block</span><input type='radio' name='account_condition'   style="margin-right:10px; "  value='block' <?php echo $acc_condition1 ?>> 
                                        <span class='block'>Active</span><input type='radio' name='account_condition' value='active' <?php echo $acc_condition2 ?>>
                                        <button type='submit' name='submit_account_condition' class="button">
                                          <span class="button__icon">
                                              <ion-icon name="checkmark-done-outline"></ion-icon>
                                          </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
<?php         
                       
                    }
?>
                        </tbody>
                      </table>
                    </div>
                  </div>   
                </section>  

<?php
                if (isset($_POST['submit_account_condition']))
                {
                    $lastname_account_condition = $_POST['lastname_account_condition'];
                    $firstname_account_condition = $_POST['firstname_account_condition'];
                    $id_account_condition = $_POST['id_account_condition'];
                    $account_no = $_POST['account_no'];
                    $account_ifsc = $_POST['account_ifsc'];
                    $account_condition = $_POST['account_condition'];

                    $sql_account_condition = "update users set user_accountstate = '$account_condition' 
                                            where user_id = '$id_account_condition'
                                            and user_firstname = '$firstname_account_condition'
                                            and user_lastname = '$lastname_account_condition'
                                            and user_accountno = '$account_no' and user_ifsc = '$account_ifsc' ";
                     $result_account_condition = $conn->query($sql_account_condition);
                    

                    if ($result_account_condition == true)
                    {

                        $sql_account_statment = "update accounts set user_accounttype = '$account_condition'
                    where user_accountno = '$account_no' and user_ifsc = '$account_ifsc'
                    and user_lastname = '$lastname_account_condition' and user_firstname = '$firstname_account_condition'";
                    $result_account_statment = $conn->query($sql_account_statment);
                        echo "<script type='text/javascript'>alert('Account $firstname_account_condition $lastname_account_condition is $account_condition');
                              </script>";
                        echo ("<script>location.href='user.php'</script>");
                    }
                }
            }
        }
    }
?>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
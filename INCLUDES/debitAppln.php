<?php
    session_start();
    
    $userid=$_SESSION["user_id"];

    $cardtype=$_GET['cardtype'];
    $house=$_GET['house'];
    $street=$_GET['street'];
    $district=$_GET['district'];
    $state=$_GET['state'];
    $pincode=$_GET['pincode'];

    require_once($_SERVER['DOCUMENT_ROOT']."/mini_project_s4/DBCONFIG/dbconfig.php");

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

    $sql = "insert into debitcard (user_id,debit_cardtype,debit_house,debit_street,debit_district,debit_state,debit_pincode) values(?,?,?,?,?,?,?);";


    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../failed.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss",$userid,$cardtype,$house,$street,$district,$state,$pincode);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<center><h2>Success!</h2></center>";

}
}

?>
<?php
    $d = $_GET["district"];
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
    
    $sql = "select distinct * from atms where district = \"$d\" ORDER BY ATMname;";
    
    $result=mysqli_query($conn,$sql);
    $resultnum = mysqli_num_rows($result);
    // echo "<option>".$resultnum." </option>";
    $count = 0;
    // echo "<option value=".$stt."> hello </option>";
    if($resultnum>0){
        while($row=mysqli_fetch_assoc($result)){
            echo "<div class=\"col my-4\">
                    <div class=\"card h-100\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\" style=\"font: bold;\">".++$count.". ".ucfirst(strtolower($row['ATMname']))." ATM</h5>
                            <p class=\"card-text\">ATM Branch: ".$row['Branch']."
                            <br>
                            TerminalID: ".$row['TerminalID']."
                            <br>
                            Address: ".$row['Address']."
                            <br>
                            ".$row['District']."
                            <br>
                            ".$row['State']."
                            <br>
                            Contact Num: ".$row['ContactNum']."
                            </p>
                        </div>
                    </div>
                </div>"; 
        }
    }
}
}

?>
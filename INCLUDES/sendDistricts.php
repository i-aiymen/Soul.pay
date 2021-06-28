<?php
    $state = $_GET["selectvalue"];
    $type = $_GET["type"];
    // $stt = "ANDHRA PRADESH";
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
    
    if($type=="StateBranch"){
        $sql = "select distinct District from branches where State = \"$state\" ORDER BY District;";
    }
    else{
        $sql = "select distinct District from atms where State = \"$state\" ORDER BY District;";
    }
    
    $result=mysqli_query($conn,$sql);
    $resultnum = mysqli_num_rows($result);
    // echo "<option>".$resultnum." </option>";
    
    // echo "<option value=".$stt."> hello </option>";
    if($resultnum>0){
        while($row=mysqli_fetch_assoc($result)){
            $d= $row['District'];
            $statement = "<option value='".$d."'>".$d."</option>";
            echo $statement; 
        }
    }
}
}

?>
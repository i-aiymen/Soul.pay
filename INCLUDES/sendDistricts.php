<?php
    $state = $_GET["selectvalue"];
    $type = $_GET["type"];
    // $stt = "ANDHRA PRADESH";
    require_once('dbconfig.inc.php');
    
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
<?php
    $stt = $_GET["selectvalue"];
    require_once('dbconfig.inc.php');
    
    $sql = "select distinct District from branches where State = \"$stt\" ORDER BY District;";
    
    $result=mysqli_query($conn,$sql);
    $resultnum = mysqli_num_rows($result);
    // echo "<option>".$resultnum." </option>";
    
    // echo "<option value=".$stt."> hello </option>";
    if($resultnum>0){
        while($row=mysqli_fetch_assoc($result)){
            $d= $row['District'];
            $statement = "<option value=".$d.">".$d."</option>";
            echo $statement; 
        }
    }
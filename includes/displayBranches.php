<?php
    $d = $_GET["district"];
    require_once('dbconfig.inc.php');
    
    $sql = "select distinct * from branches where district = \"$d\" ORDER BY Branch;";
    
    $result=mysqli_query($conn,$sql);
    $resultnum = mysqli_num_rows($result);
    // echo "<option>".$resultnum." </option>";
    $count = 0;
    // echo "<option value=".$stt."> hello </option>";
    if($resultnum>0){
        while($row=mysqli_fetch_assoc($result)){
            echo "<div class=\"col my-4\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">".++$count.". ".ucfirst(strtolower($row['Branch']))." Branch</h5>
                            <p class=\"card-text\">Branch Incharge: ".$row['BranchIncharge']."
                            <br>
                            IFSCode: ".$row['IFSCcode']."
                            <br>
                            Contact Num: ".$row['ContactNum']."
                            </p>
                        </div>
                    </div>
                </div>"; 
        }
    }
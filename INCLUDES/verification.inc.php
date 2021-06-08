<?php
    if(!isset($_POST['submit'])){
        header("location: ../verification.php");
        exit();
    }
    else {

        $verifyArr=array();

        $verifyArr['fname'] = $_POST["fname"];
        $verifyArr['lname'] = $_POST["lname"];
        $verifyArr['email'] = $_POST["email"];
        $verifyArr['phone'] = $_POST["phone"];
        $verifyArr['dob'] = $_POST["dob"];
        $verifyArr['house'] = $_POST["house"];
        $verifyArr['street'] = $_POST["street"];
        $verifyArr['district'] = $_POST["district"];
        $verifyArr['state'] = $_POST["state"];
        $verifyArr['pincode'] = $_POST["pin"];
        $verifyArr['nationality'] = $_POST["nationality"];
        $verifyArr['aadharNum'] = $_POST["aadhar"];
        $verifyArr['spin'] = $_POST["spin"];
        $verifyArr['spinRepeat'] = $_POST["spinrepeat"];

        //for images
        $targetDir = "../Assets/userUploads/";
        $verifyArr['aadharFrontName'] = basename($_FILES["aadharf"]["name"]);
        $verifyArr['aadharBackName'] = basename($_FILES["aadharb"]["name"]);
        $targetFilePathFront = $targetDir.$verifyArr['aadharFrontName'];
        $targetFilePathBAck = $targetDir.$verifyArr['aadharBackName'];
        $verifyArr['aadharFrontSize'] = $_FILES["aadharf"]["size"];
        $verifyArr['aadharBackSize'] = $_FILES["aadharb"]["size"];
        
        $userid=1;

        require_once("dbconfig.inc.php");
        require_once("functions.inc.php");


        // if(invalidEmail($email) !== false){
        //     header("location: ../signup.php?error=invalidemail");
        //     exit();
        // }
        

        if(pwdMatch($verifyArr['spin'],$verifyArr['spinRepeat']) !== false){
            header("location: ../verification.php?error=pinnomatch");
            exit();
        }

        if(verifyUser($conn,$verifyArr,$userid) !== false){
            header("location: ../verification.php?error=verificationfailed");
            exit();
        }
        else{
            //storing files in server
            if(move_uploaded_file($_FILES["aadharf"]["tmp_name"], $targetFilePathFront) &&
            move_uploaded_file($_FILES["aadharb"]["tmp_name"], $targetFilePathBAck)){
                
                header("location: ../verification.php?error=none");
                exit();

            }

            else{
                header("location: ../verification.php?error=fileuploadfailed");
                exit();
            }

        }
    }
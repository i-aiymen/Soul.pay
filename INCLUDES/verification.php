<?php
    session_start();
    if(!isset($_POST['submit']) || !isset($_SESSION["user_id"]) ){
        header("location: ../index.php");
        exit();
    }
    else {

        $userid = $_SESSION["user_id"];
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
        require_once("functions.php");


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
                session_unset();
                session_destroy();
                header("location: ../login.php?error=vnone");
                exit();

            }

            else{
                header("location: ../verification.php?error=fileuploadfailed");
                exit();
            }

        }
    }
    }
    }
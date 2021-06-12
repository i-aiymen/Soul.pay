<?php
    if(!isset($_POST['submit'])){
        header("location: ../signup.php");
        exit();
    }
    else {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $pwds = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];
        require_once("dbconfig.inc.php");
        require_once("functions.inc.php");

        // if(emptyInputSignUp($email,$user,$phone,$pwd,$pwdRepeat) !== false){
        //     header("location: ../signup.php?error=emptyinput");
        //     exit();
        // }

        // if(invalidUid($user) !== false){
        //     header("location: ../signup.php?error=invaliduid");
        //     exit();
        // }

        // if(invalidEmail($email) !== false){
        //     header("location: ../signup.php?error=invalidemail");
        //     exit();
        // }
        
        if(usrExists($conn,$email) !== false){
            header("location: ../signup.php?error=uidexists");
            exit();
        }
        
        if(pwdMatch($pwds,$pwdRepeat) !== false){
            header("location: ../signup.php?error=pwdnomatch");
            exit();
        }
        
        if(pwdStrength($pwds)!== false){
            header("location: ../signup.php?error=pwdstrength");
            exit();
        }
        createUser($conn,$fname,$lname,$email,$phone,$pwds);
    }
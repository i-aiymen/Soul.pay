<?php
    if(isset($_POST["submit"]))
    {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        require_once($_SERVER['DOCUMENT_ROOT']."/Soulbank/DBCONFIG/dbconfig.php");

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

        if(emptyInputLogin($email,$pwd) !== false){
            header("location: ../login.php?error=emptyinput");
            exit();
        }
        loginUser($conn,$email,$pwd);

        }
    }
    }

    else
    {
        header("location ../login.php");
        exit();
    }

?>
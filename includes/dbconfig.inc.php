<?php
    $servername="localhost";
    $username="root";
    $pwd="";
    $database = "banking";

    $conn = mysqli_connect($servername,$username,$pwd,$database);
    if(!$conn){
        die("Server connection error".mysqli_connect_error);
    }
    
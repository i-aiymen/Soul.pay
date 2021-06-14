<?php
    $servername="localhost";
    $username="root";
    $pwdk="almaas03";
    $database = "banking";

    $conn = mysqli_connect($servername,$username,$pwdk,$database);
    if(!$conn){
        die("Server connection error".mysqli_connect_error());
    }
    
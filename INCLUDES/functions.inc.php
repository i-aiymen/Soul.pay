<?php

// function emptyInputSignUp($name,$email,$user,$phone,$pwd,$pwdRepeat){
//     $result;
//     if(empty($name) || empty($user) || empty($pwd) ||empty($email) ||empty($pwdRepeat) ||empty($phone) ){
//         $result = true;
//     }
//     else $result = false;
//     return $result;
// }

// function invalidUid($user){
//     $result;
//     if(!preg_match("/^[a-zA-Z0-9]*$/",$user) ){
//         $result = true;
//     }
//     else $result = false;
//     return $result;
// }

// function invalidEmail($email){
//     $result;
//     if(!filter_var($email,FILTER_VALIDATE_EMAIL) ){
//         $result = true;
//     }
//     else $result = false;
//     return $result;
// }


function usrExists($conn, $email)
{
    $sql = "select * from users where user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../singup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    } 
    else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

function pwdMatch($pwd, $pwdRepeat)
{
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else $result = false;
    return $result;
}


function pwdStrength($pwd)
{
    $uppercase = preg_match('@[A-Z]@', $pwd);
    $lowercase = preg_match('@[a-z]@', $pwd);
    $number    = preg_match('@[0-9]@', $pwd);
    $specialChars = preg_match('@[^\w]@', $pwd);

    $strength = $uppercase+$lowercase+$number+$specialChars;
    if ($strength >2 && strlen($pwd) >= 8) {
        $result = false;
    } else $result = true;
    return $result;
}

function createUser($conn, $fname, $lname, $email, $phone, $pwd)
{
    $sql = "insert into users (user_firstname,user_lastname,user_email,user_phone,user_pwd,user_accountstate) values(?,?,?,?,?,'BLOCKED');";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $phone, $hashPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
}

function verifyUser($conn,$verifyArr,$userid)
{   
    $sql = "update users SET `user_firstname` = ?, `user_lastname` = ?, `user_dob`= ?, `user_email`= ?, `user_phone`= ?, `user_aadharno`= ?, `user_pin`= ?, `user_balance`= 5000, `user_nationality`= ?, `user_houseno`= ?, `use_street`= ?, `user_district`= ?, `user_state`= ?, `user_accountstate`= 'BLOCKED', `user_aadharfrontname`= ?, `user_aadharfrontsize`= ?, `user_aadharbackname`= ?, `user_aadharbacksize`= ?, `user_pincode`= ?, `user_accountno`= ? WHERE `users`.`user_id` = ?;";
    
    /*user_id   user_firstname   user_lastname   user_dob   user_email   user_phone   """user_pwd"""   user_aadharno   """user_pan"""   user_pin   """user_accountno"""   user_balace   """user_ifsc"""   user_nationality   user_houseno   use_street   user_district   user_state   """user_creation"""   user_accountstate   "user_aadharfrontname"   "user_aadharfrontsize"   "user_aadharfronttype"   "user_aadharbackname"   "user_aadharbacksize"   "user_aadharbacktype"   user_pincode */
    
    // update users SET `user_firstname` = 'Manu', `user_lastname` = 'Jasan', `user_dob`= '10-09-2000', `user_email`= 'manujasan23@gmail.com', `user_phone`= 3838383838, `user_aadharno`= 939393938281, `user_pin`= '$2y$10$3hlIC1F.Q3dZxREulp0Sp.HmqrQ3NMCdVTx2TXLtBAWCUauf6K4.W', `user_balance`= 5000, `user_nationality`= 'India', `user_houseno`= '23', `use_street`= 'what', `user_district`= 'kottayam', `user_state`= 'kerala', `user_accountstate`= 'BLOCKED', `user_aadharfrontname`= 'mike', `user_aadharfrontsize`= 38383, `user_aadharbackname`= 'mdj', `user_aadharbacksize`= 328282, `user_pincode`= 38383, `user_accountno`= 3333838 WHERE `users`.`user_id` = 9;

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../verification.php?error=stmtfailed");
        exit();
    }
    
    $verifyArr["phone"]=(string)$verifyArr["phone"];
    $hashSpin = password_hash($verifyArr['spin'], PASSWORD_DEFAULT);
    $useraccountno= $userid + 228282828;
    
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $verifyArr['fname'], $verifyArr['lname'],$verifyArr['dob'], $verifyArr['email'], $verifyArr['phone'],$verifyArr['aadharNum'], $hashSpin,$verifyArr['nationality'],$verifyArr['house'],$verifyArr['street'],$verifyArr['district'],$verifyArr['state'],$verifyArr['aadharFrontName'],$verifyArr['aadharFrontSize'],$verifyArr['aadharBackName'],$verifyArr['aadharBackSize'],$verifyArr['pincode'],$useraccountno,$userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return false;
}

function emptyInputLogin($user, $pwd)
{
    if (empty($user) || empty($pwd)) {
        $result = true;
    } else $result = false;
    return $result;
}

function loginUser($conn, $email, $pwd)
{
    $usrExists = usrExists($conn, $email);

    if ($usrExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $usrExists["user_pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wrongpass");
        exit();
    } 
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["user_email"] = $usrExists["user_email"];
        $_SESSION["user_id"] = $usrExists["user_id"];
        $_SESSION["user_lastname"] = $usrExists["user_lastname"];
        $_SESSION["user_firstname"] = $usrExists["user_firstname"];
        $_SESSION["user_phone"] = $usrExists["user_phone"];
        header("location: ../dashboard.php");
        exit();
    }
}

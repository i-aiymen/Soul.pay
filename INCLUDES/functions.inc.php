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
    $sql = "select * from registration where email = ?;";
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
    } else {
        $result = false;
        mysqli_stmt_close($stmt);
        return false;
    }
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result;
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
    $sql = "insert into registration (fname,lname,email,phone,pass) values(?,?,?,?,?);";
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

function emptyInputLogin($user, $pwd)
{
    $result;
    if (empty($user) || empty($pwd)) {
        $result = true;
    } else $result = false;
    return $result;
}

function loginUser($conn, $user, $pwd)
{
    $uidExists = uidExists($conn, $user, $user);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wrongpass");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersID"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/signup.css">
    <script src="https://kit.fontawesome.com/62d06b97ac.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include("includes/navbar.php");
    ?>

    <div class="section">
        <div class="open-account">
            <div class="open-account-text">
                <h1>Open Your Account with Soul.pay!</h1>
                <p>Get an Instant account by signing up now!</p>
            </div>
            <div class="open-account-box">
            <?php
                function showerror($message){
                    echo "<div class=\"errorbox\">";
                        echo "<i class=\"fas fa-exclamation-circle\"></i>";
                        echo "<p>".$message."</p>";
                    echo "</div>";
                }
                if(isset($_GET['error'])){
                $error=$_GET['error'];
                if($error == 'uidexists'){
                    showerror("User already Exists!");
                }
                if($error == 'pwdnomatch'){
                    showerror("The passwords don't match!");
                }
                if($error == 'pwdstrength'){
                    showerror("Please make the password more strong!");
                }
            }
            ?>
                <form action="includes/signup.inc.php" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <label for="fname">First Name
                                </label>
                                <input type="text" id="fname" name="fname" placeholder="What's your first name?" autocomplete="on" onkeypress="return /[a-z]/i.test(event.key)" required>
                            </div>
                            <div class="col-md">
                                <label for="lname">Last Name
                                </label>
                                <input type="text" id="lname" name="lname" placeholder="What's your last name?" autocomplete="on" onkeypress="return /[a-z]/i.test(event.key)" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="email">Email
                                </label>
                                <input type="email" id="email" name="email" placeholder="What's your email?" autocomplete="on" required>
                            </div>
                            <div class="col-md">
                                <label for="phone">Phone
                                </label>
                                <input type="number" id="phone" name="phone" placeholder="xxx-xxx-xxxx" autocomplete="on" onKeyPress="if(this.value.length==10) return false;" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="pass">Password
                                </label>
                                <input type="password" id="pass" name="pwd" placeholder="Pick a strong password" autocomplete="new-password" onkeydown="triggerPwdPolicy()" required>
                            </div>
                        </div>
                        <div class="row set-pwd-policy">
                            <div class="col pwd-policy">
                                    <div class="">
                                        <span class="pwd-head">Your password must contain:</span>
                                        <ul class="pwd-body">
                                            <li class="">At least 8 characters</li>
                                            <li class="">Contain at least 3 of the following:
                                                <ul class="">
                                                    <li class="">Lower case letters (a-z)</li>
                                                    <li class="">Upper case letters (A-Z)</li>
                                                    <li class="">Numbers (0-9)</li>
                                                    <li class="">Special characters (ex. !@#)</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="cpass">Confirm Password
                                </label>
                                <input type="password" id="cpass" name="pwdrepeat" placeholder="Repeat password" autocomplete="on" required>
                            </div>
                        </div>
                    </div>
                    <button class="button-primary large" name="submit" type="submit">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("includes/footer.php");
    ?>
</body>
<script src="JS/signup.js"></script>
</html>
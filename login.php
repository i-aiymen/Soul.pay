<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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
                <h1>Log into Soul.pay!</h1>
            </div>
            <div class="open-account-box maxw">
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
                if($error == 'vnone'){
                    showerror("Your Account is being verified!");
                }
                if($error == 'none'){
                    showerror("Signup Success!");
                }
                if($error == 'wrongpass'){
                    showerror("Wrong Password!");
                }
            }
            ?>
                <form action="includes/login.inc.php" method="POST">
                    <div class="container">
                        <div class="row my-4 mx-3">
                            <div class="col-md">
                                <label for="email">Email
                                </label>
                                <input type="text" id="email" name="email" placeholder="Enter your email?" autocomplete="on" required>
                            </div>
                        </div>
                        <div class="row my-4 mx-3">
                            <div class="col">
                                <label for="pass">Password
                                </label>
                                <input type="password" id="pass" name="pwd" placeholder="Enter your password" required>
                            </div>
                        </div>
                    </div>
                    <button class="button-primary large " name="submit" type="submit">
                        Log In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("includes/footer.php");
    ?>
</body>
</html>
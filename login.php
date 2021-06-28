<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soul.pay | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/signup.css">
    <link rel="shortcut icon" href="Assets/favicons/favicon-16x16.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/62d06b97ac.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include("INCLUDES/navbar.php");
    ?>

    <div class="section">
        <div class="open-account">
            <div class="open-account-text">
                <h1>Log into Soul.pay!</h1>
            </div>
            <div class="open-account-box maxw">
            <?php
                function showerror($message,$type="error"){
                    echo "<div class=\"errorbox\">";
                        if($type=="error"){
                            echo "<i class=\"fas fa-exclamation-circle\"></i>";
                        }
                        else {
                            echo "<i class=\"fas fa-check-circle\"></i>";
                        }
                        echo "<p>".$message."</p>";
                    echo "</div>";
                }
                if(isset($_GET['error'])){
                $error=$_GET['error'];
                if($error == 'wronglogin'){
                    showerror("You haven't registered!");
                }
                else if($error == 'vnone'){
                    showerror("Your Account is being verified!","success");
                }
                else if($error == 'none'){
                    showerror("Signup Success!","success");
                }
                else if($error == 'wrongpass'){
                    showerror("Wrong Password!");
                }
            }
            ?>
                <form action="INCLUDES/login.php" method="POST">
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
    include("INCLUDES/footer.php");
    ?>
</body>
</html>
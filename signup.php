<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/signup.css">
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
                <form action="signup.php">
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <label for="fname">First Name
                                </label>
                                <input type="text" id="fname" placeholder="What's your first name?" autocomplete="off">
                            </div>
                            <div class="col-md">
                                <label for="lname">Last Name
                                </label>
                                <input type="text" id="lname" placeholder="What's your last name?" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="email">Email
                                </label>
                                <input type="email" id="email" placeholder="What's your email?" autocomplete="off">
                            </div>
                            <div class="col-md">
                                <label for="phone">Phone
                                </label>
                                <input type="tel" id="phone" placeholder="xxx-xxx-xxxx" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="pass">Password
                                </label>
                                <input type="password" id="pass" placeholder="Pick a strong password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="cpass">Confirm Password
                                </label>
                                <input type="password" id="cpass" placeholder="Repeat password" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <button class="button-primary large" type="submit">
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

</html>
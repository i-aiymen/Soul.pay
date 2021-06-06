<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="css/verification.css">
</head>

<body>
    <?php
    include("includes/navbar.php");
    ?>

    <div class="section">
        <div class="verification">
            <div class="verify-text">
                <h1>Get Yourself Verified!</h1>
                <p>A few more steps and you are all set.</p>
            </div>
            <div class="carousel-nav">
                <button class="carousel_indicator current-slide"></button>
                <button class="carousel_indicator"></button>
                <button class="carousel_indicator"></button>
                <button class="carousel_indicator"></button>
            </div>
            <div class="verify-carousel">
                    <div class="carousel-container">
                        <ul class="carousel-track">
                            <li class="carousel-slide current-slide">
                                <form action="includes/signup.inc.php" method="POST">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="fname">First Name
                                                </label>
                                                <input type="text" id="fname" name="fname" placeholder="What's your first name?" autocomplete="on" required>
                                            </div>
                                            <div class="col-md">
                                                <label for="lname">Last Name
                                                </label>
                                                <input type="text" id="lname" name="lname" placeholder="What's your last name?" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="email">Email
                                                </label>
                                                <input type="email" id="email" name="email" placeholder="What's your email?" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="phone">Phone
                                                </label>
                                                <input type="tel" id="phone" name="phone" placeholder="xxx-xxx-xxxx" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="date">D.O.B.
                                                </label>
                                                <input type="date" id="date" name="dob" placeholder="xxx-xxx-xxxx" autocomplete="on" required>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li class="carousel-slide">
                                <form action="includes/signup.inc.php" method="POST">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="house">House No.
                                                </label>
                                                <input type="text" id="house" name="house" placeholder="House No.?" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="street">Street
                                                </label>
                                                <input type="text" id="street" name="street" placeholder="Street?" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="district">District
                                                </label>
                                                <input type="text" id="district" name="district" placeholder="District?" autocomplete="on" required>
                                            </div>
                                            <div class="col-md">
                                                <label for="state">State
                                                </label>
                                                <input type="text" id="state" name="state" placeholder="State" autocomplete="on" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label for="pin">Pin no.
                                                </label>
                                                <input type="number" id="pin" name="pin" placeholder="x-x-x-x-x-x" autocomplete="on" required>
                                            </div>
                                            <div class="col">
                                                <label for="nationality">Nationality
                                                </label>
                                                <input type="text" id="nationality" name="nationality" placeholder="nationality" required>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li class="carousel-slide">
                                <form action="includes/signup.inc.php" method="POST">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="aadhar">Aadhar Number
                                                </label>
                                                <input type="number" id="aadhar" name="aadhar" placeholder="What's your Aadhar number?" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="aadharf">Upload aadhar front
                                                </label>
                                                <input type="file" id="aadharf" name="aadharf">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="aadharb">Upload aadhar front
                                                </label>
                                                <input type="file" id="aadharb" name="aadharb">
                                            </div>
                                        </div>
                                </form>
                            </li>
                            <li class="carousel-slide">
                                <form action="includes/signup.inc.php"  method="POST">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="pin">Pin
                                                </label>
                                                <input type="number" id="spin" name="spin" placeholder="x-x-x-x" autocomplete="on" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="spinrepeat">Confirm Pin
                                                </label>
                                                <input type="number" id="spinrepeat" name="spinrepeat" placeholder="x-x-x-x" autocomplete="on" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="button-primary large" name="submit" type="submit">
                                        Sign Up
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("includes/footer.php");
    ?>
</body>
<script src="js/verification.js"></script>

</html>
<?php 
    session_start();
    if(!isset($_SESSION["user_email"])||!isset($_SESSION["user_id"])||!isset($_SESSION["user_lastname"])||!isset($_SESSION["user_firstname"])||!isset($_SESSION["user_phone"]))
    {
        header("location: index.php");
        exit();
    }
?>
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
    <script src="https://kit.fontawesome.com/62d06b97ac.js" crossorigin="anonymous"></script>
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
                <button id="nav-btn1" class="carousel_indicator current-slide"></button>
                <button id="nav-btn2" class="carousel_indicator"></button>
                <button id="nav-btn3" class="carousel_indicator"></button>
                <button id="nav-btn4" class="carousel_indicator"></button>
            </div>
            <div class="verify-carousel">
                <form action="includes/verification.inc.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="carousel-container">
                        <ul class="carousel-track">
                            <li class="carousel-slide current-slide">
                                <div class="slide-text">
                                    <h2>Personal Details</h2>
                                    <h6>These should match your Aadhar details.</h6>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="fname">First Name
                                            </label>
                                                <?php
                                                    echo "<input type=\"text\" id=\"fname\" name=\"fname\" placeholder=\"What's your first name?\" onkeypress=\"return /[a-z]/i.test(event.key)\" value =".$_SESSION["user_firstname"]." required>";
                                                ?>
                                        </div>
                                        <div class="col-md">
                                            <label for="lname">Last Name
                                            </label>
                                                <?php
                                                    echo "<input type=\"text\" id=\"lname\" name=\"lname\" placeholder=\"What's your last name?\" onkeypress=\"return /[a-z]/i.test(event.key)\" value =".$_SESSION["user_lastname"]." required>";
                                                 ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="email">Email
                                            </label>
                                                <?php
                                                    echo "<input type=\"email\" id=\"email\" name=\"email\" placeholder=\"What's your email?\" value=".$_SESSION["user_email"]." required>";
                                                ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="phone">Phone
                                            </label>
                                                <?php
                                                    echo "<input type=\"number\" id=\"phone\" name=\"phone\" placeholder=\"xxx-xxx-xxxx\" onKeyPress=\"if(this.value.length==10) return false;\" minlength=\"10\" value=".$_SESSION["user_phone"]." required>";
                                                ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="date">D.O.B.
                                            </label>
                                            <input type="date" id="date" name="dob" placeholder="xxx-xxx-xxxx" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button type="button" class="button-primary slide-next" name="submit">
                                        Next
                                    </button>
                                </div>
                            </li>
                            <li class="carousel-slide">
                                <div class="slide-text">
                                    <h2>Address</h2>
                                    <h6>Enter address as in Aadhar.</h6>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="house">House No.
                                            </label>
                                            <input type="text" id="house" name="house" placeholder="House No.?" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="street">Street
                                            </label>
                                            <input type="text" id="street" name="street" placeholder="Street?" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="district">District
                                            </label>
                                            <input type="text" id="district" name="district" placeholder="District?" required>
                                        </div>
                                        <div class="col-md">
                                            <label for="state">State
                                            </label>
                                            <input type="text" id="state" name="state" placeholder="State" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="pin">Pin Code
                                            </label>
                                            <input type="number" id="pin" name="pin" placeholder="x-x-x-x-x-x" onKeyPress="if(this.value.length==6) return false;" minlength="6" required>
                                        </div>
                                        <div class="col">
                                            <label for="nationality">Country
                                            </label>
                                            <input type="text" id="nationality" name="nationality" placeholder="Country" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button type="button" class="button-primary btn-small slide-prev" name="submit"> &lt;&lt; </button>
                                    <button type="button" class="button-primary btn-small slide-next" cname="submit"> &gt;&gt; </button>
                                </div>
                            </li>
                            <li class="carousel-slide">
                                <div class="slide-text">
                                    <h2>Identity proof</h2>
                                    <h6>Upload a picture of your aadhar in jpeg(front and back).</h6>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="aadhar">Aadhar Number
                                            </label>
                                            <input type="number" id="aadhar" name="aadhar" placeholder="What's your Aadhar number?" onKeyPress="if(this.value.length==12) return false;" minlength="12" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="aadharf">Upload Aadhar front image</label>
                                            <div class="file-input">
                                                <input type="file" name="aadharf" id="aadharf" class="file" required>
                                                <div class="aadhar">
                                                        <label class="aadhar-label" for="aadharf">Select file</label>
                                                        <div class="disp-file-name" id="file-upload-filename1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="aadharb">Upload Aadhar back image</label>
                                            <div class="file-input">
                                                <input type="file" name="aadharb" id="aadharb" class="file" required>
                                                    <div class="aadhar">
                                                            <label class="aadhar-label" for="aadharb">Select file</label>
                                                            <div class="disp-file-name" id="file-upload-filename2"></div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button type="button" class="button-primary btn-small slide-prev" name="submit"> &lt;&lt; </button>
                                    <button type="button" class="button-primary btn-small slide-next" name="submit"> &gt;&gt; </button>
                                </div>
                            </li>
                            <li class="carousel-slide">
                                <div class="slide-text">
                                    <h2>Setup Your Pin</h2>
                                    <h6>Setup a 4 digit pin to be used for transactions.</h6>
                                </div>
                                <div class="container">
                                    <div class="row mb-4 mx-5">
                                        <div class="col-md">
                                            <label for="pin">Pin
                                            </label>
                                            <input type="password" id="spin" name="spin" placeholder="x-x-x-x" onKeyPress="if(this.value.length==4) return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required minlength="4" autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mx-5">
                                        <div class="col-md">
                                            <label for="spinrepeat">Confirm Pin <span id="pinerror"></span>
                                            </label>
                                            <input type="password" id="spinrepeat" name="spinrepeat" placeholder="x-x-x-x" onKeyPress="if(this.value.length==4) return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required minlength="4">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="buttons">
                                            <button id="finalsubmit"class="button-primary large" name="submit" type="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons mr-auto ml-4">
                                    <button type="button" class="button-primary btn-small slide-prev" name="submit"> &lt;&lt; </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
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
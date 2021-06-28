<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/credit.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="Assets/favicons/favicon-16x16.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Manrope' rel='stylesheet'>
    <title>Soul.pay | Home</title>
</head>
<body>
    <div class="page-wrapper">
        <?php
        include 'INCLUDES/navbar.php';
        ?>

        <div class="row g-0">
            <div class="col-lg-6 g-0">
                <div class="leftside">
                    <div class="moto" style="padding-top:150px;">
                        <div class="container-hero-left">
                            <div class="sufix-line" style="opacity: 1;"></div>
                            <h1>Soul<span class="span-primary-color">.</span>pay</h1>
                            <p class="paragraph-large">
                            All your banking needs, fulfilled with soul.
                            </p>
                            <div class="_2-buttons-wrapper" style="opacity: 1;">
                            <a href="signup.php" class="button-primary large w-button">Open account</a>
                            <div class="spacer hero-buttons">

                            </div>
                            <a href="login.php" class="button-secondary vv large w-button" style="padding-left: 75px; padding-right: 75px;">Login</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 g-0">
                <div class="rightside">
                    <img src="Assets/images/photo1.jpg" alt="" class="main_img">
                </div>
            </div>     
        </div>

    </div>
        <?php
                include 'INCLUDES/footer.php';
        ?>
</div>
</body>
</html>
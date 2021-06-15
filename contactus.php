<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT FAMILY-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <title>Contact Us--Soul.pay</title>
    <link rel="stylesheet" href="CSS/contactus.css">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php include 'INCLUDES/navbar.php';?>
<!--main part-->
<div class="main">
<div class="a">
    <div style="opacity: 1;" class="sufix-line"></div>
     <h2 style="opacity: 1;" class="head">Get in touch with us<span class="span-primary-color">.</span></h2><p style="opacity: 1;" class="left-paragraph">Want to get in touch? We'd love to hear from you.<br>Here's how you can reach us...</p><br>
     <div class="contact-us-wrapper">
        <div style="opacity: 1;" class="contact-wrapper"><div class="contact-us-subtitle-wrapper"><img src="https://assets.website-files.com/5ea6ed9e484d220156b1c38d/5ea7809af2769e57aa63a66f_icon-contact-us-01-banca-template.svg" alt="" class="contact-us-icon"><div class="contact-us-subtitle">Office</div></div><p>1550 Bryant Street STE 750, San Francisco, CA 94103</p></div><div style="opacity: 1;" class="contact-wrapper"><div class="contact-us-subtitle-wrapper"><img src="https://assets.website-files.com/5ea6ed9e484d220156b1c38d/5ea7809a6f8dd21f3b5fd77d_icon-contact-us-02-banca-template.svg" alt="" class="contact-us-icon"><div class="contact-us-subtitle">Contact</div></div><a href="mailto:support@banca.com" class="contact-us-link">support@soul.pay.com</a><a href="mailto:info@soul.pay.com" class="contact-us-link">info@soul.pay.com</a></div><div  style="opacity: 1;" class="contact-wrapper"><div class="contact-us-subtitle-wrapper"><img src="https://assets.website-files.com/5ea6ed9e484d220156b1c38d/5ea7809a3d52efaf6a491924_icon-contact-us-03-banca-template.svg" alt="" class="contact-us-icon"><div class="contact-us-subtitle">Open Hours</div></div><p class="open-hours-paragraph">Monday - Saturday: 9am - 7pm</p><p class="open-hours-paragraph">Sunday: 12am — 6pm</p></div></div>

</div>
<div class="b">
    <div class="x">
    <div style="opacity: 1; transform-style: preserve-3d;" class="contact-us-form">
        <div class="success-message-content w-form">
            <form action="contact_get.php" method="POST" id="email-form" name="email-form" data-name="Email Form" class="form-v2">
                <div class="contact-us-form-grid">
                    <div class="form-input-wrapper">
                        <label for="Name" class="field-label">Name</label>
                        <input type="text" class="input w-input"name="Name"placeholder="What's your name?" id="Name" required="">
                    </div>
                    <div class="form-input-wrapper">
                        <label for="Phone" class="field-label">Phone</label>
                        <input type="tel" class="input w-input"name="Phone" placeholder="(123) 480 - 3540" id="Phone">
                    </div>
                    <div class="form-input-wrapper">
                        <label for="Email" class="field-label">Email</label>
                        <input type="email" class="input w-input" name="Email" placeholder="What's your email?" id="Email" required="">
                    </div>
                    <div class="form-input-wrapper">
                        <label for="Related-To" class="field-label">Service interested in</label>
                        <input type="text" class="input w-input" maxlength="256" name="Services" data-name="Services" placeholder="Ex. Auto Loan,recharge" id="Services" required="">
                    </div>
                </div>
                <label for="Message" class="field-label">Message</label>
                <textarea placeholder="I would like to get in touch with you..." maxlength="5000" id="Message" name="Message" data-name="Message" class="text-area w-input"></textarea>
                
                <input type="submit" name="contact" value="Send Message" data-wait="Please wait..." class="button">
            </form>
        
        <div class="success-message-content w-form-done"><img src="https://assets.website-files.com/5ea6ed9e484d220156b1c38d/5eab1fb459d0129081511bc1_icon-steps-02-banca-template.svg" alt=""><div class="success-message-text">Thank you! Your submission has been received!</div></div><div class="error-message-content w-form-fail"><div class="error-message-text">Oops! Something went wrong while submitting the form.</div></div></div></div>

    </div>
    <div class="y"></div></div>
    </div>
    </div>
    <?php 
            include 'contact_get.php';
            include 'INCLUDES/footer.php';?>
</body>
</html>
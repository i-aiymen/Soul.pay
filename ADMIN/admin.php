<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" href="http://localhost/mini_project_s4/Assets/favicons/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="http://localhost/mini_project_s4/CSS/admin_login.css" />
    <title>Soul.pay | Admin</title>
  </head>
  <body>
  <form action="" method="post">
      <div class="login-div">
          <div class="logo"></div>
              <div class="fields">
                  <div class="password">
                    <svg fill="#999" viewBox="0 0 1024 1024"><path class="path1" d="M742.4 409.6h-25.6v-76.8c0-127.043-103.357-230.4-230.4-230.4s-230.4 103.357-230.4 230.4v76.8h-25.6c-42.347 0-76.8 34.453-76.8 76.8v409.6c0 42.347 34.453 76.8 76.8 76.8h512c42.347 0 76.8-34.453 76.8-76.8v-409.6c0-42.347-34.453-76.8-76.8-76.8zM307.2 332.8c0-98.811 80.389-179.2 179.2-179.2s179.2 80.389 179.2 179.2v76.8h-358.4v-76.8zM768 896c0 14.115-11.485 25.6-25.6 25.6h-512c-14.115 0-25.6-11.485-25.6-25.6v-409.6c0-14.115 11.485-25.6 25.6-25.6h512c14.115 0 25.6 11.485 25.6 25.6v409.6z"></path></svg>
                    <input type="password" class="pass-input" placeholder="password" name="password" />
                  </div>
                  <button class="signin-button" name="submit">Login</button>
              </div>
          </div>
    </form>
  </body>
</html>

<?php

  if(isset($_POST['submit']))
  {
      $pass="soulbank";
      $password=$_POST['password'];
      if($password==$pass)
      {
          $_SESSION['login']="soulbank";
      ?>
      <script>
          window.location.href="user.php";
      </script>
      <?php
      }
      else
      {
          echo '<script type="text/javascript">alert("Log in control panel error");
          </script>';
      }
  }
  
?>

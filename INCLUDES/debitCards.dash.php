<?php
  session_start();
  require_once($_SERVER['DOCUMENT_ROOT']."/mini_project_s4/DBCONFIG/dbconfig.php");

    if (class_exists('DATABASE_CONNECT'))
    {

        $obj_conn  = new DATABASE_CONNECT;
        
        $host = $obj_conn->connect[0];
        $user = $obj_conn->connect[1];
        $pass = $obj_conn->connect[2];
        $db   = $obj_conn->connect[3];


        $conn = new mysqli($host,$user,$pass,$db);
        
        if ($conn->connect_error)
        {
            die ("Cannot connect " .$conn->connect_error);
        }
        else 
        {
  $sql = "select user_firstname, user_lastname from users where user_id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $_SESSION["user_id"]);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

  echo "<div class=\"home-content\" id=\"home-content\">
    <div class=\"profile\">
      <div class=\"profile personal\">
        <div class=\"section-title\">
          <div class=\"title-text\">Debit Cards</div>
        </div>
        <i class=\"fas fa-credit-card\" id=\"cr-card-logo\"></i>
        <div class=\"display-cards\">
          Current Active Cards:
          <div class=\"card\">
            <div class=\"card__front card__part\">
              <i class=\"fas fa-sim-card fa-rotate-270\"></i>
              <img class=\"card__front-logo card__logo\" src=\"Assets/images/visa-seeklogo.com.svg\">
              <p class=\"card_numer\">**** **** **** 6258</p>
              <div class=\"card__space-75\">
                <span class=\"card__label\">Card holder</span>
                <p class=\"card__info\">".$row["user_firstname"]." ".$row["user_lastname"]."</p>
              </div>
              <div class=\"card__space-25\">
                <span class=\"card__label\">Expires</span>
                <p class=\"card__info\">10/25</p>
              </div>
            </div>

            <div class=\"card__back card__part\">
              <div class=\"card__black-line\"></div>
              <div class=\"card__back-content\">
                <div class=\"card__secret\">
                  <p class=\"card__secret--last\">420</p>
                </div>
                <img class=\"card__back-square card__square\" src=\"Assets/images/PureSoul.svg\">
                <img class=\"card__back-logo card__logo\" src=\"Assets/images/visa-seeklogo.com.svg\">

              </div>
            </div>
          </div>
        </div>
        <a href=\"#\" id=\"apply-debit\" onclick=\"toggle2();\">
          <span class=\"nav__text\">Apply For New</span>
        </a>
      </div>
    </div>
  </div>";
        }
      }
?>
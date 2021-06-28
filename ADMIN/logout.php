<?php session_start();
if(empty($_SESSION['login'])):
header('Location: admin.php');
endif;
?>
<!DOCTYPE html>
  
<html>


<head>
  <link rel="shortcut icon" href="http://localhost/Soulbank/Assets/favicons/favicon-16x16.png" type="image/x-icon">
  <title>Soul.pay | Logout</title>
  <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    html,body{
      display: grid;
      height: 100%;
      text-align: center;
      place-items: center;
      background: #ecf0f3;
    }
    .circular{
      height: 100px;
      width: 100px;
      position: relative;
    }
    .circular .inner, .circular .outer, .circular .circle{
      position: absolute;
      z-index: 6;
      height: 100%;
      width: 100%;
      border-radius: 100%;
      box-shadow: inset 0 1px 0 rgba(0,0,0,0.2);
    }
    .circular .inner{
      top: 50%;
      left: 50%;
      height: 80px;
      width: 80px;
      margin: -40px 0 0 -40px;
      background-color: #ecf0f3;
      border-radius: 100%;
      box-shadow: 0 1px 0 rgba(0,0,0,0.2);
    }
    .circular .circle{
      z-index: 1;
      box-shadow: none;
    }
    .circular .numb{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 10;
      font-size: 18px;
      font-weight: 500;
      color: #dd4859;
    }
    .circular .bar{
      position: absolute;
      height: 100%;
      width: 100%;
      background: #fff;
      -webkit-border-radius: 100%;
      clip: rect(0px, 100px, 100px, 50px);
    }
    .circle .bar .progress{
      position: absolute;
      height: 100%;
      width: 100%;
      -webkit-border-radius: 100%;
      clip: rect(0px, 50px, 100px, 0px);
    }
    .circle .bar .progress, .dot span{
      background: #dd4859;
    }
    .circle .left .progress{
      z-index: 1;
      animation: left 4s linear both;
    }


    @keyframes left {
      100%{
        transform: rotate(180deg);
      }
    }
    .circle .right{
      z-index: 3;
      transform: rotate(180deg);
    }
    .circle .right .progress{
      animation: right 4s linear both;
      animation-delay: 4s;
    }
    @keyframes right {
      100%{
        transform: rotate(180deg);
      }
    }
    .circle .dot{
      z-index: 2;
      position: absolute;
      left: 50%;
      top: 50%;
      width: 50%;
      height: 10px;
      margin-top: -5px;
      animation: dot 8s linear both;
      transform-origin: 0% 50%;
    }
    .circle .dot span {
      position: absolute;
      right: 0;
      width: 10px;
      height: 10px;
      border-radius: 100%;
    }
    @keyframes dot{
      0% {
        transform: rotate(-90deg);
      }
      50% {
        transform: rotate(90deg);
        z-index: 4;
      }
      100% {
        transform: rotate(270deg);
        z-index: 4;
      }
    }
  </style>
</head>
<body>
<div style="width:150px;margin:auto;height:500px;margin-top:300px">
<?php
	session_destroy();
	
 echo '<meta http-equiv="refresh" content="3;url=http://localhost/Soulbank/index.php">';
 echo'<div class="circular">
 <div class="inner"></div>
 <div class="outer"></div>
 <div class="numb">
	0%
 </div>
 <div class="circle">
	<div class="dot">
	   <span></span>
	</div>
	<div class="bar left">
	   <div class="progress"></div>
	</div>
	<div class="bar right">
	   <div class="progress"></div>
	</div>
 </div>
</div>
<script>
            const numb = document.querySelector(".numb");
            let counter = 0;
            setInterval(()=>{
              if(counter == 100){
                clearInterval();
              }else{
                counter+=2;
                numb.textContent = counter + "%";
              }
            }, 100);
         </script>
<br>';
?>
</div>
</body>
</html>

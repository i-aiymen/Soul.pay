<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soul.pay | Atm/Branches</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="Assets/favicons/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/atmbranch.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
        include("INCLUDES/navbar.php");
        require_once('DBCONFIG/dbconfig.php');

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
        ?>
    <div class="jumbotron">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-5">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                aria-controls="nav-home" aria-selected="true">Branches</a>
                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                aria-controls="nav-profile" aria-selected="false">ATM's</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="card text-center">
                                <div class="card-body ">
                                    <h5 class="card-title">Find Nearest Branch</h5>
                                    <p class="card-text">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="width: 5rem;"
                                                for="State">State</label>
                                        </div>
                                        <select class="custom-select" id="State" name="State"
                                            onchange="showDistricts(this.value,'StateBranch')">
                                            <option selected>Choose...</option>

                                            <?php
                                                $sql="select distinct State from branches ORDER BY State;";
                                                $result=mysqli_query($conn,$sql);
                                                $resultCheck = mysqli_num_rows($result);
    
                                                if($resultCheck>0){
                                                    while($row=mysqli_fetch_assoc($result)){
                                                        echo "<option value='".$row['State']."'>".$row['State']."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="width: 5rem;"
                                                for="District">District</label>
                                        </div>
                                        <select class="custom-select" id="District">
                                            <option selected>Choose State first</option>
                                        </select>
                                    </div>
                                    </p>
                                    <a href="#" class="btn btn-primary" onclick="displayBranches();">Locate</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="card text-center">
                                <div class="card-body ">
                                    <h5 class="card-title">Find Nearest Atm</h5>
                                    <p class="card-text">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="width: 5rem;"
                                                for="State">State</label>
                                        </div>
                                        <select class="custom-select" id="StateAtm" name="State"
                                            onchange="showDistricts(this.value,'StateAtm')">
                                            <option selected>Choose...</option>

                                            <?php
                                                $sql="select distinct State from atms ORDER BY State;";
                                                $result=mysqli_query($conn,$sql);
                                                $resultCheck = mysqli_num_rows($result);

                                                if($resultCheck>0){
                                                    while($row=mysqli_fetch_assoc($result)){
                                                        echo "<option value='".$row['State']."'>".$row['State']."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="width: 5rem;"
                                                for="District">District</label>
                                        </div>
                                        <select class="custom-select" id="District2">
                                            <option selected>Choose State first</option>
                                        </select>
                                    </div>
                                    </p>
                                    <a href="#" class="btn btn-primary" onclick="displayAtms();">Locate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrappe" style="padding: 0em 1em; margin-top: 2em; margin-bottom: 3em;">
        <div class="row row-cols-1 row-cols-md-3" id="displaybranchesnAtms">
        </div>
    </div>


    <?php  
        }  
    }
    include("INCLUDES/footer.php");
?>
    <script type="text/javascript">
        function showDistricts(state, name) {
            const ajaxreq = new XMLHttpRequest();
            ajaxreq.open('GET', "http://localhost/mini_project_s4/INCLUDES/sendDistricts.php?selectvalue=" + state +"&type="+name, 'true');
            ajaxreq.send();
            ajaxreq.onreadystatechange = function () {
                if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
                    if (name == 'StateBranch')
                        document.getElementById("District").innerHTML = ajaxreq.responseText;

                    else
                        document.getElementById("District2").innerHTML = ajaxreq.responseText;

                }
            };
        }

        function displayBranches() {
            event.preventDefault();
            const ajaxreq = new XMLHttpRequest();
            district = document.getElementById("District").value;
            // document.getElementById("displaybranchesnAtms").innerHTML = district;
            ajaxreq.open('GET', "http://localhost/mini_project_s4/INCLUDES/displayBranches.php?district=" + district, 'true');
            ajaxreq.send();
            ajaxreq.onreadystatechange = function () {
                if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
                    document.getElementById("displaybranchesnAtms").innerHTML = ajaxreq.responseText;
                }
            };
        }

        function displayAtms() {
            event.preventDefault();
            const ajaxreq = new XMLHttpRequest();
            district = document.getElementById("District2").value;
            ajaxreq.open('GET', "http://localhost/mini_project_s4/INCLUDES/displayAtms.php?district=" + district, 'true');
            ajaxreq.send();
            ajaxreq.onreadystatechange = function () {
                if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
                    document.getElementById("displaybranchesnAtms").innerHTML = ajaxreq.responseText;
                }
            };
        }
    </script>
</body>

</html>
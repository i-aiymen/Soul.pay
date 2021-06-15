<?php
        if (isset($_POST['contact'])) 
        {
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
                $name     = $_POST['Name'];
                $phone    = $_POST['Phone'];
                $email    = $_POST['Email'];
                $services = $_POST['Services'];
                $message  = $_POST['Message'];

                $sql = "insert into contactform
                        (Name, Phone, Email, Service, Message)
                        values('$name', '$phone', '$email', '$services', '$message')";
                $result = $conn->query($sql);

                if ($result == true)
                {
                    echo '<script type="text/javascript">alert("Your message has been submitted!.");
                            </script>';
                    echo ("<script>location.href='index.php'</script>");
                    exit;
                }
                else
                {
                    echo '<script type="text/javascript">alert("Your message is not submitted!");
                            </script>';
                    echo ("<script>location.href='index.php'</script>");
                    exit;
                }
            }
        }
    }

?>
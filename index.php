<?php 
//session_start(); 
//
require('server.php');
$Username = $_SESSION['Username'];
//
if (!isset($_SESSION['Username'])) {
    $_SESSION['msg'] = "You must login first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("location: login.php");
}

//

//

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">

        <head>
            <title>Testing regisstration PHP and MySQL</title>
            <link rel="stylesheet" type="text/css" href="style.css">

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                body {
                    margin: 0;
                    font-family: Arial, Helvetica, sans-serif;
                    background-color: #f2f2f2;
                }

                .topnav {
                    overflow: hidden;
                    background-color: #b70006;
                    border: 0.5px solid #7c6f6f;
                }

                .topnav a {
                    float: left;
                    color: #f2f2f2;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                    font-size: 17px;

                }

                .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                }

                .topnav a.active {
                    background-color: #b70006;
                    color: white;
                }
                footer {
                    position: fixed;
                    left: 0;
                    bottom: 0;
                    right: 0;
                    background-color: #b70006;
                    color: #b70006;
                    text-align: center;
                  border: 0.5px solid #7c6f6f;

                }
            </style>
        </head>
        <body>
            <div class="topnav">
                <a class="active" href="#home">Home</a>
                <a href="php">Login</a>
                <a href="register.php">Register</a>
            </div>


            <div class="header">
                <h2>Home Page</h2>
            </div>
            <div class="content">

                <!-- notification message -->
                <?php if (isset($_SESSION['success'])) : ?>
                <div class="error success" >
                    <h3>
                        <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
                <?php endif ?>

                <!-- logged in user information -->
                <?php  if (isset($_SESSION['Username'])) : ?>
                <h3>Welcome <br>Username:<strong><?php echo $_SESSION['Username']; ?></strong></h3><br>
                <!--                -->
                 <h3>Your Profile</h3><hr>
                
                <?php
               
                $q = "SELECT Name, Username, Email, Phone, Role FROM GENERAL_USER WHERE Username='".$_SESSION["Username"]."'";
                $r = mysqli_query($db,$q);
                $a = mysqli_fetch_assoc($r);
                echo "<br>"." Name: ".$a["Name"]."<br><br>";
                echo "Username:".$a["Username"]."<br><br>";
                echo "Email:".$a["Email"]."<br><br>";
                echo "Role:".$a["Role"]."<br><br>";
                ?>


                <!--                -->




                <br><br>
                <p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
                <?php endif ?>

               
              

           

            </div>

        </body>
    <footer>footer</footer>
</html>
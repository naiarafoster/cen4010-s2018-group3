<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118579996-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118579996-1');
</script>
        <title>Registration system PHP and MySQL</title>
        <link rel="stylesheet" type="text/css" href="style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body  {
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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
 
        </div>

        <div class="header">
            <h2>Login</h2>
        </div>

        <form method="post" action="login.php">

            <?php include('errors.php'); ?>

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="Username" >
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="Password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="login_user">Login</button>
            </div>
            <p>
               Not yet a member? <a href="register.php">Sign up</a>                
            </p>

        </form>
    </body>
    <footer>footer</footer>
</html>

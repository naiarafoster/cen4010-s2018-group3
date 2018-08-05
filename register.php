<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    
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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

        <div class="input-group">
			
            <label>Name</label>
             
            <input type="text" name="Name" value="<?php if(!empty($Name)) echo $Name; ?>">
            
        </div>
        
        <div class="input-group">
			<label>Username </label>
			<input type="text" name="Username" value="<?php if(!empty($Username)) echo $Username; ?>">
		</div>
        
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="Email" value="<?php echo $Email; ?>">
		</div>
        
         <div class="input-group">
			<label>Phone </label>
			<input type="text" name="Phone" value="<?php if(!empty($Phone)) echo $Phone; ?>">
		</div>
          <div class="input-group">
			<label>Role </label>
			<input type="text" name="Role" value="<?php if(!empty($Role)) echo $Role; ?>">
		</div>
        
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="Password_1">
		</div>
        
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="Password_2">
		</div>
        
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
    <footer>footer</footer>
</html>




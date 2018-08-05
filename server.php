<?php 
	session_start();

	// variable declaration
	$Username = "";
	$Email    = "";
    //
    $Name = "";
    //
	$errors = array(); 
	$_SESSION['success'] = "";
    //
    
    //

$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);
$db = mysqli_connect('localhost', 'cen4010sum18_g03', '2YmdtKtt9a', 'cen4010sum18_g03');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$Name = mysqli_real_escape_string($db, $_POST['Name']);
        $Username = mysqli_real_escape_string($db, $_POST['Username']);
		$Email = mysqli_real_escape_string($db, $_POST['Email']);
		$Role = mysqli_real_escape_string($db, $_POST['Role']);  //not sure
		$Phone = mysqli_real_escape_string($db, $_POST['Phone']);  //not sure

		$Password_1 = mysqli_real_escape_string($db, $_POST['Password_1']);
		$Password_2 = mysqli_real_escape_string($db, $_POST['Password_2']);

		// form validation: ensure that the form is correctly filled
        if (empty($Name)) { array_push($errors, "Name is required"); }
		if (empty($Username)) { array_push($errors, "Username is required"); }
		if (empty($Email)) { array_push($errors, "Email is required"); }
		if (empty($Phone)) { array_push($errors, "Phone number is required"); }		
		if (empty($Password_1)) { array_push($errors, "Password is required"); }

		if ($Password_1 != $Password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
//			$password = md5($password_1);//encrypt the password before saving in the database
            $Password = $Password_1;
            
			$query = "INSERT INTO GENERAL_USER	(Name, Username, Password, Email, Phone, Role ) 
					  VALUES('$Name', '$Username','$Password', '$Email', '$Phone', '$Role')";
			mysqli_query($db, $query);

			$_SESSION['Username'] = $Username;
            
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$Username = mysqli_real_escape_string($db, $_POST['Username']);
		$Password = mysqli_real_escape_string($db, $_POST['Password']);

		if (empty($Username)) {
			array_push($errors, "Username is required");
		}
		if (empty($Password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
            $Password = $Password;
			$query = "SELECT * FROM GENERAL_USER WHERE Username='$Username' AND Password='$Password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['Username'] = $Username;
                //
                
                
                //
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>
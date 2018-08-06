<?php
	require_once 'php/db-connect.php';
	require_once 'php/functions.php';

	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['role'])){
		echo "here";
		$role = $_GET['role'];
		ob_clean();
		echo json_encode(getUsersByRoles($db, $role));
		return;
	}


	//Create or Edit Post
	if(isset($_POST["Post"]) && isset($_POST['Title']) && isset($_POST['Content']) && isset($_POST['EventProblem']) && isset($_POST['Location'])){

	    $userID = 13;//$_SESSION['UserId'];
	    $title = $_POST['Title'];
	    $text = $_POST['Content'];
	    $problemStatus = "Waiting";
	    $time = $_SERVER['REQUEST_TIME'];
	    $location = $_POST['Location'];
	    $eventProblem = $_POST['EventProblem'];
	    $file_name = NULL;
	    if(isset($_POST["PostID"])){
	    	$postId = $_POST["PostID"];
	    }

	    if ($_FILES)
	    {
	    	//print_r($_FILES);
	    	$file_name = $time . '.jpg';
	        $tmp_name = $_FILES['Upload']['name'];
	        $dstFolder = 'images';
	        move_uploaded_file($_FILES['Upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
	    }

	    if(isset($_POST["PostID"])){
	    	SaveEditPostToDB($db, $userID, $title, $text, $time, $file_name, $location, $eventProblem, $postId);
	    }else{
	    	SavePostToDB($db, $userID, $title, $text, $time, $file_name, $location, $eventProblem);
	    }
	    //ob_clean();
		echo json_encode(true);
		return;
	    //header("Refresh:0; url=wall.php");

	}

	//Post Comment
	if(isset($_POST["Comment"]) && isset($_POST["PostID"])){
		$userID = 13;//$_SESSION['UserID'];
		$postID = $_POST["PostID"];
		$time = $_SERVER['REQUEST_TIME'];
		$comment = $_POST["Comment"];
	    PostComment($db, $userID, $postID, $time, $comment);
	    ob_clean();
		echo json_encode(true);
		return;
	}
	//Change Problem Status
	$_SESSION['IsAdmin'] = true;
	if(isset($_POST["ChangeProblemStatus"]) && $_SESSION['IsAdmin'] == true){
		$problemStatus = $_POST['ChangeProblemStatus'];
		$postID = $_POST['PostID'];
		$adminID = $_SESSION['AdminID'];
		$time = $_SERVER['REQUEST_TIME'];
		ChangeProblemStatus($db, $adminID, $postID, $time, $problemStatus);
		ob_clean();
		echo json_encode(true);
		return;
	}

	//Get Problems
	if(isset($_GET["GetProblems"]) && $_SESSION['IsAdmin'] == true){
		$problemType = $_GET["GetProblems"];
		ob_clean();
		echo json_encode(GetProblems($db, $problemType));
		return;
	}

	//Get Problems
	if(isset($_GET["GetProblemsByUserID"])){
		$userID = $_GET["GetProblemsByUserID"];
		ob_clean();
		echo json_encode(GetProblemsByUserID($db, $userID));
		return;
	}

	//Get Posts by userid
	//Get Problems
	if(isset($_GET["GetPostsByUserID"])){
		$userID = $_GET["GetPostsByUserID"];
		ob_clean();
		echo json_encode(GetPostsByUserID($db, $userID));
		return;
	}


?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<style type="text/css">
	#title, #content{
		width:100%;
		margin-bottom: 5px;
	}
</style>
<body style="text-align: center;">
	<h2>Find All Users or Admin on Campus Snapshots</h2>

	<div style="text-align: center;">
		<select id="role-select" style="height: 30px;">
			<option value="Admin">Admin</option>
			<option value="User">User</option>
		</select>
		<button onclick="send()" style="width:70px; height: 30px; border-radius: 3px; background: blue; border:none; color:white;">Send</button>
	</div>

	<div style="width:500px; margin: auto;">
		<h4></h4>
		<div class="output">
			<div></div>
		</div>
	</div>

	<form action="api.php" method="Post" enctype="multipart/form-data">
		<div style="width:500px; margin:auto;">
			<input id="title" name="Title" type="text" placeholder="Title">
			<textarea id="content" name="Content" placeholder="Content"></textarea>
			<select name="EventProblem" style="display: block; float: left; width:100%;">
				<option value="Event">Event</option>
				<option value="Problem">Problem</option>
			</select>
			<input type="file" name="Upload" accept="image/*" style="display: block; float: left; width:100%;">
			<input type="submit" name="Post" style="display: block; float: right; width:100%;">
		</div>
	</form>

	<div style="display:block; width:100%; float:left; margin:20px auto;">
		<input type="text" id="comment" name="comment" placeholder="Comment">
		<button id="post-comment" onclick="postComment()">Post</button>
	</div>

	<div style="display:block; width:100%; float:left; margin:20px auto;">
		<select id="problemStatus">
			<option value="Waiting">Waiting</option>
			<option value="Under Supervison">Under Supervison</option>
			<option value="Completed">Completed</option>
			<option value="Escalated">Escalated</option>
		</select>
		<button id="post-comment" onclick="changeProblemStatus()">Post</button>
	</div>

	<script>
		function send(){
			var output = "";
			var result = $.ajax({
	             type: "GET",
	             url: 'http://lamp.cse.fau.edu/~pabraham2015/cen-4010/index.php',
	             data:{"role": document.getElementById("role-select").value}
	           });
	           result.done(function(done){
	             done = JSON.parse(done);
	             $("h4").html("Displaying all "+document.getElementById("role-select").value);
	             for(var i =0; i < done.length; i++){
	             	output += "<div style='padding:10px 0px;'>"+done[i].UserName + " - " + done[i].Email + "<br/></div>";
	             }
	             $(".output div").html(output);

	           });
		}

		function postComment(){
			var text = $("#comment").val();
			var output = "";
			var result = $.ajax({
	             type: "POST",
	             url: 'http://lamp.cse.fau.edu/~pabraham2015/cen-4010/index.php',
	             data:{"Comment":text, "PostID": 1}
	           });
	           result.done(function(done){
	           	console.log("Commented");
	           });

		}

		function changeProblemStatus(){
			var text = $("#problemStatus").val();
			var output = "";
			var result = $.ajax({
	             type: "POST",
	             url: 'http://lamp.cse.fau.edu/~pabraham2015/cen-4010/index.php',
	             data:{"ChangeProblemStatus":text, "PostID": 1}
	           });
	           result.done(function(done){
	           	console.log("Commented");
	           });
		}
	</script>
</body>
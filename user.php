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
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
	</script>
</body>
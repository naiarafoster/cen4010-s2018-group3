<?php 

function getPostcards($_db, $_username)
{
    $username = sanitizeString($_db, $_username);
    $query = "SELECT USER_USERNAME, STATUS_TITLE, STATUS_TEXT, WALL.TIME_STAMP, IMAGE_NAME, FILTERS, COUNT(userLikes.TIME_STAMP) AS Likes, CASE WHEN userLikes.username = '$username' THEN 1 ELSE 0 END AS AlreadyLiked, CASE WHEN WALL.USER_USERNAME = '$username' THEN 1 ELSE 0 END AS IsMyPost FROM WALL LEFT JOIN User_Likes as userLikes ON userLikes.TIME_STAMP = WALL.TIME_STAMP WHERE REPORTS < 5 GROUP BY WALL.TIME_STAMP ORDER BY TIME_STAMP DESC";

    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }

    $output = '';
    while($row = $result->fetch_assoc())
    {
        if($row['AlreadyLiked'] == 1){
          $likeButton = '<a onclick="rate(this,0)"> Liked</a>';
        }else{
          $likeButton = '<a onclick="rate(this,1)"> Like</a>';
        }
        if($row['IsMyPost'] == 0){
          $deleteButton = '<li class="report-btn">Report</li>';
        }else{
          $deleteButton = '<li class="delete-btn">Delete</li>';
        }
        $output = $output . '<div class="panel panel-default"><div class="panel-heading">' .$row['USER_USERNAME']
        . '</div><div class="settings"><i class="fa fa-cog" aria-hidden="true"></i><ul><li class="edit-btn">Edit</li>'.$deleteButton.'</ul></div><div class="body"><img class="'.$row['FILTERS'].'" src="' . 'images/' . $row['IMAGE_NAME'] . '" width="300px"><div class="edit-container"><label>Filter Photo: </label> <select class="" name="filter" onchange="applyEditFilter(this)"> <option value="" '.($row['FILTERS'] == "" ? "selected" :"").'>Original</option> <option value="myNostalgia" '.($row['FILTERS'] == "myNostalgia" ? "selected" :"").'>My Nostalgia</option> <option value="grayscale" '.($row['FILTERS'] == "grayscale" ? "selected" :"").' >Grayscale</option> <option value="xpro2" '.($row['FILTERS'] == "xpro2" ? "selected" :"").'>XPro2</option> <option value="willow" '.($row['FILTERS'] == "willow" ? "selected" :"").'>Willow</option> <option value="f1977" '.($row['FILTERS'] == "f1977" ? "selected" :"").'>1977</option> </select><button class="save-edit-btn" onclick="saveEditFilter(this, '.$row['TIME_STAMP'].')">Save</button><button class="cancel-edit-btn" onclick="cancelEditFilter('.$row['TIME_STAMP'].')">Cancel</button></div><div class="like-container">'.$row['Likes'].$likeButton.'</a></div><div class="title">'. $row['STATUS_TITLE'].'</div><div class="description">"' . $row['STATUS_TEXT'] . '"</div></div></div><br />' ;
    }

    return $output;
}

function getUsersByRoles($_db, $_role){

	$query = "SELECT * FROM `GENERAL_USER` WHERE ROLE = '$_role'";

	if(!$result = $_db->query($query)){
		die("Error in the query.");
	}
	$output = [];

	while($row = $result->fetch_assoc()){
		array_push($output, $row);
	}

	return $output;

}

    function SavePostToDB($_db, $_user, $_title, $_text, $_time, $_file_name, $_location, $_eventProblem)
    {
        // if($_file_name == NULL){
        //     /* Prepared statement, stage 1: prepare query */
        //     if (!($stmt = $_db->prepare("INSERT INTO POSTS(UserID, Title, Content, TimeStamp, Location, EventProblem) VALUES (?, ?, ?, ?, ?,?)")))
        //     {
        //         echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
        //     }

        //     /* Prepared statement, stage 2: bind parameters*/
        //     if (!$stmt->bind_param('ississ', $_user, $_title, $_text, $_time, $_location, $_eventProblem))
        //     {
        //         echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        //     }

        //     /* Prepared statement, stage 3: execute*/
        //     if (!$stmt->execute())
        //     {
        //         echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        //     }
        // }else{
        //     /* Prepared statement, stage 1: prepare query */
        //     if (!($stmt = $_db->prepare("INSERT INTO POSTS(UserID, Title, Content, TimeStamp, FileName, Location, EventProblem) VALUES (?, ?, ?, ?, ?, ?,?)")))
        //     {
        //         echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
        //     }

        //     /* Prepared statement, stage 2: bind parameters*/
        //     if (!$stmt->bind_param('ississs', $_user, $_title, $_text, $_time, $_file_name, $_location, $_eventProblem))
        //     {
        //         echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        //     }

        //     /* Prepared statement, stage 3: execute*/
        //     if (!$stmt->execute())
        //     {
        //         echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        //     }
        // }

        if($_file_name != NULL){
            $sql = "INSERT INTO POSTS(UserID, Title, Content, TimeStamp, FileName, Location, EventProblem) VALUES ('$_user', '$_title', '$_text', '$_time', '$_file_name', '$_location','$_eventProblem')";

            if ($_db->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>";
            }
        }else{
            $sql = "INSERT INTO POSTS(UserID, Title, Content, TimeStamp, Location, EventProblem) VALUES ('$_user', '$_title', '$_text', '$_time', '$_location','$_eventProblem')";

            if ($_db->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>";
            }
        }

        if($_eventProblem == "Problem"){
            //Create Problem Status
            ChangeProblemStatus($_db, $_user, $stmt->insert_id, $_time, "Waiting");
        }
    }

    function SaveEditPostToDB($_db, $_user, $_title, $_text, $_time, $_file_name, $_location, $_eventProblem, $_postID)
    {

        $check = "SELECT * FROM POSTS WHERE `ID` = $_postID";
        $result = $_db->query($check);
        if ($result->num_rows > 0) {
            /* Prepared statement, stage 1: prepare query */
            if (!($stmt = $_db->prepare("UPDATE POSTS SET Title = ?, Content = ?, TimeStamp = ?, FileName = ?, Location = ?, EventProblem = ? WHERE ID = ?")))
            {
                echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
            }

            /* Prepared statement, stage 2: bind parameters*/
            if (!$stmt->bind_param('ssisssi', $_title, $_text, $_time, $_file_name, $_location, $_eventProblem, $_postID))
            {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            /* Prepared statement, stage 3: execute*/
            if (!$stmt->execute())
            {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        }
    }

    function PostComment($_db, $_userID, $_postID, $_time, $_comment)
    {
        /* Prepared statement, stage 1: prepare query */
        if (!($stmt = $_db->prepare("INSERT INTO COMMENTS(UserID, PostID, TimeStamp, TEXT) VALUES (?, ?, ?, ?)")))
        {
            echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
        }

        /* Prepared statement, stage 2: bind parameters*/
        if (!$stmt->bind_param('iiss', $_userID, $_postID, $_time, $_comment))
        {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        /* Prepared statement, stage 3: execute*/
        if (!$stmt->execute())
        {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    function ChangeProblemStatus($_db, $_userID, $_postID, $_time, $_problemStatus){
        
        $check = "SELECT * FROM PROBLEMS WHERE `PostID` = $_postID";
        $result = $_db->query($check);

        if ($result->num_rows > 0) {
            //Use Update
            /* Prepared statement, stage 1: prepare query */
            if (!($stmt = $_db->prepare("UPDATE PROBLEMS SET UserID = ?,  PostID = ?,  TimeStamp = ?,  Status = ? WHERE PostID = ?")))
            {
                echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
            }

            /* Prepared statement, stage 2: bind parameters*/
            if (!$stmt->bind_param('iissi', $_userID, $_postID, $_time, $_problemStatus, $_postID))
            {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            /* Prepared statement, stage 3: execute*/
            if (!$stmt->execute())
            {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

        }else{
            /* Prepared statement, stage 1: prepare query */
            if (!($stmt = $_db->prepare("INSERT INTO PROBLEMS(UserID, PostID, TimeStamp, Status) VALUES (?, ?, ?, ?)")))
            {
                echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
            }

            /* Prepared statement, stage 2: bind parameters*/
            if (!$stmt->bind_param('iiss', $_userID, $_postID, $_time, $_problemStatus))
            {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            /* Prepared statement, stage 3: execute*/
            if (!$stmt->execute())
            {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        }
            if($_problemStatus == "Waiting"){
                $check = "SELECT * FROM GENERAL_USER WHERE Role = 'Admin'";
                $admins = $_db->query($check);
                if($admins->num_rows > 0){
                    foreach ($admins as $admin) {
                        SendMail($admin['Email']
                    , "New Problem Alerted"
                    ,"Hi ".$admin['Name'].", \nWe've just received a new problem on Campus Screenshot. Please sign in to take a look at it.");
                    }
                }
            }else{
                $check = "SELECT * FROM POSTS LEFT JOIN GENERAL_USER ON GENERAL_USER.ID = POSTS.UserID WHERE POSTS.ID = $_postID";
                $user = $_db->query($check);
                if($user->num_rows > 0){
                    while($row = $user->fetch_assoc()){
                        SendMail($row['Email']
                        , "Problem Status Updated"
                        ,"Hi ".$row['Name'].", \nThe Admin has just changed the status of your problem to ".$_problemStatus.". Please log in into campus screenshot.");
                    }
                }
            }
    }

    function GetProblems($_db, $_problemType){

        if($_problemType != "All"){
            $query = "SELECT * FROM `PROBLEMS` WHERE Status = '$_problemType'";
        }else{
            $query = "SELECT * FROM `PROBLEMS`";
        }

        if(!$result = $_db->query($query)){
            die("Error in the query.");
        }
        $output = [];

        while($row = $result->fetch_assoc()){
            array_push($output, $row);
        }

        return $output;

    }

    function GetProblemsByUserID($_db, $_userID){
        
        $query = "SELECT * FROM `POSTS` WHERE UserID = $_userID AND EventProblem = 'Problem'";

        if(!$result = $_db->query($query)){
            die("Error in the query.");
        }
        $output = [];

        while($row = $result->fetch_assoc()){
            array_push($output, $row);
        }

        return $output;

    }

    function GetPostsByUserID($_db, $_userID){
        
        $query = "SELECT P.*, C.CommentID, C.Text FROM POSTS AS P LEFT JOIN COMMENTS AS C ON P.ID = C.PostID WHERE P.UserID = $_userID";

        if(!$result = $_db->query($query)){
            die("Error in the query.");
        }
        $output = array();
        $comment = array();

        while($row = $result->fetch_assoc()){
            //array_push($output, $row);
            if($row['CommentID'] == NULL){
                if($comment != NULL){
                    $output[count($output) - 1]["Comments"] = $comment;
                    $comment = array();
                }
                array_push($output, array("PostID" => $row["ID"], "Title"=>$row["Title"], "Content"=>$row["Content"], "FileName"=> $row["FileName"], "TimeStamp"=>$row["TimeStamp"],"Location"=>$row["Location"],"EventProblem"=>$row["EventProblem"]));
            }else{
                if($output[count($output) - 1]["PostID"] != $row["ID"]){
                    array_push($output, array("PostID" => $row["ID"], "Title"=>$row["Title"], "Content"=>$row["Content"], "FileName"=> $row["FileName"], "TimeStamp"=>$row["TimeStamp"],"Location"=>$row["Location"],"EventProblem"=>$row["EventProblem"]));
                }
                array_push($comment, array("CommentID" => $row["CommentID"], "Text" =>$row["Text"], "TimeStamp" => $row["TimeStamp"], "UserID" => $row["UserID"]));
            }
        }

        if($comment != NULL){
            array_push($output[count($output) - 1]["Comments"], $comment);
            $comment = array();
        }

        return $output;

    }

    function GetAllPosts($_db){
        
        $query = "SELECT P.*, C.CommentID, C.Text FROM POSTS AS P LEFT JOIN COMMENTS AS C ON P.ID = C.PostID";

        if(!$result = $_db->query($query)){
            die("Error in the query.");
        }
        $output = array();
        $comment = array();

        while($row = $result->fetch_assoc()){
            //array_push($output, $row);
            if($row['CommentID'] == NULL){
                if($comment != NULL){
                    $output[count($output) - 1]["Comments"] = $comment;
                    $comment = array();
                }
                array_push($output, array("PostID" => $row["ID"], "Title"=>$row["Title"], "Content"=>$row["Content"], "FileName"=> $row["FileName"], "TimeStamp"=>$row["TimeStamp"],"Location"=>$row["Location"],"EventProblem"=>$row["EventProblem"]));
            }else{
                if($output[count($output) - 1]["PostID"] != $row["ID"]){
                    array_push($output, array("PostID" => $row["ID"], "Title"=>$row["Title"], "Content"=>$row["Content"], "FileName"=> $row["FileName"], "TimeStamp"=>$row["TimeStamp"],"Location"=>$row["Location"],"EventProblem"=>$row["EventProblem"]));
                }
                array_push($comment, array("CommentID" => $row["CommentID"], "Text" =>$row["Text"], "TimeStamp" => $row["TimeStamp"], "UserID" => $row["UserID"]));
            }
        }

        if($comment != NULL){
            array_push($output[count($output) - 1]["Comments"], $comment);
            $comment = array();
        }

        return $output;

    }

    function SendMail($_to, $_subject, $_message){
        $to      = $_to;
        $subject = $_subject;
        $message = $_message;
        $headers = 'From: sender@campusscreenshot.com' . "\r\n" . 'Reply-To: reply@campusscreenshot.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
    }

?>
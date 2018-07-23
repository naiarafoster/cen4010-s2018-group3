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

?>
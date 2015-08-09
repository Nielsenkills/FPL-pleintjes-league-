<?php 


function getGWTeamFromArray($teamID){
	$conn = connect();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `managers` WHERE team_id = " . $teamID ." ";
    $result = $conn->query($sql);


    $array = $result->fetch_row();
    $obj = new GWTeam($array[0], $array[1], $array[2],null,0,0,null);

	return $obj;
}


function getAllTeams(){
	    $conn = connect();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `managers` ";
    $result = $conn->query($sql);

    $teams = array();
    while ($array = $result->fetch_row()) {
    	$obj = new GWTeam($array[0], $array[1], $array[2],null,0,0,null);
        $teams[] = $obj;
    }
    return $teams;
}

?>
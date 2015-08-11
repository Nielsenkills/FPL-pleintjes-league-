<?php 


function getGWTeamForId($teamID){
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

function getManagerForId($teamID){
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `managers` WHERE team_id = " . $teamID ." ";
    $result = $conn->query($sql);


    $array = $result->fetch_row();
    $obj = new Manager($array[0], $array[1], $array[2]);

    return $obj;
}


function getAllTeams(){
	    $conn = connect();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `managers` ORDER BY draftorder ";
    $result = $conn->query($sql);

    $teams = array();
    while ($array = $result->fetch_row()) {
    	$obj = new GWTeam($array[0], $array[1], $array[2],null,0,0,null);
        $teams[] = $obj;
    }
    return $teams;
}

function getAllManagers(){
        $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `managers` ORDER BY draftorder ";
    $result = $conn->query($sql);

    $managers = array();
    while ($array = $result->fetch_row()) {
        $obj = new Manager($array[0], $array[1], $array[2]);
        $managers[] = $obj;
    }
    return $managers;
}

?>
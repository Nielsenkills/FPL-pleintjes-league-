<?php 


function getGWTeamFromArray($teamID){
	$teamsassoc = [
		17583=>new GWTeam(17583,"Robin","Verhulst",null,0,0,null),
		22840=>new GWTeam(22840,"Sven","Stassyns",null,0,0,null),
		1381770=>new GWTeam(1381770,"Yinan","Ma",null,0,0,null),
		1355632=>new GWTeam(1355632,"Mitch","De Lauwer",null,0,0,null),
		304862=>new GWTeam(304862,"Philip","Hermans",null,0,0,null),
		31151=>new GWTeam(31151,"Nielsen","Stassyns",null,0,0,null)
	];

	return $teamsassoc[$teamID];
}


function getAllTeams(){
	$teams = [
		new GWTeam(17583,"Robin","Verhulst",null,0,0,null),
		new GWTeam(22840,"Sven","Stassyns",null,0,0,null),
		new GWTeam(1381770,"Yinan","Ma",null,0,0,null),
		new GWTeam(1355632,"Mitch","De Lauwer",null,0,0,null),
		new GWTeam(304862,"Philip","Hermans",null,0,0,null),
		new GWTeam(31151,"Nielsen","Stassyns",null,0,0,null)
	];

	return $teams;

}

?>
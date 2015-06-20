<?php 


function getGWTeamFromArray($teamID){
	$teamsassoc = [
		797907=>new GWTeam(797907,"Robin","Verhulst",null,0,0,null),
		798119=>new GWTeam(798119,"Sven","Stassyns",null,0,0,null),
		798024=>new GWTeam(798024,"Yinan","Ma",null,0,0,null),
		798421=>new GWTeam(798421,"Jeff","Maeninckx",null,0,0,null),
		798140=>new GWTeam(798140,"Philip","Hermans",null,0,0,null),
		798595=>new GWTeam(798595,"Nielsen","Stassyns",null,0,0,null),
	];

	return $teamsassoc[$teamID];
}


	$teams = [
		new GWTeam(797907,"Robin","Verhulst",null,0,0,null),
		new GWTeam(798119,"Sven","Stassyns",null,0,0,null),
		new GWTeam(798024,"Yinan","Ma",null,0,0,null),
		new GWTeam(798421,"Jeff","Maeninckx",null,0,0,null),
		new GWTeam(798140,"Philip","Hermans",null,0,0,null),
		new GWTeam(798595,"Nielsen","Stassyns",null,0,0,null),
	];

	return $teams;

}

?>

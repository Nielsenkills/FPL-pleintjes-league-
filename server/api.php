<?php 
include 'models.php';
include 'currentusers.php';
include 'functions.php';



/*
global $currentGameWeek;

$currentGameWeek = 38;
*/



session_start();

function getPlayers(){
	return getAllTeams();
}

function getPlayerTableInfo($DOMDoc){
	$finder = new DomXPath($DOMDoc);
	$classname="ismH2HStandingsTable";
	$playerRows = $finder->query("//*[contains(@class, '$classname')]/tbody/tr");

	$returnArray = [];
	foreach($playerRows as $pRow){
		//$pValues = explode('\n',$pRow->nodeValue);
		
		 $playerDoc = new DOMDocument();
		$cloned = $pRow->cloneNode(TRUE);
		$playerDoc->appendChild($playerDoc->importNode($cloned, True));
		$xpath = new DOMXPath($playerDoc);
		
		
		$rowSearcher = new DomXPath($playerDoc);
		
		$pValues = $rowSearcher->query("//td");
		
		$team = new Team(null,null,null,$pValues->item(1)->textContent,$pValues->item(2)->textContent,$pValues->item(3)->textContent,$pValues->item(4)->textContent,$pValues->item(5)->textContent,$pValues->item(6)->textContent,$pValues->item(7)->textContent);
		$returnArray[] = $team;
	}
	return $returnArray;
}

function getCurrentGameWeekFromDOM($DOMDoc){
	$finder = new DomXPath($DOMDoc);
	$classname="ismH2HStandingsTable";
	$gameWeeks = $finder->query("//*[contains(@class, '$classname')]/tbody/tr/td/a");
	return get_string_between($gameWeeks->item(1)->getAttribute('href'),'/event-history/','/');
}


function getCurrentGameWeek($leagueId){
	if(!isset($_SESSION["GW"])){
	$url = 'http://fantasy.premierleague.com/my-leagues/'. $leagueId .'/standings/';
	$htm = file_get_contents($url);

	$content = stristr($htm, "<section class=\"ismPrimaryWide\">");
	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML($content);
	 $_SESSION["GW"] = getCurrentGameWeekFromDOM($doc);
	}else{
		return $_SESSION["GW"];
	}
}



function getLeagueStandings($leagueId){
	$url = 'http://fantasy.premierleague.com/my-leagues/'. $leagueId .'/standings/';
	$htm = file_get_contents($url);

	$content = stristr($htm, "<section class=\"ismPrimaryWide\">");
	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML($content);
	$_SESSION["GW"] = getCurrentGameWeekFromDOM($doc);

	return getPlayerTableInfo($doc);
}
function getAllGWTeams(){
$returnArray = array();

	foreach (getAllTeams() as $team) {
			$returnArray[] = getGWTeam($team->id);
	}
	return $returnArray;
}


function getGWTeam($teamId){
	$returnArray = [];

	$url = 'http://fantasy.premierleague.com/entry/' . $teamId . '/event-history/'. $_SESSION["GW"] . '/';
	$htm = file_get_contents($url);

	//get the GWTeam object from the predefined array in currentusers.php
	$GWTeam = getGWTeamFromArray($teamId);
	//get the pitch info for the players
	$DOMdoc = new DOMDocument();
	libxml_use_internal_errors(true);
	$DOMdoc->loadHTML($htm);

	$playerFinder = new DomXPath($DOMdoc);
	$classname="ismPitchElement";
	$playerRows = $playerFinder->query("//div[contains(@class, '$classname')]");

	
	//Get the total points for this gw team
	$totalPointsNode = $playerFinder->query("//div[contains(@class, 'ismSBPrimary')]/div");
	$GWTeam->points = preg_replace("/[^0-9]/","",$totalPointsNode->item(0)->nodeValue);

	//Get the amount of transfers for this gw team
	$transfersNode = $playerFinder->query("//dl[contains(@class, 'ismSBDefList')]/dd");
	$GWTeam->transfers = preg_replace("/[^0-9]/","",$transfersNode->item(1)->nodeValue);

	//Get the the teamname  for this gw team
	$teamNameNode = $playerFinder->query("//h2[contains(@class, 'ismSection3')]");
	$GWTeam->teamName = $teamNameNode->item(0)->nodeValue;


	// create an array using 'id' as the index
	$playerStats = array();

	foreach(json_decode($DOMdoc->getElementById('ismDataElements')->getAttribute('data-picks')) as $stat) {
   	 	$playerStats[$stat->element] = $stat->stats;
	}

	foreach ($playerRows as $p) {

		$jsonData = json_decode(str_replace('ismPitchElement','',$p->getAttribute('class')));
		$stringname = preg_replace('/[0-9]+/', '', $p->nodeValue);
		$isSub = intval($jsonData->sub) > 0;
		$pID = $jsonData->id;
		//form the stats into a playerdetail model FIX THE ORDER
		$playerDetails = new PlayerDetail($playerStats[$pID][2],$playerStats[$pID][3],$playerStats[$pID][4],$playerStats[$pID][5],$playerStats[$pID][6],$playerStats[$pID][7],$playerStats[$pID][8],$playerStats[$pID][9],$playerStats[$pID][10],$playerStats[$pID][11],$playerStats[$pID][12],$playerStats[$pID][13],$playerStats[$pID][15],$playerStats[$pID][16]);

		//create a player object
		$player = new Player($jsonData->id,
			$stringname,
			$jsonData->team,
			$jsonData->event_points,
			$jsonData->type,
			$isSub,
			$jsonData->is_captain == 1 ? true:false,
			$jsonData->is_vice_captain == 1 ? true:false,
			$playerDetails
		);

		$returnArray[] = $player;

		
	}

	$GWTeam->players = $returnArray;
	return $GWTeam;
}


// get player info http://fantasy.premierleague.com/web/api/elements/217  with the last being an id



//routing
if(isset($_GET["q"])){
	switch ($_GET["q"]) {
	case 'getPlayers':
		echo json_encode(getPlayers());
		break;
	case 'getGWTeam':
		getCurrentGameWeek(194302);
		echo json_encode(getGWTeam($_GET["tid"]));
		break;
	case 'getAllGWTeams':
		getCurrentGameWeek(194302);
		echo json_encode(getAllGWTeams());
		break;
	case 'getTournamentTable':
		echo json_encode(getLeagueStandings($_GET["lid"]));
		break;
	case 'getSessionId':
		echo session_id();
		break;
	default:
		break;
	}
}
else{
	echo json_encode(getLeagueStandings(194302));
	//getCurrentGameWeek(194302);
	//echo json_encode(getGWTeam(798421));
}



?>
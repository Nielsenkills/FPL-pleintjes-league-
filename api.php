<?php 
include 'models.php';
include 'functions.php';


/*
global $currentGameWeek;

$currentGameWeek = 38;
*/
$teams = [
"Robin V."=>797907,
"Sven S."=>798119,
"Yinan M."=>798024,
"Jeff M."=>798421,
"Philip H."=>798140,
"Nielsen S."=>798595
];

session_start();


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


function getPlayerListForTeam($teamId){
	$returnArray = [];

	getCurrentGameWeek(194302);

	$url = 'http://fantasy.premierleague.com/entry/' . $teamId . '/event-history/'. $_SESSION["GW"] . '/';
	$htm = file_get_contents($url);

	//get the pitch info for the players
	$DOMdoc = new DOMDocument();
	libxml_use_internal_errors(true);
	$DOMdoc->loadHTML($htm);


	$playerFinder = new DomXPath($DOMdoc);
	$classname="ismPitchElement";
	$playerRows = $playerFinder->query("//div[contains(@class, '$classname')]");

	
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
			$jsonData->event_points,
			$jsonData->type,
			$isSub,
			$jsonData->is_captain == 1 ? true:false,
			$jsonData->is_vice_captain == 1 ? true:false,
			$playerDetails
		);

		$returnArray[] = $player;

		
	}

	return $returnArray;
}


// get player info http://fantasy.premierleague.com/web/api/elements/217  with the last being an id



//routing
if(isset($_GET["q"])){
	switch ($_GET["q"]) {
	case 'getPlayerList':
		echo json_encode(getPlayerListForTeam($_GET["tid"]));
		break;
	case 'getTournamentTable':
		echo json_encode(getLeagueStandings($_GET["lid"]));
		break;
	default:
		break;
	}
}
else{
	echo json_encode(getLeagueStandings(194302));
}



?>
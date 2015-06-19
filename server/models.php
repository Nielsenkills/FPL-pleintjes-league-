<?php

//a team for a certain gameweek
class GWTeam
{
    public $id;
    public $firstName;
    public $lastName;
    public $teamName;
    
    
    public $points;
    public $transfers;
    public $players;

    // Assigning the values
    public function __construct($id,$firstName,$lastName,$teamName,$points,$transfers,$players)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;

        $this->teamName = $teamName;
        
        $this->points = $points;
        $this->transfers = $transfers;
        $this->players = $players;
    }
}

class Team
{
    public $id;
    public $firstName;
    public $lastName;
	
	
    public $rank;
    public $teamName;
	public $wins;
    public $draws;
    public $losses;
	
    public $totalPoints;
    public $matchPoints;

    // Assigning the values
    public function __construct($id,$firstName,$lastName,$rank,$teamName,$wins,$draws,$losses,$totalPoints,$matchPoints)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
		
        $this->rank = $rank;
		$this->teamName = $teamName;
		
        $this->wins = $wins;
        $this->draws = $draws;
        $this->losses = $losses;
		
        $this->totalPoints = $totalPoints;
        $this->matchPoints = $matchPoints;
    }
}

class Player{
    public $id;
    public $name;
    public $club;
    public $gamePoints;
    public $playerType;
    public $isSub;
    public $isCaptain;
    public $isViceCaptain;
    public $details;

    // Assigning the values
    public function __construct($id,$name,$club,$gamePoints,$playerType,$isSub,$isCaptain,$isViceCaptain,$details)
    {
        $this->id = $id;
        $this->name = $name;
        $this->club = $club;
        $this->gamePoints = $gamePoints;
        $this->playerType = $playerType;
        $this->isSub = $isSub;
        $this->isCaptain = $isCaptain;
        $this->isViceCaptain = $isViceCaptain;
        $this->details = $details;
    }
}

class PlayerDetail
{
    public $minutesPlayed;
    public $goalsScored;
    public $assists;
    public $cleanSheets;
    public $goalsConceded;
    public $ownGoals;
    public $penaltiesMissed;
    public $penaltiesSaved;
    public $yellowCards;
    public $redCards;
    public $saves;
    public $bonusPoints;
    public $bonusPointsSystem;
    public $gamePoints;

    // Assigning the values
    public function __construct($minutesPlayed,$goalsScored,$assists,$cleanSheets,$goalsConceded,$ownGoals,$penaltiesSaved,$penaltiesMissed,$yellowCards,$redCards,$saves,$bonusPoints,$bonusPointsSystem,$gamePoints)
    {
        $this->minutesPlayed = $minutesPlayed;
        $this->goalsScored = $goalsScored;
        $this->assists = $assists;
        $this->cleanSheets = $cleanSheets;
        $this->goalsConceded = $goalsConceded;
        $this->ownGoals = $ownGoals;
        $this->penaltiesSaved = $penaltiesSaved;
        $this->penaltiesMissed = $penaltiesMissed;
        $this->yellowCards = $yellowCards;
        $this->redCards = $redCards;
        $this->saves = $saves;
        $this->bonusPoints = $bonusPoints;
        $this->bonusPointsSystem = $bonusPointsSystem;
        $this->gamePoints = $gamePoints;
    }
}

class League
{
    public $id;
    public $name;
    public $password;

    // Assigning the values
    public function __construct($id, $name,$password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

}

class Match
{
    public $id;
    public $homeId;
    public $homeScore;
    public $awayId;
    public $awayScore;
    public $adminId;
    public $tournamentId;
    public $regDate;
    public $version;
    public $random;

    // Assigning the values
    public function __construct($id, $homeId,$homeScore,$awayId,$awayScore,$adminId,$tournamentId,$regDate,$version,$random)
    {
        $this->id = $id;
        $this->homeId = $homeId;
        $this->homeScore = $homeScore;
        $this->awayId = $awayId;
        $this->awayScore = $awayScore;
        $this->adminId = $adminId;
        $this->tournamentId = $tournamentId;
        $this->regDate = $regDate;
        $this->version = $version;
        $this->random = $random;
    }

}



?>
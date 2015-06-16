<?php
    $url = 'http://fantasy.premierleague.com/my-leagues/194302/standings/';
    $htm = file_get_contents($url);
	$first_step = explode( '<table class="ismTable ismH2HStandingsTable">' , $htm );
	$second_step = explode("</table>" , $first_step[1] );
	echo '<div id="verberg">&nbsp;</div>';
	echo '<div style="pointer-events: none;"><table class="ismTable ismH2HStandingsTable">';
	echo $second_step[0];
	echo '</table></div>';
    //echo $htm;
?>
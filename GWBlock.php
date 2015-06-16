<?php 
$url = 'http://fantasy.premierleague.com/my-leagues/194302/standings/';
$htm = file_get_contents($url);
$first_step3 = explode( '/event-history/' , $htm );
$second_step3 = explode('/">' , $first_step3[2] );
global $Huidige_speeldag;
$Huidige_speeldag = $second_step3[0]; 

variable_set('current_GW', $Huidige_speeldag);

$Huidige_speeldag = variable_get('current_GW', 0);
?>

<h2>Current GW <?php echo $Huidige_speeldag; ?></h2>
<?php
    $url = 'http://fantasy.premierleague.com/my-leagues/194302/standings/';
    $htm = file_get_contents($url);
	$first_step = explode( '<table class="ismTable ismH2HFixTable">' , $htm );
	$second_step = explode("</table>" , $first_step[1] ); 
	echo '<div style="pointer-events: none;width: 304px;"><table class="ismTable ismH2HFixTable" width="305">';
	echo $second_step[0];
	echo '</table></div>';
    //echo $htm;
?>
<h2>Upcoming GW <?php echo ($Huidige_speeldag + 1); ?></h2>
<?php
	$first_step2 = explode( '<table class="ismTable ismH2HFixTable">' , $htm );
	$second_step2 = explode("</table>" , $first_step2[2] );	
	echo '<div style="pointer-events: none;width: 304px;"><table class="ismTable ismH2HFixTable" width="305">';
	echo $second_step2[0];
	echo '</table></div>';
    //echo $htm;
?>
  <?php
	$Array_Players = array(
    "Verhulst"  => array("797907"),
    "Sven" => array("798119"),
	"Yinan"  => array("798024"),
    "Mitch" => array("798421"),
	"Hermans"  => array("798140"),
    "Nielsen" => array("798595")
	);
	?>
    
    <?php
function getPlayerTeamDetails($teamId,$Speeldag) {
					
			$url = 'http://fantasy.premierleague.com/entry/'.$teamId.'/event-history/'.$Speeldag.'/';
			$htm = file_get_contents($url);
			
			$first_step4 = explode( '<div class="ismSBValue ismSBPrimary">' , $htm );
			$second_step4 = explode('<div>' , $first_step4[1] );
			$LivePunten = explode('</div>' , $second_step4[1] );

			$first_step5 = explode( '<dl class="ismDefList ismSBDefList">' , $second_step4[1] );
			$second_step5 = explode('<dd>' , $first_step5[1] );
			$LiveTransfers = explode('</dd>' , $second_step5[2] );	
			
			/*$first_step6 = explode( '<dl class="ismDefList ismRHSDefList ismRHSTFList ismRHSFinanceList">' , $htm );
			$second_step6 = explode('<dd>' , $first_step6[1] );
			$TeamValue = explode('</dd>' , $second_step6[1] );	
			$TeamBank = explode('</dd>' , $second_step6[2] );*/
			
			//print_r($first_step6);
						
			return array($LivePunten[0], $LiveTransfers[0], $TeamValue[0], $TeamBank[0]);
}
?>
	<?php

$Huidige_speeldag = variable_get('current_GW', 0);

	foreach ($Array_Players as $name => $ids) {
		foreach ($ids as $id) {
			$url = 'http://fantasy.premierleague.com/entry/'.$id.'/event-history/'.$Huidige_speeldag;
			$htm = file_get_contents($url);
			$filterplayernames_first_step = explode( '<span class="ismElementText ismPitchWebName JS_ISM_NAME">' , $htm );
			$filterplayerteams_first_step = explode( 'width="48" height="63" title="' , $htm );
			$filterplayercaptains_first_step = explode( 'title="captain" class="ismCaptain ismCaptain' , $htm );
			$filterplayervcaptains_first_step = explode( 'title="vice-captain" class="ismViceCaptain ismViceCaptain' , $htm );
			$filterpositionplayer_first_step = explode( '"type": ' , $htm );
			$filterminutes_first_step = explode( '"JS_ISM_NAME", "JS_ISM_INFO", ' , $htm );
			$filterplayerpoints_first_step = explode( '"event_points": ' , $htm );
			$humanPlayerTeamDetails[$id] = getPlayerTeamDetails($id,$Huidige_speeldag);
			for ($i = 1; $i <= 15; $i++) {
    		$filterplayernames_second_step = explode('</span>' , $filterplayernames_first_step[$i] );
			$playerlist[$id][$i] = $filterplayernames_second_step[0];
			//echo "Player{$i}: ".$playerlist[$id][$i].'</br>';
			
			$filterplayerteams_second_step = explode('" class="ismShirt">' , $filterplayerteams_first_step[$i] );
			$teamlist[$id][$i] = $filterplayerteams_second_step[0];
			//echo "Team{$i}: ".$teamlist[$id][$i].'</br>';
			
			$filterplayercaptains_second_step = explode('"> <img width="16" height="16" alt="vice-captain"' , $filterplayercaptains_first_step[$i] );
			$captainlist[$id][$i] = $filterplayercaptains_second_step[0];
			//echo "Captain{$i}: ".$captainlist[$id][$i].'</br>';
			
			$filterplayervcaptains_second_step = explode('"> </span>  <!-- info -->  <span class="JS_ISM_INFO">' , $filterplayervcaptains_first_step[$i] );
			$vcaptainlist[$id][$i] = $filterplayervcaptains_second_step[0];
			//echo "VCaptain{$i}: ".$vcaptainlist[$id][$i].'</br>';
			
			$filterpositionplayer_second_step = explode(', "ep_next":' , $filterpositionplayer_first_step[$i] );
			$vpositionlist[$id][$i] = $filterpositionplayer_second_step[0];
			//echo "vpositionlist{$i}: ".$vpositionlist[$id][$i].'</br>';

			$filterminutes_second_step = explode(', ' , $filterminutes_first_step[$i] );
			$minuteslist[$id][$i] = $filterminutes_second_step[0];
			//echo "vpositionlist{$i}: ".$vpositionlist[$id][$i].'</br>';			
			
			$filterplayerpoints_second_step = explode(',' , $filterplayerpoints_first_step[$i] );
			$playerpoints[$id][$i] = $filterplayerpoints_second_step[0];
			//echo "playerpoints{$i}: ".$playerpoints[$id][$i].'</br>';
			}
			
			/*$second_step = explode('</span>' , $first_step[1] );
			$keeper_one[$id] = $second_step[0];
			echo "Keeper1: ".$keeper_one[$id].'</br>';
			
			$second_step = explode('</span>' , $first_step[2] );
			$defender_one[$id] = $second_step[0];
			echo "defender1: ".$defender_one[$id].'</br>';*/
		}
	}	
    //echo $htm;
?>

<?php 
	foreach ($Array_Players as $name => $ids) {
		foreach ($ids as $id) {
?>
<div class="PloegenBox" style="float:left">
<table width="265" border="0">
  <tr>
    <td align="center" width="100px"><strong><?php echo "{$name}"; ?></strong></td>
    <td align="left" style="font-size:22px"><strong><?php echo $humanPlayerTeamDetails[$id][0]; ?></strong></td>
    <td align="right" width="100px" style="font-size:12px"><?php echo "Transfers: ".$humanPlayerTeamDetails[$id][1]; ?></td>
  </tr>
  
  </table>
  <table width="265" border="0">

<tr style="border-bottom: 1px solid #000;">
    <td>Name</td>
    <td>Club</td>
    <td>Pts</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  for ($i = 1; $i <= 15; $i++) { 
  echo '<tr ';
  if ($i<12){ echo 'bgcolor="#ECFDEF" '; } else { echo 'bgcolor="#FFF2F3" ';}
  if ($vpositionlist[$id][$i] == 1){ echo 'style="border-left: 2px solid #00FF00;';}
  if ($vpositionlist[$id][$i] == 2){ echo 'style="border-left: 2px solid #0000FF;';}
  if ($vpositionlist[$id][$i] == 3){ echo 'style="border-left: 2px solid #FFE800;';}
  if ($vpositionlist[$id][$i] == 4){ echo 'style="border-left: 2px solid #FF0000;';}
  if ($minuteslist[$id][$i] > 0){ echo ' font-weight: bold;';}
  echo '">';
  echo "<td ";
  
  echo ">".$playerlist[$id][$i]."</td>";
  echo "<td>".$teamlist[$id][$i]."</td>";
  echo "<td>".$playerpoints[$id][$i]."</td>";
  if ($captainlist[$id][$i] == 'On'){
	echo "<td>C</td>";  
	  } elseif ($vcaptainlist[$id][$i] == 'On') { 
  echo "<td>V</td>";
  } else { echo "<td>&nbsp;</td>"; }
  echo "</tr>";
  }
  ?>
</table>
</div>
<?php

		}
	}	
 ?>
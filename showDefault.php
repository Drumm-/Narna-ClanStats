<?php

//-----------------------------------------------------------------------------------------------------
	function get_clans() { 
		$result = @mysql_query("SELECT * FROM sc_clans ORDER BY tag DESC") 	or die(mysql_error());
		while($tmp=@mysql_fetch_assoc($result)) {
			$return[] = $tmp;
		}
	return $return;
	}


	function get_members($clantag) {
		$result = @mysql_query("SELECT * FROM sc_players WHERE tag = '$clantag' ORDER BY leader DESC") 	or die(mysql_error());
		while($tmp=@mysql_fetch_assoc($result)) {
			$return[] = $tmp;
		}
	return $return;
	}
	
//-------------------------------------------------------------------------------------------------------




	echo "<br />";	
	
	foreach( get_clans() as $clan ) {
	  echo "<table align='center' width='900px' border='0'>";
	  echo "<tr>";
	  echo "<td align='center'><img src='img/claninfo.png'></td>";
	  echo "</tr>";
	  echo "</table>";
	 
	$cape = $clan['cape_url'];
  
  $mil = $clan['founded'];
  $seconds = $mil / 1000;
  $clancreate = date("d-m-Y", $seconds);
  $clanrival = $clan['packed_rivals'];
  $clanallies = $clan['packed_allies'];
  
		echo "<table align='center' width='900px' border='0'>";
	  echo "<tr>";
		echo "<td align='center' width='90px'><b>Cape</b></td>
	  <td align='left' width='250px'><b>Name</b></td>
	  <td align='left' width='80px'><b>Tag</b></td>
    <td align='left' width='100px'><b>Create</b></td>
	  <td align='left' width='150px'><b>Rival</b></td>
	  <td align='left' width='150px'><b>Alliances</b></td>
	  <td align='left' width='80px'><b>Member</b></td>";
		echo "</td>";
		echo "</tr>";
	  echo "<tr>";
		echo "<td align='center' width='90px'>";
	  if ($cape ==''){ echo "<img src='img/non_cape.png' width='64px' height='32px'/>";} else {echo "<img src='$cape' alt='ClanCape' width='64px' height='32px' />"; };
	  echo "</td>
	  <td align='left' width='250px'>".$clan['name']." </td>
	  <td align='left' width='80px'>".$clan['tag']." </td>
    <td align='left' width='100px'>$clancreate</td>
	  <td align='left' width='150px'>";
    if ($clanrival ==''){ echo "none";} else {echo "$clanrival"; }
    echo"</td>
	  <td align='left' width='150px'>";
    if ($clanallies ==''){ echo "none";} else {echo "$clanallies"; }
    echo "</td>
	  <td align='left' width='80px'>".count(get_members($clan['tag']))."</td>
	  <br/>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
    
    echo "<br/>";
		
		echo "<table align='center' width='800px' border='0'>";
		echo "<tr>";
		  echo "<th align='left' width='30px'></th><th align='left' width='130px'>Member</th><th align='left' width='130px'>Rank</th><th align='left' width='130px'>CivilianKills</th><th align='left' width='130px'>Neutralkills</th><th align='left' width='130px'>RivalKills</th><th align='left' width='130px'>Deaths</th><th align='left' width='50px'>KDR</th></tr>";
		echo "</table>";

			echo "<table align='center' width='800px' border='0'>";
		
		foreach ( get_members($clan['tag']) as $member ) {
		$kdrcivi = $member['civilian_kills']*$bascivi;
		$kdrneu = $member['neutral_kills']*$baseneu;
		$kdrriv = $member['rival_kills']*$baseriv;
		$kdrplus = $kdrcivi+$kdrneu+$kdrriv;
		$kdrd = $member['deaths'];
		if ($kdrd =='0'){ $kdrd=+1 ;} else {$kdrd; };
		$kdrges = $kdrplus/$kdrd;
		$kdrnumber = number_format($kdrges, 1, '.', '');
    
    $rang = $member['leader'];
    
		
			echo "<tr class='clanmember' style='cursor:pointer;' onclick='get_member_details(\"".$member['name']."\")'>
      <td align='left' width='30px'>";
      if( $dynmap !== "####" ) {echo"<img src='http://$dynmap/tiles/faces/16x16/".$member['name'].".png' /></td>";} else {echo"<img width='16px' height='16px' src='https://minotar.net/avatar/" . $member['name'] . "/16' /></td>";}
      echo "<td align='left' width='130px'>".substr($member['name'], 0, 12)."</td>
      <td align='left' width='130px'>";
      if ($rang =='1'){ echo "Leader";} else {echo "Member"; }
      echo"</td>
      <td align='left' width='130px'>".$member['civilian_kills']."</td>
      <td align='left' width='130px'>".$member['neutral_kills']."</td>
      <td align='left' width='130px'>".$member['rival_kills']."</td>
      <td align='left' width='130px'>".$member['deaths']."</td>
      <td align='left' width='50px'>".$kdrnumber."</td>
      </tr>
      <tr>
      <td class='clanmember_details' id='".$member['name']."' colspan='8'></td>
      </tr>";
			}
		  
			
		  echo "</table>";
		  echo "<br />";
	}
  
  

?>

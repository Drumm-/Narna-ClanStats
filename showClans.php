<?php
include ('connector.php');

//-------------------------------------------------------------------------------------------------------
	function get_clans() { 
		$result = @mysql_query("SELECT *, IF ( (SELECT count(attacker_tag) FROM sc_kills WHERE attacker_tag=sc_clans.tag) = 0 AND (SELECT COUNT(victim_tag) FROM sc_kills WHERE victim_tag=sc_clans.tag) = 0, 0, ROUND(IF ( (SELECT count(attacker_tag) FROM sc_kills WHERE attacker_tag=sc_clans.tag),  (SELECT count(attacker_tag) FROM sc_kills WHERE attacker_tag=sc_clans.tag), 1)/IF ( (SELECT COUNT(victim_tag) FROM sc_kills WHERE victim_tag=sc_clans.tag),  (SELECT COUNT(victim_tag) FROM sc_kills WHERE victim_tag=sc_clans.tag), 1 ),2)) AS KDR FROM sc_clans ORDER BY KDR DESC") 	or die(mysql_error());
		while($tmp=@mysql_fetch_assoc($result)) {
			$return[] = $tmp;
		}
	return $return;
	}
  
  	function get_members($clantag) {
		$result = @mysql_query("SELECT * FROM sc_players WHERE tag = '$clantag' ORDER BY tag DESC") 	or die(mysql_error());
		while($tmp=@mysql_fetch_assoc($result)) {
			$return[] = $tmp;
		}
	return $return;
	}
//-------------------------------------------------------------------------------------------------------
foreach( get_clans() as $clan ){
	echo "<table align='center' width='900px' border='0'>
		<tr>
			<td align='center'></td>
		</tr>
	</table>";
	 
	$cape = $clan['cape_url'];
	
  
	$mil = $clan['founded'];
	$seconds = $mil / 1000;
	$clancreate = date("d-m-Y", $seconds);
	$clanrival = $clan['packed_rivals'];
	$clanallies = $clan['packed_allies'];
	$KDR = $clan['KDR'];
  
	echo "<table align='center' width='900px' border='0' style='table-layout:fixed;'>
		<tr>
			<td align='center' width='90px'><b>Cape</b></td>
			<td align='left' width='250px'><b>Name</b></td>
			<td align='left' width='80px'><b>Tag</b></td>
			<td align='left' width='100px'><b>Created</b></td>
			<td align='left' width='40px'><b>KDR</b></td> 
			<td align='left' width='150px'><b>Rivals</b></td>
			<td align='left' width='150px'><b>Alliances</b></td>
			<td align='left' width='40px'><b>Members</b></td>
		</tr>
		<tr>
			<td align='center' width='90px'>";
			if ($cape ==''){ echo "<img src='img/non_cape.png' width='64px' height='32px' />";} else {echo "<img src='$cape' alt='ClanCape' width='64px' height='32px' />"; };
			echo "</td>
			<td style='overflow: hidden;' align='left' width='250px'>" . $clan['name'] . "</td>";
			echo "<td style='overflow: hidden;' align='left' width='80px'>" . $clan['tag'] . "</td>";
			echo "<td style='overflow: hidden;' align='left' width='100px'>" . $clancreate . "</td>";
			echo "<td style='overflow: hidden;' align='left' width='40px'>" . $KDR . "</td>";
			echo "<td style='overflow: hidden;' align='left' width='150px'>";
			if ($clanrival ==''){ echo "none";} else {echo "$clanrival"; }
			echo "</tl>";
			echo "<td style='overflow: hidden;' align='left' width='150px'>";
			if ($clanallies ==''){ echo "none";} else {echo "$clanallies"; }
			echo "</td>";
			echo "<td style='overflow: hidden;' align='left' width='40px'>" . count(get_members($clan['tag'])) . "</td>";
     			echo " 
			<br/>
		</tr>
	</table>";
	}
?>
</table>
<br />

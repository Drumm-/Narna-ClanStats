<?php
//-------------------------------------------------------------------------------------------------------
  function get_leaders($civ, $neu, $riv){ $sSQL = "SELECT *, IF ( deaths = 0 AND (civilian_kills * $civ + neutral_kills * $neu + rival_kills * $riv) = 0, 0, IF(civilian_kills * $civ + neutral_kills * $neu + rival_kills * $riv, civilian_kills * $civ + neutral_kills * $neu + rival_kills * $riv, 1) / IF( deaths, deaths, 1)) as KDR from sc_players order by KDR DESC LIMIT 100;";

$result = @mysql_query($sSQL) or die(mysql_error()); while($tmp=@mysql_fetch_assoc($result)) { $return[] = $tmp; } return $return; }

$i=1;
//-------------------------------------------------------------------------------------------------------

echo "<table align='center' width='800px' border='0'>"; 
echo "<tr><th align='center' colspan=8 style='font-size:150%'>Top 100 Player</tr>"; 
echo "<tr>"; 
echo "<th align='left' width='20px'>Rank</th>
<th align='left' width='20px'>Face</th>
<th align='left' width='130px'>Player</th>
<th align='left' width='50px'>Clan</th>
<th align='left' width='50px'>KDR</th>
<th align='left' width='120px'>Rivals</th>
<th align='left' width='120px'>Neutrals</th>
<th align='left' width='120px'>Civilians</th>
<th align='left' width='100px'>Deaths</th></tr>"; 

foreach ( get_leaders($bascivi, $baseneu, $baseriv) as $member ) {

$kdrges = $member['KDR'];
$kdrnumber = number_format($kdrges, 1, '.', '');
$rang = $member['leader'];

echo "<tr class='clanmember' style='cursor:pointer;' onclick='get_member_details(\"".$member['name']."\")'> 
<td align='left' width='20px'>";
echo $i++;
echo "<td align='center' width='20px'>";
if( $dynmap !== "####" ) {echo"<img src='http://$dynmap/tiles/faces/16x16/".$member['name'].".png' /></td>";} else {echo"<img height='16' width='16' src='https://minotar.net/avatar/".$member['name']."/16' /></td>";} 
echo "<td align='left' width='130px'>".substr($member['name'], 0, 12)."</td>
<td align='left' width='50px'>".$member['tag']."</td> 
<td align='left' width='50px'>";
echo  $kdrnumber;
echo "</td> 
<td align='left' width='120px'>".$member['rival_kills']."</td> 
<td align='left' width='120px'>".$member['neutral_kills']."</td> 
<td align='left' width='120px'>".$member['civilian_kills']."</td> 
<td align='left' width='100px'>".$member['deaths']."</td> </tr><tr>
<td class='clanmember_details' id='".$member['name']."' colspan='9'></td></tr>"; } 
echo "</table>"; 

//-------------------------------------------------------------------------------------------------------
 
 ?>

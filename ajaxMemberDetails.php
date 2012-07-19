 <?php
include("connector.php");
    
//----------------------------------------------------------------------------------------------   
$name = htmlspecialchars($_GET['q']);
    
    function details_member($name) {
        $result = @mysql_query("SELECT * FROM sc_players WHERE name = '".$name."'") or die(mysql_error());
            while($tmp=@mysql_fetch_assoc($result)) {
                $return[] = $tmp;
            }
    return $return;
    }
    
	function details_attacker($name) {
        $result = @mysql_query("SELECT * FROM sc_kills WHERE attacker = '".$name."'ORDER BY kill_id DESC LIMIT 10") or die(mysql_error());
            while($tmp=@mysql_fetch_assoc($result)) {
                $return[] = $tmp;
            }
    return $return;
    }
	
	function details_victim($name) {
        $result = @mysql_query("SELECT * FROM sc_kills WHERE victim = '".$name."'ORDER BY kill_id DESC LIMIT 10") or die(mysql_error());
            while($tmp=@mysql_fetch_assoc($result)) {
                $return[] = $tmp;
            }
	return $return;
    }
	
	function attacker_test($name) {
		foreach (details_member($name) as $player) {
			if ( $player['civilian_kills'] >= 1  OR $player['rival_kills'] >= 1 OR $player['neutral_kills'] >= 1 ) {
				return true;
			}
		}
	}
	
	function victim_test($name) {
		foreach (details_member($name) as $player) {
			if ( $player['deaths'] == 0 ) {
				return true;
			}
		}
	}
    

//-----------------------------------------------------------------------------------------------
?>   
<table width='800px'>
    <tr>
        <td>
			<table align='center' width='270px' border='0'>
			<?php if(attacker_test($name) == true){
				echo "<tr><th align='left' colspan='3'>10 Recent Kills</th></tr>
            			<tr><th align='left'>Victim</th><th align='left'>Clan Tag</th><th align='left'>Type</th></tr>"; 
				foreach(details_attacker($name) as $player ){
				    echo "<tr>
				    <td align='left' width='150px'>" . substr($player['victim'], 0, 12) . "</td>
				    <td align='left' width='80px'>" . strtoupper($player['victim_tag']);
					if($player['victim_tag'] == "")echo"------"; 
				echo	"</td>
				    <td align='left' width='60px'>";
				switch($player['kill_type']){case "c": echo"Civil";break;case "n":echo"Neutral";break;case "r":echo"Rival";break;}
				echo "</td>";

				    echo "</tr>";
			
               			} 
			}
			else{
				echo "This Player hasn't killed anyone.";
			}
			?>
            </table>
        </td>
        <td>
            <table width='220px' align='center'>
                <tr>
                   <td align='center'><b><?php substr($name, 0, 20)?></b><br/></td>
                </tr>
                <tr>
                    <td align='center'><?php if ( $dynmap !== "####" ) {echo"<img src='http://$dynmap/tiles/faces/body/$name.png' height='100px' /></td>";} else {echo"<img src='MinecraftSkinPreview.php?pseudo=$name' height='100px' /></td>";} ?>
                </tr>
                <tr>
                   <td align='center'>
                   
                             <table width='220px' border='0'>
                                 <tr>
                                   <td align='left'><b>Join Clan</b></td>
                                   <td align='right'><b>Last Seen</b></td>
                                 </tr>
                                 <tr>
                                   <td align='left'>
                                       <?php foreach (details_member($name) as $member ){
                                           $join_clan = $member['join_date'];
                                           $seconds = $join_clan / 1000;
                                           echo date("d-m-Y", $seconds);
					} ?>
                                   </td>
                                   <td align='right'>
                                        <?php foreach (details_member($name) as $member ){
                                           $last_on = $member['last_seen'];
                                           $seconds= $last_on / 1000;
                                           echo date("d-m-Y", $seconds); 
					}
					?>
                                   </td>
                                </tr>
                             </table>
                                                                                         
                  </td>
                </tr>
           </table>
        </td>
        <td>
			<table align='right' width='270px' border='0'>
            <?php if(victim_test($name) == false){
            	echo "<tr><th align='right' colspan='3'>10 Recent Deaths</th></tr>
            	<tr><th align='left'>Attacker</th><th align='left'>Clan Tag</th><th align='left'>Typ</th></tr>";
                foreach(details_victim($name) as $player ){
                    echo "<tr><td width='150px' align='left'>" . substr($player['attacker'], 0, 12) . "</td>";
                    echo "<td width='80px' align='left'>" . strtoupper($player['attacker_tag']);
			if($player['attacker_tag'] == "")echo"------";
			echo "</td>";
                    echo "<td width='40px' align='left'>";
			switch($player['kill_type']){case "c": echo"Civil";break;case "n":echo"Neutral";break;case "r":echo"Rival";break;}
			echo "</td></tr>";

                }
		 }else
                    echo "This player hasn't died yet. "
		?>
            </table>
       </td>
    </tr>
</table>

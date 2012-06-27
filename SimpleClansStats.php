<?php
include("connector.php");
?>


	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<head>

<title>SimpleClansStats</title>
<!-- CSS INCLUDE -->
<link href="css_stats/stats.css" rel="stylesheet" type="text/css" />

<!-- Script INCLUDE -->
<script type="text/javascript" src="java_stats/stats.js"></script>

</head>

<body>

<div align="center">

<div id="scs_main_container">
<div id="scs_header">
  
<table align='center' width='900px' border='0'>
<tr>
<td align='center'><img src='img/clanstats.png'></td>
</tr>
</table>
</div>

<div id="clear"></div>

<div id="scs_navi">
<div id="scs_navi_buttons">
<a class="menu" href="<?php echo $PHP_SELF?>?content=showHome"><b>Home</b></a>
<a class="menu" href="<?php echo $PHP_SELF?>?content=showClans"><b>ClanRanks</b></a>
<a class="menu" href="<?php echo $PHP_SELF?>?content=showPlayers"><b>PlayerRanks</b></a>
<a class="menu" href="<?php echo $PHP_SELF?>?content=showInfo"><b>Info</b></a>
</div>
</div>

<div id="clear"></div>
<div id="scs_content">


<?php
switch ($_GET['content'])
{
	case "showInfo":
		include("showInfo.php");
		break;
	case "showPlayers":
		include("showPlayers.php");
		break;
	case "showClans":
		include("showClans.php");
		break;
	case "showHome":
		include("showDefault.php");
		break;
	default:
		include("showDefault.php");
		break;	
}
?>

</div>

<div id="clear"></div>

<!-- Do not remove the link and the images!! // Der Link und das Bild d&uuml;rfen nicht entfernt werden!! -->
<div id="scs_footer">
<table align='center' width='900px' border='0'>
<tr>
<td align='center'>
<a href='http://dev.bukkit.org/server-mods/simpleclansstats' target='_blank' style='font-size:0.8em;color:black;text-decoration:none;'>SimpleClansStats</a></td>
</tr>
</table>
</div>
</div>
</div>
</body>
</html>



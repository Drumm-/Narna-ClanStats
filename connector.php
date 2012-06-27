<?php
// Database from SimpleClans-----------------
$dbhost = '127.0.0.1:3306';  //DB Connector
$dbuser = 'root';
$dbpass = '####';
$dbname = 'minecraft';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql'); 
mysql_select_db($dbname);

// ------Look in your config.yml by SimpleClans
//kill-weights:
$bascivi = 0.0;   // = civilian: 0.5 
$baseneu = 1.0;   // = neutral: 1.0
$baseriv = 2.0;   // = rival: 2.0

// Dynmap Optional---------------------------
$dynmap = '####'; //Example: ='92.51.171.14:8123' 
//Leave '####' for no dynmap integration
// ------------------------------------------
// All Dynmap Functionality can be shown in an alternative way..
// May be broken, I haven't tested, as I don't use. 
// Contact me if you have issues: Drumm@ProjectNarna.co.uk

?>





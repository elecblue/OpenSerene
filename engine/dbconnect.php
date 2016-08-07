<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: engine/dbconnect.php
	
*/

require("config.inc.php");

mysql_connect ("$host", "$username", "$password") 
	or die ('I cannot connect to the database because:<br /> ' . mysql_error());
mysql_select_db ("$database")
	or die ('I cannot select a database because:<br /> ' . mysql_error());

?>
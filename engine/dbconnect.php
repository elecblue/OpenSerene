<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: engine/dbconnect.php
	
*/

require("config.inc.php");

mysql_connect (SQL_DB_HOST, SQL_DB_USER, SQL_DB_PASS) 
	or die ("I cannot connect to the database because:<br />" . mysql_error());
mysql_select_db (SQL_DB_NAME)
	or die ("I cannot select a database because:<br /> " . mysql_error());

?>
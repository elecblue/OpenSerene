<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: engine/config.inc.php
	
*/

// config.inc.php -- This file is required! //

//Edit this page with your MySQL information. 
$host = "localhost:/opt/bitnami/mysql/tmp/mysql.sock"; // You'll probably need to remove that socket location
$username = "dev";
$database = "serene_test";
$password = "password";

define("SQL_DB_HOST", $host, true);
define("SQL_DB_USER", $username, true);
define("SQL_DB_PASS", $password, true);
define("SQL_DB_NAME", $database, true);

//Install Admin Account Information FILL OUT BEFORE INSTALL!
$adminuser = "nik";
$adminpass = "opensesame";
$adminemail = "youremail@domain.tld";

// IGNORE
$getcwd = getcwd();

//Edit this part with your site information. Replace Example Information
$siteName = "OpenSerene";
$siteSlogan = "This is a slogan and/or subtitle.";
$siteAddress = "http://vicegirls.us/serene"; // Where the CMS is intalled.
$sitePath = "$getcwd"; // Local Path to Installation
$siteEmail = "dev@vicegirls.us";
$siteCopyright = "VICEGIRLS";

//CMS Options
$wysiwyg = "true"; 	// True determines whether the visual editor is on. True for on, false for off. Defaults to on. (The editor isn't suggested if your admin panel is lagging).
$uploadOpt = "false";  	//This allows users to upload user option files to your server for their use. This feature has yet to be implimented so it defaults as false.
$commentOpt = "false";	//This allows users to comment on stories. This feature has yet to be implimented and it defaults as false.

$cms['version'] = "0.1.0 (Bender)";

?>
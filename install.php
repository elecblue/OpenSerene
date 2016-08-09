<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: install.php
	
*/

require("engine/function.inc.php");
require("engine/dbconnect.php"); 

$today = date("d M y");

######## STORIES TABLE #########
$q[] = "CREATE TABLE `stories` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `user` varchar(22) NOT NULL default '',
  `date` varchar(50) NOT NULL default '0000-00-00',
  `message` text NOT NULL,
  `avatar` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
);";

$q[] = "INSERT INTO `stories` VALUES (1, 'Welcome to SereneCMS', 'aDev', '$today', 'Welcome to SereneCMS, if you see this, you have installed it successfully!', '');";

######## USERS TABLE ########
$q[] = "CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(5) NOT NULL default 'user',
  `username` varchar(30) NOT NULL default '',
  `password` varchar(20) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `avatar` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
);";

######## SETTINGS TABLE ########
$q[] = "CREATE TABLE `settings` (
  `id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `subtitle` varchar(255) NOT NULL default '',
  `siteurl` varchar(255) NOT NULL default '',
  `sitepath` varchar(255) NOT NULL default '',
  `theme` varchar(255) NOT NULL default 'default',
  `uploadopt` varchar(5) NOT NULL default 'false',
  `commentopt` varchar(5) NOT NULL default 'false',
  `wysiwyg` varchar(5) NOT NULL default 'false',
  `urchin` varchar(5) NOT NULL default 'true',
  `descript` varchar(255) NOT NULL default '',
  `keywords` text NOT NULL,
  `author` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
)";

$q[] = "INSERT INTO `settings` VALUES (1, '$siteName', '$siteSlogan', '$siteAddress', '$sitePath', 'default', '$uploadOpt', '$commentOpt', '$wysiwyg', '', '','', '');";

######## LINKS TABLE ########
$q[] = "CREATE TABLE `links` (
  `name` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
)";

$q[] = "INSERT INTO `links` VALUES ('Atriotic, LLC', 'http://www.atriotic.com', 'Atriotic, LLC', 1);";
//create tables
foreach ($q as $query){
  mysql_query($query) 
	or die (mysql_error());
}

mysql_query("INSERT INTO `users` VALUES (1, 'admin', '$adminuser', '$adminpass', '$adminemail', '');");

echo 'SereneCMS Installed Successfully!';
?>
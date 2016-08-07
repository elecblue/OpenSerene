<?
// Serene Content Management System //
// Created by Atriotic, LLC //
// Written in PHP (php.net) and uses the MySQL Database Server //
// Free for Non-Profit use  //

// config.inc.php -- This file is required! //

//Edit this page with your MySQL information. 
$host = "localhost:3306"; // Probably correct.
$username = "root";
$database = "serenedev";
$password = "root";

//Install Admin Account Information FILL OUT BEFORE INSTALL!
$adminuser = "nik";
$adminpass = "opensesame";
$adminemail = "nbmatt+test@gmail.com";

// IGNORE
$getcwd = getcwd();

//Edit this part with your site information. Replace Example Information
$siteName = "SereneCMS";
$siteSlogan = "This Is A Test Slogan";
$siteAddress = "http://localhost:80/OpenSerene"; // Where the CMS is intalled.
$sitePath = "$getcwd"; // Local Path to Installation
$siteEmail = "dev@vicegirls.us";
$siteCopyright = "VICEGIRLS & CO";

//CMS Options
$wysiwyg = "true"; 	// True determines whether the visual editor is on. True for on, false for off. Defaults to on. (The editor isn't suggested if your admin panel is lagging).
$uploadOpt = "false";  	//This allows users to upload user option files to your server for their use. This feature has yet to be implimented so it defaults as false.
$commentOpt = "false";	//This allows users to comment on stories. This feature has yet to be implimented and it defaults as false.

$cms['version'] = "0.9.5c";

?>
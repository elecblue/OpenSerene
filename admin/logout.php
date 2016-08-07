<?

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/logout.php
	
*/

session_start();

$_SESSION = array();

header("Location: index.php");
?>
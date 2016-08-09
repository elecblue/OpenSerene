<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: news.php
	
*/

require("engine/config.inc.php");
require("engine/function.inc.php");

include("engine/dbconnect.php"); 
include("cache/skin/header.php");


if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
} 
$max_results = 2; 
$from = (($page * $max_results) - $max_results); 

$getnews = mysql_query("SELECT * FROM stories ORDER BY id DESC LIMIT $from, $max_results");

echo("<h2>".$siteName."</h2>");

while($r=mysql_fetch_array($getnews)){
extract($r);
	echo("
	<b>".nl2br_skip_html($title)."</b> - added on $date - posted by $user
	<p>". nl2br_skip_html($message) ."</p>
	");
}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM stories"),0);
$total_pages = ceil($total_results / $max_results); 

echo "<div id=\"editbutton\">";

if($page > 1){
    $prev = ($page - 1);
    echo "<a href=\"news.php?page=$prev\">&laquo Prev</a> ";
} 
for($i = 1; $i <= $total_pages; $i++){
    if(($page) == $i){
        echo "$i ";
        } else {
            echo "<a href=\"news.php?page=$i\">$i</a> ";
    }
} 
if($page < $total_pages){
    $next = ($page + 1);
    echo "<a href=\"news.php?page=$next\">Next &raquo</a>";
} 

echo "</div>";

include("cache/skin/footer.php");

?>
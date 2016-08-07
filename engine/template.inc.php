<?php

// SereneCMS Templating Engine
// Simple, simple, simple!
// Atriotic, LLC

# Header Function
function serene_header() {
	$baseQuery = mysql_query("SELECT * FROM settings");
	$fArray = mysql_fetch_array($baseQuery);
	$siteName = $fArray['title'];
	echo "$siteName";
}

function serene_siteurl() {
	$baseQuery = mysql_query("SELECT * FROM settings");
	$fArray = mysql_fetch_array($baseQuery);
	$siteURL = $fArray['siteurl'];
	echo "$siteURL";
}

function serene_post($tag1,$tag2) {
	$getnews = mysql_query("SELECT * FROM stories ORDER BY id DESC LIMIT 8");
	while($r=mysql_fetch_array($getnews)){
	extract($r);
	echo "<$tag1>".nl2br_skip_html($title)."</$tag1> - added on $date - posted by $user \n<$tag2>". nl2br_skip_html($message) ."</$tag2>";
	}
}

function serene_meta() {
	$baseQuery = mysql_query("SELECT * FROM settings");
	$fArray = mysql_fetch_array($baseQuery);
	$cDesc = $fArray['descript'];
	$cKey = $fArray['keywords'];
	$cAuthor = $fArray['author'];
	$cDate = date("j-M-Y");
	echo "<!-- Meta Tags -->\n\t";
	echo "<meta name=\"author\" content=\"$cAuthor\" />\n\t";
	echo "<meta name=\"keywords\" content=\"$cKey\" />\n\t";
	echo "<meta name=\"description\" content=\"$cDesc\" />\n\t";
	echo "<meta name=\"generator\" content=\"SereneCMS\" />\n\t";
	echo "<meta name=\"date\" content=\"$cDate\" />\n\t";
	echo "<!-- / -->\n";
}

function serene_links() {
	$gLinks = mysql_query("SELECT * FROM links ORDER BY id ASC");
	$lArray = mysql_fetch_array($gLinks);
	foreach($lArray as $link) {
		echo "<a href=\"".$link['url']."\" title=\"".$link['title']."\">".$link['name']."</a>";
	}
}
<html>
<head>
<title>Instagram</title>
</head>
<body>
<?php

//returns a big old hunk of JSON from a non-private IG account page.
function scrape_insta($username) {
	$insta_source = file_get_contents('http://instagram.com/'.$username);
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]); 
	$insta_array = json_decode($insta_json[0], TRUE);
	return $insta_array;
}

//Supply a username
if(isset($_GET["name"])) {
	$my_account = $_GET["name"]; 
} else {
	$my_account = 'cosmocatalano'; 
}

//Do the deed
$results_array = scrape_insta($my_account);
//An example of where to go from there

foreach ($results_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] as $node) {
	echo "<div class='node'>";
	echo "<span class='id'>".$node['id']."</span>";
	echo "<span class='code'>".$node['code']."</span>";
	echo "<span class='date'>".$node['date']."</span>";
	echo "<span class='caption'>".$node['caption']."</span>";
	echo "<span class='display'>".$node['display_src']."</span>";
	echo "</div>";
}
	
?>
</body>
</html>

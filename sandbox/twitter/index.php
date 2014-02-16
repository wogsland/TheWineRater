
<?PHP  
include_once('myatomparser.php'); 
include_once('twitter.php');

if (isset($_POST['submit'])) {

	$url = "http://search.twitter.com/search.atom?q=".$_POST['search_term']."&rpp=100";
	$atom_parser = new myAtomParser($url); 
	$new_authors = $atom_parser->getNAuthors($_POST['num_tweets']); 

	$num_tweets = $_POST['num_tweets']; 
	while ($num_tweets > 0){
		$num_tweets = $num_tweets - 1;
		$twitter_status = "\@".$new_authors[$num_tweets]." ".$_POST['twitter_stat'];
		if (strlen($twitter_status) > 0) {
			$curTwitter = new twitter("thewinerater", "smelly4t");
			if( $curTwitter->setStatus($twitter_status) != true)
				echo "<p>Twitter is unavailable at this time</p>";
		} else
			echo "<p>Error: I won't send blank messages!</p>";
		sleep(5);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Twitter Marketing Demo</title>
</head>
<body>
	<h2>Twitter Marketing</h2>

<p><strong>Enter Values:</strong></p>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Search Term:<br>
		<input name="search_term" type="text" id="search_term" size="40" maxlength="140" /><p>
            Number of Tweets to send <br>
		<input name="num_tweets" type="text" id="num_tweets" size="3" maxlength="3" /><p>
            Message:<br>
		<input name="twitter_stat" type="text" id="twitter_stat" size="40" maxlength="120" /><p>
		<input type="submit" name="submit" id="submit" value="Send"/>
	</form>

<p>
See the 
<a href="http://twitter.com/thewinerater" target=BS>profile output</a>.
</p>
<div id="twitter_div">
<h2 class="sidebar-title">Recent Tweets</h2>
<ul id="twitter_update_list"></ul>
</div>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/thewinerater.json?callback=twitterCallback2&amp;count=10"></script>
<p><br>
<p><br>
<p><br>
<p><br>
<p><br>
<p>
<HR>
<!-- ------------------------------------------------------------- -->
<center>
<H5>
<P>
Last Modified: 13 April 2009 by <a href="mailto: bradley@wogsland.org"> Bradley James Wogsland</a>.<br>
Copyright 2009 <a href="http://wogsland.org/bradley">Bradley James Wogsland</a>.
</H5>

<p><br><p>
 
</BODY>
</HTML>

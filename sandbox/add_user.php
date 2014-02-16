<?php

#header stuph
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\n";
print "              \"http://www.w3.org/TR/html401/loose.dtd\">\n";
print "<html>\n";
print "<head>\n";
print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
print "\n";
print "<title> TheWineRater.com - Become a Rater!";
print "</head> \n";

print "<body bgcolor=\"#ffffff\">\n";
print "<img src=\"../images/logo.gif\">\n";
print "<table><tr><td valign=top width=180>\n";
print "<iframe src =\"../links.html\" width=\"100%\" height=400>\n";
print "</iframe>\n";
print "<td>\n";
print "\n";
print "<table><tr><td valign=top width=600>\n";
print "<P>\n";
print "<p>\n";


// Connect to database
$hostname = "mysql123.hosting.earthlink.net";
$username = "the_raters";
$password = "ataturk";
$dbname = "the_raters";
$usertable = "user_information";

mysql_connect($hostname, $username, $password) or DIE("Unable to connect to MySQL server $hostname");
#print "Connected to MySQL server<br>";

$selected = mysql_select_db($dbname) or DIE("Could not select requested db $dbname");
#print "Connected to database $dbname<br>";


$testusername = 'SELECT `username` FROM `user_information` WHERE `username` LIKE CONVERT(_utf8 \''.$_POST["name"].'\' USING latin1) COLLATE latin1_swedish_ci';
echo $testusername."<P>";
$usernameresult = mysql_query($testusername) or DIE("Could not Execute Query on table $usertable");
echo $usernameresult;

if ($_POST["age"]<150){
#do stuph
}else{
#tell 'em to try again
}

/*
$query = 'INSERT INTO `user_information` (`username`, `password`, `about`, `locale`, `email`, `age`, `temp4`, `temp5`, `temp6`, `temp7`, `temp8`, `temp9`, `temp10`, `temp11`, `temp12`, `temp13`, `temp14`, `temp15`, `temp16`, `temp17`) VALUES (\''.$_POST["name"].'\', \''.$_POST["password"].'\', \''.$_POST["about"].'\', \''.$_POST["locale"].'\', \''.$_POST["email"].'\', \''.$_POST["age"].'\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\', \'none\');';

$result = mysql_query($query) or DIE("Could not Execute Query on table $usertable");

# for testing purposes
#echo $query;
#echo $result;

if($result){
	print "Welcome to TheWineRater, ".$_POST["name"]."!<p>";
 	print "You can visit your homepage or <a href=\"../vinyards/index.html\">start rating</a>.<p>";
}else{
	print "Add new user failed. <a href=\"add_user.html\">Try again</a>.<p>";
}
*/

mysql_close;

#Google stuph
print " <td valign=top>\n";
print "<script type=\"text/javascript\"><!--\n";
print "google_ad_client = \"pub-7854718838870175\";\n";
print "google_ad_width = 120;\n";
print "google_ad_height = 600;\n";
print "google_ad_format = \"120x600_as\";\n";
print "google_ad_type = \"text_image\";\n";
print "//2006-10-31: www.TheWineRater.com\n";
print "google_ad_channel = \"0729782333\";\n";
print "//--></script>\n";
print "\n";
print "<script type=\"text/javascript\"\n";
print "  src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
print "</script> \n";


#Ending stuph
print "</table> \n";
print "</table>\n";
print "<p>\n";
print "<!-- ------------------------------------------------------------- -->\n";
print "<hr>\n";
print "<iframe src =\"../copyright.html\" width=\"100%\" height=100 frameborder=0>\n";
print "</iframe>\n";
print " \n";
print "</body>\n";
print "</html>\n";


?>
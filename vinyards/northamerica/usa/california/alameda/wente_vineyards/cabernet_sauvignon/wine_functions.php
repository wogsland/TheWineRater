
<?php

function wineratings($winecode){

#header stuph
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\n";
print "              \"http://www.w3.org/TR/html401/loose.dtd\">\n";
print "<html>\n";
print "<head>\n";
print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
print "\n";
print "</head> \n";

print "<body>\n";

// Connect to database
$hostname = "mysql123.hosting.earthlink.net";
$username = "california";
$password = "bonjovi";
$dbname = "california";
$usertable = $winecode;

mysql_connect($hostname, $username, $password) or DIE("Unable to connect to MySQL server $hostname");
#print "Connected to MySQL server<br>";

$selected = mysql_select_db($dbname) or DIE("Could not select requested db $dbname");
#print "Connected to database $dbname<br>";


$query = 

$result = mysql_query($query) or DIE("Could not Execute Query on table $usertable");

# for testing purposes
#echo $query;
#echo $result;

if($result){
	
}else{
	print "failed<p>";
}


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
*/
print "</body>\n";
print "</html>\n";

}#wineratings

?>
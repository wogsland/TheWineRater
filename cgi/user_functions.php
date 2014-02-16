<?php

function GetUserData(){
// Connect to database
$hostname = "mysql123.hosting.earthlink.net";
$username = "the_raters";
$password = "ataturk";
$dbname = "the_raters";
$usertable = "user_information";
$yourfield = "username";
$yourfield2 = "about";

mysql_connect($hostname, $username, $password) or DIE("Unable to connect to MySQL server $hostname");
#print "Connected to MySQL server<br>";
$selected = mysql_select_db($dbname) or DIE("Could not select requested db $dbname");

#print "Connected to database $dbname<br>";

$query = "SELECT * FROM $usertable";
$result = mysql_query($query) or DIE("Could not Execute Query on table $usertable");
if ($result) {

    while ($row = mysql_fetch_array($result)) {
        print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\n";
        print "                      \"http://www.w3.org/TR/html401/loose.dtd\">\n";
        print "<html>\n";
        print "<head>\n";
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
        print "\n";
        print "  <title> TheWineRater.com - ".$row{$yourfield}."</title>\n";
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
        print "<b>".$row{$yourfield}."</b><p>";
        print "About me: ".$row{$yourfield2}." <p>";
        }
    print "My Ratings:<br>";
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
print "</body>\n";
print "</html>\n";
}#GetUserData

?>
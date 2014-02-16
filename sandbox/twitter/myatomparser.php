<?PHP  
/* 
 Original PHP code by Chirp Internet: www.chirp.com.au 
 Please acknowledge use of this code by including this header. 

 Updated by Bradley J. Wogsland 20090406
*/

class myAtomParser { 

/* --------------------- Variables --------------------------- */

  /* keeps track of current and preceding elements */
  private $tags = array(); 

  /* array containing all feed data */
  private $output = array(); 

  /* return value for display functions */
  private $retval = ""; 

  private $encoding = array(); 

  private $debug=False;

/* ----------------- Constructor/Destructor ----------------------- */

  /* constructor for new object */
  public function __construct($file) { 

    if($this->debug) {echo "in constructor<br>";}
    if($this->debug) {echo "file: $file<br>";}

    /* instantiate xml-parser and assign event handlers */
    $xml_parser = xml_parser_create(""); 
    xml_set_object($xml_parser, $this); 
    xml_set_element_handler($xml_parser, "startElement", "endElement"); 
    xml_set_character_data_handler($xml_parser, "parseData"); 

    /* open file for reading and send data to xml-parser */
    $fp = @fopen($file, "r") or die("<b>myAtomParser Error:</b> Could not open URL $file for input"); 
    while($data = fread($fp, 4096)) { 
      xml_parse($xml_parser, $data, feof($fp)) or die( sprintf("myAtomParser: Error <b>%s</b> at line <b>%d</b><br>", xml_error_string(xml_get_error_code($xml_parser)), xml_get_current_line_number($xml_parser)) ); 
    } 
    fclose($fp); 

    /* dismiss xml parser */
    xml_parser_free($xml_parser); 

    if($this->debug) {echo "construction complete<br>";}
  } 

  /* destructor*/
  public function __destruct() {
    /*clean Up */
    if($this->debug) {echo "in destructor - bye, bye!<br>";}
    curl_close($this->ch);
  }

/* ----------------- Get/Set Functions ----------------------- */

  /* display entire feed as HTML */
  public function getOutput($limit=false, $output_encoding='UTF-8') {
    if($this->debug) {echo "in getOutput function<br>";}
    $this->retval = ""; 
    $start_tag = key($this->output);
    switch($start_tag) {
      case "FEED":
        foreach($this->output as $feed) $this->display_feed($feed, $limit);
        break; 
      default:
        die("Error: unrecognized start tag '$start_tag' in getOutput()"); 
    } 
    if($this->debug) {echo "completed getOutput function, about to return by calling fixEncoding<br>";}
    if($this->debug) {echo "retval: $this->retval<br>";}
    if($this->debug) {echo "output encoding: $output_encoding<br>";}
    return $this->fixEncoding($this->retval, $output_encoding); 
  } 

  /* return raw data as array */
  public function getRawOutput($output_encoding='UTF-8') { 
    return $this->fixEncoding($this->output, $output_encoding); 
  } 

  /* return the newest author of a tweet */
  public function getNewestAuthor(){
    if($this->debug) {echo "in getNewestAuthor function<br>";}
    $this->retval = ""; 
    $start_tag = key($this->output);
    switch($start_tag) {
      case "FEED":
        foreach($this->output as $feed){
          extract($feed); 
          if($ENTRY){
            foreach($ENTRY as $item) { 
              extract($item); 
              if($AUTHOR) {
                if($this->debug) {echo "in getNewestAuthor author loop<br>";}
                $gotten_author_temp = $AUTHOR['NAME']; 
                list($gotten_author,$junk) = split(" ",$gotten_author_temp,2); 
                if($this->debug) {echo "gotten_author: $gotten_author<br>";}
                $this->retval .= $gotten_author; 
                if($this->debug) {echo "time to break<br>";}
                break; 
              }
            }
          }
        }
        break; 
      default:
        die("Error: unrecognized start tag '$start_tag' in getNewestAuthor"); 
    }
    return $this->retval;
  }

  /* return the newest n authors of tweets */
  public function getNAuthors($numAuthors){
    if($this->debug) {echo "in getNAuthors function<br>";}
    $this->retval = array(); 
    $start_tag = key($this->output);
    switch($start_tag) {
      case "FEED":
        foreach($this->output as $feed){
          extract($feed); 
          if($ENTRY){
            foreach($ENTRY as $item) { 
              extract($item);
              if($AUTHOR && $numAuthors > 0) {
                if($this->debug) {echo "in getNAuthors author loop<br>";}
                $gotten_author_temp = $AUTHOR['NAME']; 
                list($gotten_author,$junk) = split(" ",$gotten_author_temp,2); 
                if($this->debug) {echo "gotten_author: $gotten_author<br>";}
                $numAuthors = $numAuthors - 1;
                $this->retval[$numAuthors] .= $gotten_author; 
              }
            }
          if($this->debug) {echo "time to break<br>";}
          break;
          }
        }
        break; 
      default:
        die("Error: unrecognized start tag '$start_tag' in getNewestAuthor"); 
    }
    return $this->retval;
  }

/* ----------------- Helper Functions ----------------------- */

  private function startElement($parser, $tagname, $attrs) { 
    if($this->encoding) { 
      /* content is encoded - so keep elements intact */
      $tmpdata = "<$tagname"; 
      if($attrs) foreach($attrs as $key => $val) $tmpdata .= " $key=\"$val\""; 
      $tmpdata .= ">"; 
      $this->parseData($parser, $tmpdata); 
    } else { 
      if($attrs['HREF'] && $attrs['REL'] && $attrs['REL'] == 'alternate') { 
        $this->startElement($parser, 'LINK', array()); 
        $this->parseData($parser, $attrs['HREF']); 
        $this->endElement($parser, 'LINK'); 
      } 
      if($attrs['TYPE']) $this->encoding[$tagname] = $attrs['TYPE']; 
      /* check if this element can contain others - list may be edited */
      if(preg_match("/^(FEED|ENTRY)$/", $tagname)) { 
        if($this->tags) { 
          $depth = count($this->tags); 
          list($parent, $num) = each($tmp = end($this->tags)); 
          if($parent) $this->tags[$depth-1][$parent][$tagname]++; 
        } 
        array_push($this->tags, array($tagname => array()));
      } else { 
        /* add tag to tags array */
        array_push($this->tags, $tagname); 
      }
    }
  } 

  private function endElement($parser, $tagname) { 
    /* remove tag from tags array */
    if($this->encoding) { 
      if(isset($this->encoding[$tagname])) { 
        unset($this->encoding[$tagname]); 
        array_pop($this->tags); 
      } else { 
        if(!preg_match("/(BR|IMG)/", $tagname)) $this->parseData($parser, "</$tagname>"); 
      } 
    } else { 
      array_pop($this->tags); 
    }
  } 

  private function parseData($parser, $data) { 
    /* return if data contains no text */
    if(!trim($data)) return; 
    $evalcode = "\$this->output"; 
    foreach($this->tags as $tag) { 
      if(is_array($tag)) { 
        list($tagname, $indexes) = each($tag); 
        $evalcode .= "[\"$tagname\"]"; 
        if(${$tagname}) $evalcode .= "[" . (${$tagname} - 1) . "]"; 
        if($indexes) extract($indexes); 
      } else { 
        if(preg_match("/^([A-Z]+):([A-Z]+)$/", $tag, $matches)) { 
          $evalcode .= "[\"$matches[1]\"][\"$matches[2]\"]"; 
        } else { 
          $evalcode .= "[\"$tag\"]"; 
        }
      }
    } 
    if(isset($this->encoding['CONTENT']) && $this->encoding['CONTENT'] == "text/plain") { 
      $data = "<pre>$data</pre>"; 
    } 
    eval("$evalcode .= '" . addslashes($data) . "';"); 
  } 

  /* display a single feed as HTML */
  private function display_feed($data, $limit) { 
    extract($data); 
    if($TITLE) { 
      /* display feed information */
      $this->retval .= "<h1>"; 
      if($LINK) $this->retval .= "<a href=\"$LINK\" target=\"_blank\">"; 
      $this->retval .= stripslashes($TITLE); 
      if($LINK) $this->retval .= "</a>";
      $this->retval .= "</h1>\n";
      if($TAGLINE) $this->retval .= "<P>" . stripslashes($TAGLINE) . "</P>\n\n";
      $this->retval .= "<div class=\"divider\"><!-- --></div>\n\n";
    } 
    if($ENTRY) { 
      /* display feed entry(s) */
      foreach($ENTRY as $item) { 
        $this->display_entry($item, "FEED"); 
        if(is_int($limit) && --$limit <= 0) break; 
      }
    }
  } 

  /* display a single entry as HTML */
  private function display_entry($data, $parent) { 
    extract($data); 
    if(!$TITLE) return; 
    $this->retval .= "<p><b>";
    if($LINK) $this->retval .= "<a href=\"$LINK\" target=\"_blank\">";
    $this->retval .= stripslashes($TITLE);
    if($LINK) $this->retval .= "</a>";
    $this->retval .= "</b>";
    if($ISSUED) $this->retval .= " <small>($ISSUED)</small>";
    $this->retval .= "</p>\n";
    if($AUTHOR) {
      $this->retval .= "<P><b>Author:</b> " . stripslashes($AUTHOR['NAME']) . "</P>\n\n"; 
    }
    if($CONTENT) {
      $this->retval .= "<P>" . stripslashes($CONTENT) . "</P>\n\n";
    } elseif($SUMMARY) {
      $this->retval .= "<P>" . stripslashes($SUMMARY) . "</P>\n\n";
    }
  } 

  private function fixEncoding($input, $output_encoding) { 
    if($this->debug) {echo "in fixEncoding function<br>";}
    /*$encoding = mb_detect_encoding($input);*/
    $encoding = $output_encoding;
    if($this->debug) {echo "encoding: $encoding<br>";}
    switch($encoding) {
      case 'ASCII': case $output_encoding: return $input;
      case '': return mb_convert_encoding($input, $output_encoding);
      default: return mb_convert_encoding($input, $output_encoding, $encoding); 
    }
  } 

} ?> 
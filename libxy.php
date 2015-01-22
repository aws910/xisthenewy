<?php

//Interface to define planned implementation of class
interface ipage {
  public function init();
  public function fetchPage($url);
  public function rewriteLinks();
  public function replaceWords($search, $replace);
  public function getHTML();
}

//Class implementation
class renderedPage implements ipage{
  private $debug_text = '';

  public function init(){
    print 'initializing<br>';
  }  

  public function fetchPage($url){
    print 'fetching ' . $url . '<br>';
  }

  public function rewriteLinks(){
    print 'rewriting links<br>';
  }

  public function replaceWords($search, $replace){
    print 'replacing words<br>';
  }

  public function getHTML(){
    print 'here it comes<br>';
  }

  public function renderedPage($url){
    print '!!' . $url;
  }
}


$x = new renderedPage(5);

// old code, being refactored from procedural to OOP

/*	
$time_start = microtime(true);

error_reporting(E_ALL);
if(!function_exists('curl_version')){
  die("Error: curl is not installed/enabled\n");
}

// Get the debug flag
if (isset($_GET['dbg']) && $_GET['dbg'] == 1){
  $dbg = 1;
  echo 'beginning execution<br>';
} else {
  $dbg = 0;
}

// master variables that have to be hardcoded at this time
$default_page = 'http://news.google.com';
$my_base_url = 'http://aws910.com/turntable.php';
$debug_text = '';

// The master list of find and replace pairs.
// Starting with an associative array for now, for easier encoding.  

$replace_pattern=array(
'magazine'=>'rutabega',
);
//  Thread original array out into an preg_replace-friendly set of search and replace arrays.
$search = array();
$replace = array();
foreach($replace_pattern as $term=>$substitute){
  $search[] = '/' . $term . '/';
  $replace[] = $substitute;
}
// Read the input url into a variable
$url = isset($_GET['url']) ? $_GET['url'] : $default_page;
$url_parts = parse_url($url);

// Get the requested page and store it as $data
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR,true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
$raw_source = curl_exec($ch);
if (sizeof($raw_source) == 1){
  $debug_text .= 'cUrl returned bad data, length=' . sizeof($raw_source);
  $debug_text .= ' (errno ' . curl_errno($ch) . ')';
  $debug_text .= ': ' . curl_error($ch) . '<br>';
  $debug_text .= 'my best guess is that ' . $url_parts['host'] . ' doesnt like us<br>';  
}
curl_close($ch);

//convert encoding if we can, otherwise output won't be very pretty
if (function_exists('mb_convert_encoding')){
  $mb_source = mb_convert_encoding($raw_source, 'HTML-ENTITIES', "UTF-8");
} else {
  $mb_source = $raw_source;
}

//Step 1: "threading" the links back through this server
//In this section, we get all links on the page and rewrite them
// in such a way that the data goes through the server. 

$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
$threaded_source = preg_replace_callback(
  "/$regexp/siU",
  function($match) use($url_parts, $dbg, $my_base_url){
    // Anonymous regex callback function
    //   Every time the regex engine hits a match, this function is called
    //   Parameters: $match - variable containing all regex match parts, in an array
    //   Returns: New href to substitute in place of the link
    //           (all <a> attributes other than "href" are discarded)
    //   The purpose of this function is to rewrite all links on a page 
    //    so that they are fed back through this script. 
    

    //make sure the link is fully qualified...
    if(substr($match[2],0,4) != 'http'){
      //take *that*, you relative link!
      $qualified_link = $url_parts['scheme'] . '://' . $url_parts['host'] . $match[2];
    } else {
      //link is already fully qualified
      $qualified_link = $match[2];
    }
    //build the final link
    $final_href = $my_base_url . '?url=' . $qualified_link;
    $final_link = '<a href="' . $final_href . '">' . $match[3] . '</a>';
    //build debug information if required
    if ($dbg == 1){
      global $debug_text;
      $debug_text .= 'orig.link: ' . htmlentities($match[0]) . '<br>';
      $debug_text .= 'q.link ' . htmlentities($qualified_link) . '<br>';
      $debug_text .= 'final.href: ' . htmlentities($final_href) . '<br>';
      $debug_text .= 'final link(code): ' . htmlentities($final_link) . '<br>';
      $debug_text .= 'final link(as seen in body):' . $final_link . '<hr>';
    }
    return $final_link;
  }, 
  $mb_source
);

// Giving up on domdocument for now.  Too complicated, too slow.
// DOMDocument complains worse than a vegan in a steakhouse!
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); 
//$threaded_doc = new DOMDocument();
//$threaded_doc->loadHTML($threaded_source);
//print $threaded_doc->saveHTML();


// A plain old preg_replace will have to do for now, but it works
$final_source = preg_replace($search, $replace, $threaded_source);

print $final_source;

if ($dbg == 1){
  $time_end = microtime(true);
  print 'Execution finished in ' . round(($time_end - $time_start),6) . ' seconds.<br>';
  print 'debug info: <br>';
  print 'search/replace pattern:<br>';
  print_r($search);
  print_r($replace);
  print 'url replacement logic:<br>';
  print $debug_text;
}
*/
?>

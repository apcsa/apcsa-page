<?php 
///// some values used below
$extension = ".body";
$help_dir = "help";
$unknown_topic_definition = "__UNKNOWN_TOPIC";
$start_page_intro = "__START_PAGE_INTRO";

$fixed_pages = array("Installation" => "installation.html", 
					 "About this course" => "about.html",
					 "Configure BlueJ" => "configure_bluej.php");

////// process the files, etc.

if (array_key_exists('index', $_REQUEST)) {
    $index = $_REQUEST['index'];
} else {
    $index = false;
}
if (array_key_exists('topic', $_REQUEST)) {
    $topic = $_REQUEST['topic'];
} else {
    $topic = false;
}

// Get list of help files
// this probably shouldn't happen every time.  Rather, an index
//   should be pregenerated.
// note, no check for evilness in the file...
$files = scandir($help_dir);
// remove files not ending in $extension
$files = array_filter($files, "ends_in_extension");
function ends_in_extension($f) {
    // returns true if $f ends in $extension
    global $extension;
    $len = strlen($extension);
    return ($extension == substr($f, ($len * -1), $len));
}
// put english string in array keys
// right now, english is used both in link text as well as in url (i.e., help.php?topic=$key ) --
//  maybe should separate this out, eh?
$keys = array_map("make_english", $files);
$files = array_combine($keys, $files);
//echo "<pre>";print_r($files);echo"</pre>";
function make_english($f) {
    $tmp = str_replace("_", " ", $f);
    $tmp = (substr($tmp, 0, (strlen($tmp) - 5)));
    $tmp = capitalize_it($tmp);
    return($tmp);
}

function capitalize_it($str) {
	// special words?
	$str = str_replace("bluej", "BlueJ", $str);
	
	// capitalize first word?
	//if (strcasecmp($str, "w00t") != 0) {
	     $str = ucfirst($str);
	//}
	
	return $str;

}


// add in fixed pages and resort
$files = array_merge($files, $fixed_pages);
ksort($files);

if (($index != false) || (($index == false) && ($topic == false))) {
    // requesting an index
    
    $topic = false; // ignore topic when both are requested, hey
    if ($index == false) {
        // no index (and no topic, or we wouldn't be here) means start page
        $index = "start";
    }
    $index = strtolower($index);

    
}
else {
    // requesting a topic
    
    // turn spaces into underscores in name
    $file = str_replace(" ", "_", strtolower($topic)).$extension;
    if (in_array($file, $files)) {
        $definition = file_get_contents($help_dir."/".$file);
    } else {
        $definition = file_get_contents($help_dir."/".$unknown_topic_definition);
    }
}


include_once "header.php";
?>
<div id="helpHeader">
   <img src="static/art/graphics/helpicon22.png">
   <div id="course">
      Level-Up Computer Science: Advanced Placement Computer Science A
   </div>
   <div id="title">
      Help Guide
   </div>
</div>
<div id="help_index">
   <?php write_index(); ?>
</div>
<div class="topic">
   <?php write_topic_header(); ?>
</div>
<div class="definition">
   <?php write_topic_definition(); ?>
</div>
<?php 
include_once "footer.php";

function write_index() {
    global $index,$start_page_intro,$help_dir,$files;
    //write_index_bar();
    
    if (($index == "all") || ($index == "start")) {
        if ($index == "start") {
            echo(file_get_contents($help_dir."/".$start_page_intro));
        }
        echo "<ul>\n";
        foreach ($files as $name=>$f) {
        	if (ends_in_extension($f)) {
        		echo "<li> <a href=\"help.php?topic=$name\">";
        	} else {
        		echo "<li> <a href=\"" . $help_dir . "/" . $f . "\"> ";   		
        	}
        	echo "$name</a></li>\n";     
        }
        echo "</ul>";
    }
}


function write_index_bar() {
    global $index;
    echo "<div class=\"indexBar\">\n";
    echo "<em>This page's layout and functionality is under construction</em><br>\n";
    echo "
<div id=\"navBar\"><a href=\"\">index</a> | <a href=\"\">A</a> | 
<a href=\"\">B</a> | <a href=\"\">C</a> | <a href=\"\">D</a> | 
<a href=\"\">E</a> | <a href=\"\">F</a> | <a href=\"\">G</a> | <a href=\"\">H</a> | 
<a href=\"\">I</a> | <a href=\"\">J</a> | <a href=\"\">K</a> | <a href=\"\">L</a> | 
<a href=\"\">M</a> | <a href=\"\">N</a> | <a href=\"\">O</a> | <a href=\"\">P</a> | 
<a href=\"\">QR</a> | <a href=\"\">S</a> | <a href=\"\">T</a> | <a href=\"\">U</a> | 
<a href=\"\">WX</a> | <a href=\"\">YZ</a> 
</div>
	";
    echo "</div>";
    
}


function write_topic_header() {
    global $topic;
    if ($topic !== false) {
        $english_topic = str_replace("_", " ", strtolower($topic));
        echo "<em>Topic:</em> $english_topic";
    }
}


function write_topic_definition() {
    global $topic,$definition;
    if ($topic !== false) {
        // write out the definition from the help/X.body file
        echo $definition;
    }
}

?>

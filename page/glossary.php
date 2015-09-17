<?php 
///// some values used below
$extension = ".body";
$glossary_dir = "glossary";
$unknown_term_definition = "__UNKNOWN_TERM";
$start_page_intro = "__START_PAGE_INTRO";

////// process the files, etc.
if (array_key_exists('index', $_REQUEST)) {
    $index = $_REQUEST['index'];
} else {
    $index = false;
}
if (array_key_exists('term', $_REQUEST)) {
    $term = $_REQUEST['term'];
} else {
    $term = false;
}

// Get list of glossary files
// this probably shouldn't happen every time.  Rather, an index
//   should be pregenerated.
// note, no check for evilness in the file...
$files = scandir($glossary_dir);
// remove files not ending in $extension
$files = array_filter($files, "ends_in_extension");
function ends_in_extension($f) {
    // returns true if $f ends in $extension
    global $extension;
    $len = strlen($extension);
    return ($extension == substr($f, ($len * -1), $len));
}
// put english string in array keys
// right now, english is used both in link text as well as in url (i.e., glossary.php?term=$key ) --
//  maybe should separate this out, eh?
$keys = array_map("make_english", $files);
$files = array_combine($keys, $files);
//echo "<pre>";print_r($files);echo"</pre>";
function make_english($f) {
    $tmp = str_replace("_", " ", $f);
    $tmp = (substr($tmp, 0, (strlen($tmp) - 5)));
    $tmp = capitalize_it($tmp);   // capitalize first char
    // capitalize bluej?
    
    return($tmp);
}

function capitalize_it($str) {
	// special words?
	//$str = str_replace("bluej", "BlueJ", $str);
	
	// strcasecmp(str1, str2)
	// capitalize first word?
	if (strcasecmp($str, "w00t") != 0) {
		$str = ucfirst($str);
	}
	
	return $str;

}

if (($index != false) || (($index == false) && ($term == false))) {
    // requesting an index
    
    $term = false; // ignore term when both are requested, hey
    if ($index == false) {
        // no index (and no term, or we wouldn't be here) means start page
        $index = "start";
    }
    $index = strtolower($index);
}
else {
    // requesting a term
    
    // turn spaces into underscores in name
    
    $file = str_replace(" ", "_", strtolower($term)).$extension;
    if (in_array($file, $files)) {
        $definition = file_get_contents($glossary_dir."/".$file);
    } else {
        $definition = file_get_contents($glossary_dir."/".$unknown_term_definition);
    }
}


include_once "header.php";
?>
<div id="glossaryHeader">
   <img src="../art/graphics/special-dictionary-32.png">
   <div id="course">
      UCCP Advanced Placement Computer Science A
   </div>
   <div id="title">
      glossary
   </div>
</div>
<div id="glossary_index">
   <?php write_index(); ?>
</div>
<div class="term">
   <?php write_term_header(); ?>
</div>
<div class="definition">
   <?php write_term_definition(); ?>
</div>
<?php 
include_once "footer.php";

function write_index() {
    global $index,$start_page_intro,$glossary_dir,$files;
    // write_index_bar();
    
    if (($index == "all") || ($index == "start")) {
        if ($index == "start") {
            echo(file_get_contents($glossary_dir."/".$start_page_intro));
        }
        echo "<ul>\n";
        foreach ($files as $name=>$f) {
            echo "<li> <a href=\"glossary.php?term=$name\">";
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


function write_term_header() {
    global $term;
    if ($term !== false) {
        $english_term = str_replace("_", " ", strtolower($term));
        echo "<em>Term:</em> $english_term \n";
    }
}


function write_term_definition() {
    global $term,$definition;

    if ($term !== false) {
        // write out the definition from the glossary/X.body file
        echo $definition;
    }
}

?>

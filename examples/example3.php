<?php
//$hh =  set_include_path(get_include_path() . PATH_SEPARATOR . '../library/');
//echo $hh;
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
 
 /*function __autoload($className){

require_once 'llcore/library/'.$className.'.php';

} */

// EXAMPLE 3  1 individual owner, and 2 definitions (ie parts of lifestyle) 2 identity sources (one owned by framework individual) each with a unique content source with 2 different content posts content per source 

try{

// settings from install or defaults in controlpanel
$individual = 1;
$identitysource = array('0'=>'1', '1'=>'2');
$startSetup = array('0' => 'wikipedia', '1' => 'rssFeedreader');
// input from UI, installation or control panel defaults
$definitionsSet = array('0' => 'skiing', '1' => 'swimming');
$contentSet[1] = array('0' => '1', '1' => '2');
$contentSet[2] = array('0' => '3', '1' => '4');
//print_r($contentSet);

// 1. LLframeworkmanager set to life inputs, identity individuals, definitions, identify content sources (& post from those sources)
$newframework = new LLframeworkmanager($individual, $identitysource, $startSetup, $definitionsSet, $contentSet);  // this must come from user via install or UI interaction i.e. default setup setup or what is selected via UI/controlpanel

// capture settings from install or current defaults
$newframework->apiStatus();

// Defintions, first time add, update, identity
$newframework->definitionControl();
//$newframework->definitionWord($definitionsSet)

// content from the universe
// input from rssfeeders or third party api service
$newframework->contentControl();


// 2-- transfer data to core
$newframework->controlCore();

echo 'FrameWork';
print_r($newframework);


/*
echo '<br /><br />';
echo "Class: " . get_class($llnew);
echo '<br /><br />';
echo "Parent class: " . get_parent_class(get_class($llnew)); 
echo '<br /><br />';
// get class name
$className = get_class($llnew);
echo '<br /><br />';

// get class properties
echo "Class properties: ";
print_r(get_class_vars($className));
echo '<br /><br />';

// get class methods
echo " Class methods: ";
print_r(get_class_methods($className));
echo '<br /><br />';

// get this instance's properties
echo " Instance properties: ";
//print_r(get_object_vars($llnew)); 
echo '<br /><br />';
*/

// LL data raw API  json, activitystream, XML, RDF etc.

// LL display design- default or select a theme


// user interacts -> feedback loop (what is feedback mechnism, outcomes?


// all the LLdiscovery engine finding new collective intelligence for the world.


}  // closes try

catch(Exception $e){

echo $e->getMessage();

exit();

} // closes err catch
?>


<html>
<head>
  <title>LifestyleLinking - open source example 1</title>
</head>
<body>

DEFINITIONS<br/>
<p>
 Def. split<br />
 <?php
 
 ?>
</p>


<p>
 Def split &amp wisdom<br />
 <?php
 
 ?>
</p>


<p>
Def. Top 50 wisdom<br />
 <?php
 
 ?>
</p>




POST<br/>
<p>
 Text split<br />
 <?php
 
 ?>
</p>


<p>
 Text split &amp tidy<br />
 <?php
 
 ?>
</p>


<p>
Top 50 text<br />
 <?php
 
 ?>
</p>



</body>
</html>

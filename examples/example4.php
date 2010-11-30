<?php
//$hh =  set_include_path(get_include_path() . PATH_SEPARATOR . '../library/');
//echo $hh;
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
 
 /*function __autoload($className){

require_once 'llcore/library/'.$className.'.php';

} */

// EXAMPLE 4  1 individual owner, and 2 definitions (ie parts of lifestyle) 2 identity sources (one owned by framework individual) each with a unique content source with 2 different content posts content per source 

try{

// INSTALL OR LIVE CONTEXT coming from the UI
// settings from install or defaults in controlpanel
$individual = 1;
$identitysource = array('1'=>'http://aboynejames.blogspot.com', '2'=>'http://lifestylelinking.blogspot.com'); //, '1'=>'2');
$startSetup = array('0' => 'wikipedia', '1' => 'rssFeedreader');
// input from UI, installation or control panel defaults
$definitionsSet = array('0' => 'Skiing', '1' => 'Swimming_(sport)');
$resultswindow = array('LLcontext'=>'auto', 'starttime'=>'unixtimestamp', 'time'=>'24', 'media'=>'blogposts');

// so this page need to picking up the start or live interactions and respond to them.

//  LLframeworkmanager set to life inputs, identity individuals, definitions, identify content sources (& post from those sources)
$newframework = new LLframeworkmanager($individual, $identitysource, $startSetup, $definitionsSet, $resultswindow);  // this must come from user via install or UI interaction i.e. default setup setup or what is selected via UI/controlpanel

// transfer data to core on a per source basis done via framework manager

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
<b>FRAMEWORK - example3.php</b> <br /><br />
<b>LIFESTYLE DEFINITIONS (wikidpedia raw)</b><br />
<p>
<b>SKIING</b><br />
<?php // echo file_get_contents('C:\apache\htdocs\llcore\text\skiingwikip.txt'); ?>
</p>

<p>
<b>SWIMMING</b><br />
<?php //echo file_get_contents('C:\apache\htdocs\llcore\text\swimmingwikip.txt'); ?>
</p>


<b>SOURCE ONE</b>
<p>
Text one: <?php// echo  file_get_contents('C:\apache\htdocs\llcore\text\skiing.txt');  // temporary data ?>
</p>
<p>
Text two: <?php //echo file_get_contents('C:\apache\htdocs\llcore\text\swimming.txt');  // temporary data ?>
</p>
<b>SOURCE TWO</b>
<p>
Text three: <?php //echo file_get_contents('C:\apache\htdocs\llcore\text\skiings2.txt'); ?>
</p>
<p>
Text four: <?php //echo file_get_contents('C:\apache\htdocs\llcore\text\swimmings2.txt'); ?>
</p>


<p>
<b>FRAMWORK OBJECT</b> Description of Framework and Core Object array structure <?php //echo file_get_contents('C:\apache\htdocs\llcore\text\arraystructures.html'); ?><br />
<?php print_r($newframework);  ?>
</p>


<p>
<b>LLCORE OBJECT</b> <br />
<?php print_r($llnew);  ?>
</p>

</body>
</html>

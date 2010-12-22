<?php
/**
 * LifestyleLinking
 *
 * Example4.php  show how the LL Framework and Core work 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Illustrates Framwork Object and Core Object structures
 *
 *
 */
//$hh =  set_include_path(get_include_path() . PATH_SEPARATOR . '../library/');
//echo $hh;
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
 
 /*function __autoload($className){

require_once 'llcore/library/'.$className.'.php';

} */

// EXAMPLE 5  restructuring class and data objects  1 individual owner, and 2 definitions (ie parts of lifestyle) 2 identity sources (one owned by framework individual) each with a unique content source with 2 different content posts content per source 

try{

// INSTALL OR LIVE CONTEXT coming from the UI
// settings from install or defaults in controlpanel 
// will change dynamically from UI or picked up automaticall e.g. display device
$startSetup = array('science'=>'singledefinition', '0' => 'wikipedia', '1' => 'rssFeedreader');
$resultspath = array('intention'=>'2', 'starttime'=>'unixtimestamp', 'timebatch'=>'24', 'media'=>'blogposts', 'make'=>'past');

$individual = 1;

//$identitydefintion = array('defword'=>'swimming', 'wikipedia'=>'swimming_(sport)', 'dpedia'=>'http://swimming_(sport).dpedia.org', 'defid'=>'1'); 
//$identitydefintion = array('defword'=>'skiing', 'wikipedia'=>'Skiing', 'dpedia'=>'http://skiing.dpedia.org', 'defid'=>''); 
$identitydefintion = array('defword'=>'Hillwalking', 'wikipedia'=>'Hillwalking', 'dpedia'=>'http://Hillwalking.dpedia.org', 'defid'=>''); 

$identitysource = array('1'=>'http://aboynejames.blogspot.com', '2'=>'http://lifestylelinking.blogspot.com'); //, '1'=>'2');

// so this page need to picking up the start or live interactions and respond to them.

//  LLframeworkmanager set to life inputs, identity individuals, definitions, identify content sources (& post from those sources)
$newframework = new LLframeworkmanager($startSetup, $resultspath, $individual, $identitydefintion, $identitysource);  // this must come from user via install or UI interaction i.e. default setup setup or what is selected via UI/controlpanel

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


<p>
<b>FRAMEWORK OBJECT</b><br />
<?php print_r($newframework);  ?>
</p>

<p>
<b>LL RESULTSPATH OBJECT</b> <br />
<?php //print_r();  ?>
</p>

<p>
<b>LLDEFINITIONS OBJECT</b> <br />
<?php //print_r();  ?>
</p>

<p>
<b>LLCONTENT OBJECT</b> <br />
<?php //print_r();  ?>
</p>


<p>
<b>LLCORE OBJECT</b> <br />
<?php //print_r($llnew);  ?>
</p>

</body>
</html>

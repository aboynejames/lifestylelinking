<?php
//$hh =  set_include_path(get_include_path() . PATH_SEPARATOR . '../library/');
//echo $hh;
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
 
 /*function __autoload($className){

require_once 'llcore/library/'.$className.'.php';

} */

//require_once 'llcore/apis/wikipedia.php';

try{

// LLframeworkmanager set to life

// Start.  First time use, update use, reuse to 3rd party use?

// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
// read in test text.
$newdef = new LLdefinitions;
//$newdef->defwikiword = 'skiing';
$newdef->definitionWord('skiing');
$newdef->buildDefinitions();
//print_r($newdef);
//echo '<br /><br />';

// 2nd core data - extract input content   api manager identifies type e.g. rss blog -> feedreader -> raw data obtained.
$inputdata = file_get_contents('C:\apache\htdocs\llcore\text\skiing.txt');
//echo $inputdata;
$newdata = new LLcontent();
$newdata->contentData($inputdata);
$newdata->buildContent();
//print_r($newdata);
//echo '<br /><br />';

// 3-- transfer data to core
// // LL goes to play
$llnew = new LLCore($newdef->cleanDefinition, $newdata->cleanContent);
//$llnew->populateArray; 
//print_r($llnew);
$llnew->createDefinitions();
echo '<br /><br />';
$llnew->createContent();

//  time to enter the matrix
echo '<br /><br />';
$llnew->createLLMatrix();

// calculate statistics
echo '<br /><br />';
$llnew->calculateLLStats();

// Perform Normalization (first create average of average ->per definition)
// first establish average of averages for the definitions
$llnew->calculateLLAvgOfAvg();

// normalize distances each identity is from a avgofavg for a definition
$llnew->calculateLLNormalisation();

// Self form LL groups
$llnew->calculateLLgroups();

// results time-context
$llnew->calculateLLresults();


echo '<br /><br />';
print_r($llnew);

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


// LL display design


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

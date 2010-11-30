<?php
/**
 * LifestyleLinking
 *
 * Checks all data coming in the Framework to ensure it is safe (as can be) 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * All input data from UI check before entering Framework
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class utility 
{
// utility class
// ie. tidy data, form relative urls, basic admin tasks









}  // closes class




// is data a integer ie. chekcing GET ids from urls address etc.
function escapeinteger ($dataget)  {

//print_r($dataget);

if (is_array($dataget) == TRUE)  {

foreach ($dataget as $dget)  {

if ( (intval($dget)) > 0  &&  (intval($dget)) <= 92)  {

$dgetclean[] = intval($dget);


} // closes if

}  // closes loop

// what if all array values are invalid?
if (count($dgetclean) > 0)  {

return $dgetclean;
}

else  {

$dataget = 1;
return $dataget;

}

}  // closes if an array received


// not an array do 
else  {

if ( (intval($dataget)) > 0  &&  (intval($dataget)) <= 92)  {

return intval($dataget);

}

else  {

// dodgy input set at 1
$dataget = 1;
return $dataget;

}

}  // closes else

//echo 'dataget'.$dataget;

}  // closes function



// takes input string data and makes safe, e.g. adding / repacing slashes and other characters
function escapestring ($dataget)  {

return AddSlashes($dataget);

}  // closes function


//  query involving LIKE need exrtra checking
function stringlike ($stringget)  {

return str_replace(array('%','_'), array('\\%', '\\_'), $stringget);


}  // closes function







function makeurl ($relurl)  
{

echo LLFOLDER . $relurl;

}  // closes function

function makeurla ($relurl)  
{

$makeurl = LLFOLDER . $relurl;

return $makeurl;

}  // closes function







?>
<?php
/**
 * LifestyleLinking
 *
 * Demo of the user interface 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Start the LL user experience 
 *
 * 
 */
// stitch together header and content.
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
require_once "LLview.php";

try{
//print_r($_SERVER);
//  LLframeworkmanager set to life inputs, identity individuals, definitions, identify content sources (& post from those sources)
$newapicall = new LLapi();
print_r($newapicall); 

}  // closes try



catch(Exception $e){

echo $e->getMessage();

exit();

} // closes err catch

?>

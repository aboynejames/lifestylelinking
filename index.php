<?php
/**
 * LifestyleLinking
 *
 * Demo of the user interface ux 
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
require_once "LLcouchdb.php";

try{

//  LLframeworkmanager set to life inputs, identity individuals, definitions, identify content sources (& post from those sources)
$newframework = new LLframeworkmanager();
print_r($newframework); 
echo 'startingmanager';
}  // closes try



catch(Exception $e){

echo $e->getMessage();

exit();

} // closes err catch

?>







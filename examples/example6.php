<?php
session_start();
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
 * The LL user experience 
 *
 * 
 */
 //define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
// echo DOCROOT;

include_once ('opensource/lifestylelinking/display/header.php');
// stitch together header and content.

$jam = $_GET['q'];
//echo $jam;
// if first time visit LLbox
if ($jam == null )
{

llheader();


} // closes

// display UI
else {

displayheader5() ;

} // closes else


?>
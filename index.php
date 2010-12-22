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
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

include_once (DOCROOT.'display/header.php');
include_once (DOCROOT.'display/llcontext.php');
// stitch together header and content.
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";

try{


      $jam = $_GET['q'];
      //echo $jam;
      // if first time visit LLbox
      if ($jam == null )
      {

      llheader();


      } // closes

      // display UI
      else
      {
          
      displayheader5() ;
  
        //  input context coming from UI or controlpanel?  assume only UI for now
      $input = $_GET['q'];
        // need to get input sanitized/check, match to wikipedia URL and form results path array to be fed into framework
        //echo $input;

      // INSTALL OR LIVE CONTEXT coming from the UI
      // settings from install or defaults in controlpanel 
      // will change dynamically from UI or picked up automaticall e.g. display device
      $startSetup = array('science'=>'singledefinition', '0' => 'wikipedia', '1' => 'rssFeedreader');
      $resultspath = array('intention'=>'1', 'starttime'=>'unixtimestamp', 'timebatch'=>'24', 'media'=>'blogposts', 'make'=>'past');

      $individual = 1;

      $identitydefintion = array('defword'=>'swimming', 'dpedia'=>''); 
      $identitysource = array('1'=>'http://aboynejames.blogspot.com', '2'=>'http://lifestylelinking.blogspot.com'); //, '1'=>'2');

      // so this page need to picking up the start or live interactions and respond to them.

      //  LLframeworkmanager set to life inputs, identity individuals, definitions, identify content sources (& post from those sources)
      $newframework = new LLframeworkmanager($startSetup, $resultspath, $individual, $identitydefintion, $identitysource);  // this must come from user via install or UI interaction i.e. default setup setup or what is selected via UI/controlpanel

      // transfer data to core on a per source basis done via framework manager

      // LL data raw API  json, activitystream, XML, RDF etc.

      // LL display design- default or select a theme

      // user interacts -> feedback loop (what is feedback mechnism, outcomes?

      // all the LLdiscovery engine finding new collective intelligence for the world.


      } // closes else


}  // closes try

catch(Exception $e){

echo $e->getMessage();

exit();

} // closes err catch

?>






<?php
/**
 * LifestyleLinking
 *
 * Use this file to store, save, update, import JSON.
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Class for managing JSON.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class LLJSON
{
  // overall management of JSON  
  

     
    /**
     * Constructor 
     *
     * JSON defaults 
     *
     * Data
     *
     * @param  int       *
     */
   public function __construct()
		{
		
 		} 
    
    
     /** Store, update, delete definitiondata
     *
     * give options, flat txt json, couchdb, mysql (and any in the future)
     *
     */
		public function storeJSONdata($defdata, $defword, $defstage)
    {
     // what storage method set,  check via framework setup
     // assume txt json for now
//echo 'store wisedef and other';
//print_r($defdata);
     $jsondef = json_encode($defdata);
      //echo $jsondef;
      
      // build a defintion file name
      $deffile = 'data/'.$defstage.$defword.'.txt';
      //echo $deffile;

      $ourFileName = $deffile;
      
      $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
      fwrite($ourFileHandle, $jsondef) or die('Could not write to file'); 
      fclose($ourFileHandle);

      
      
		}

     /** Import existing data on install or use
     *
     * give options, flat txt json, couchdb, mysql (and any in the future)
     *
     */
		public function importJSONdata($defkey, $defstage)
    {
     // what storage method set,  check via framework setup
     // assume txt json for now
         //echo 'import';
      // build a defintion file name
      $deffile = 'data/'.$defstage.$defkey.'.txt';
      //echo $deffile; 

      $ourFileName = $deffile;
      $ourFileHandle = fopen($ourFileName, 'r') or die("can't open file");
      $defdata = fread($ourFileHandle, filesize($ourFileName)) or die('Could not read file!'); 
      fclose($ourFileHandle);
      
      // decode and turn into php array
      $loadjs = json_decode($defdata, true);
   
      return $loadjs;
		}



 
}  // closes class
<?php
/**
 * LifestyleLinking
 *
 * The assumptions behing the LifestyleLinking science
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Input of human assumptions (as little as possible, all should be crowd sources)
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLassumptions
{
// add new logic and ideas to the core
// able to test against currunt.

// current human assumptions (ie not crowd sourced, where possible try and replace these with crowd source values)
  
    public $assumptions;
    
   public function __construct()
{
      $this->assumptions['remove'] = array("'", "-", ",", "(",")", "?", ".", "&rsquo;", "&ldquo;", "&rsquo;", "&rdquo;", ":", "@", "!", "#", "^", "%", "/", "|", '\'', "+", "=", "{", "}", "[", "]", '"', ";", "*", "<", ">", "_", "~", "<br />", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "also", "www", "jpg", "org", "html", "http", "–", "com", "htm", "px" );
      $this->assumptions['wordlength'] = 1;
      $this->assumptions['characterperwordmax'] = 30;
      $this->assumptions['numberwisewords'] = 50;
      
  }
    
    
   public function loadAssumptions()
{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->wiseData);
      return $this->assumptions;
  
    }
  
    
    

} // closes class

?>
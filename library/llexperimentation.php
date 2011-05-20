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
    protected $iLLlogic;
    
    /** load in current experimentation assumptions
     *
     * The default assumption active in the frawework
     *
     */ 
   public function __construct()
  {
      $this->assumptions['remove'] = array("'", "&#8217;", "&#8216;", "-", ",", "(",")", "?", ".", "&rsquo;",  "&nbsp", "ref", "&ldquo;", "&rsquo;", "&rdquo;", "â€“", ":", "@", "!", "#", "^", "%", "/", "|", '\'', "+", "=", "{", "}", "[", "]", '"', ";", "*", "<", ">", "_", "~", "<br />", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "also", "www", "jpg", "org", "html", "http", "–", "com", "htm", "px");
      //$this->assumptions['remove'] = array("[", "]", "-", "|", "{", "}");
      $this->assumptions['wordlength'] = 1;
      $this->assumptions['characterperwordmax'] = 30;
      $this->assumptions['numberwisewords'] = 50;
      
  }
    
    /** find out what definition will be need to produce a resultpath given the user intention
     *
     * The default will be a single defintion until a more advanced science if found
     *
     */  
   public function LLlogic($LLlogic)
  {
//echo $LLlogic;
  // what is the 'science that connects all life?
  //  this will determine the data required to produce the 'best' resultpath for this individual life
  //types available,  single  or order of definitions
        if ($LLlogic === 'singledefinition')
        {
          // then lifestylelinking will be performed based upon one definition
          $this->iLLlogic = 'intention';
        
        }
        
        else
        {
        // based on a science unique to this individual, an array of definition in a certain order will produce better resutls
        $this->iLLlogic = array();  // some order  could be 1 def, 2 defs, combo defs, location, weather, medical sats in the future (probably a dynamic algorithm to call)
        
        
        }




  } 
  
    /** pass back to framework the defintion LLlogic
     *
     *  a singel def or array of logic or algorythm (cometime)
     *
     */ 
    
   public function loadAssumptions()
  {
      
      return $this->iLLlogic;
  
  }
  
    
    

} // closes class

?>
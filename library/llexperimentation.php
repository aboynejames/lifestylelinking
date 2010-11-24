<?php

// add new logic and ideas to the core
// able to test against currunt.

// current human assumptions (ie not crowd sourced, where possible try and replace these with crowd source values)
class LLassumptions
{
  
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
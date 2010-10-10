<?php

class LLdefinitions
{

     protected $defwikiword;  // the unique word for a page on wikipedia 
     
     
     		public function definitionWord($defstart)
		{
			// TODO: Check that postWords is in the correct format
		
			  $this->defwikiword = $defstart;
      
		}
     
    // call wikipedia api to retrive source definition content 
		public function buildDefinitions()
		{
			// Note: use arrays and not database
			
			// Call the Wikipedia API for URL for $subject
      // first need to activate include wikipedia class
      // how???
      // use the wikipedia class
			//$lifeobj = new Wikipedia();
      //$lifeobj->getpage($this->$defwikiword, $revid=null);
      $lifeobj = file_get_contents('http://www.aboynejames.co.uk/opensource/LL/llcore/text/skiingwikip.txt');
      //print_r($lifeobj);
      
      
			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($lifeobj);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanDefinition = $dataCleaner->cleanedData();
            
    
		}




  }  // closes class
  
  
  ?>

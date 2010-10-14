<?php

class LLdefinitions
{

     protected $defwikiword;  // the unique word for a page on wikipedia 


    public function definitionManager()
		{
			// If a new definition is being added then attach a new definition identity to it (no.1 + linked data url e.g. dpedia
      //  also someday, defintions will be update i.e. crowd sourced from LL community rather than wikipedia, or no. of words in list today 50 eventually all words ever used online.
		
			  
      
		}



     
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
      $lifeobj = file_get_contents('C:\apache\htdocs\llcore\text\skiingwikip.txt');
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

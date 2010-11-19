<?php

class LLdefinitions
{

     protected $defwikiword;  // the unique word for a page on wikipedia 
     protected $definitionPrep;  // list of definition with uniqueids / rdf uris
     protected $cleanDefinition;  // array of definition words clean and split into single words.

    // accept input definition words (only allow from wikipedia (for now))
    public function definitionWord($defstart)
		{
			// TODO: Check that postWords is in the correct format
      // need to add regex to make sure 

      $this->defwikiword = $defstart;   // temporary test data
            
		}


    public function definitionManager()
		{
			// If a new definition is being added then attach a new definition identity to it (no.1 + linked data url e.g. dpedia
      //  also someday, defintions will be update i.e. crowd sourced from LL community(could be segments of a community) rather than wikipedia, or no. of words in list today 50 eventually all words ever used online.
      // also what api will be use installed or 'as a service' to wikipedia
      
     // check if new, if so attached definition id to it ie a number for this framework and dpedia uri if already entered attach that defintition id to it.
     // first call and get list of all defintition stored in the framework (could also use PeertoPeer RDF to get most update def ie. post first time use via wikipedia)
     // to be built
     //check to see if first time enter lifestyle definition words (for this example yes
     // array to compare input definitions with existing defs. already in framework

     // call wikipedia API  (this examples limited two pre pared source files)
		  $demodef[1] = file_get_contents('C:\apache\htdocs\llcore\text\skiingwikip.txt');  // temporary test data
      $demodef[2] = file_get_contents('C:\apache\htdocs\llcore\text\swimmingwikip.txt');  // temporary test data     
      
      
      $this->definitionPrep = $demodef;
      
		}


  
    public function startNewdefinition()
		{
			// starts methods to add new definition(s)
			      // one or more defintions?
           foreach ($this->definitionPrep as $defid=>$indef)
           {
             $this->buildDefinitions($defid, $indef);
            
            } // closes foreach loop

      
		}


    // call wikipedia api to retrive source definition content 
		public function buildDefinitions($defid, $indef)
		{
			// Note: use arrays and not database
			
			// Call the Wikipedia API for URL for $subject
      // first need to activate include wikipedia class
      // how???
      // use the wikipedia class
			//$lifeobj = new Wikipedia();
      //$lifeobj->getpage($this->$indef, $revid=null);
      $lifeobj = $indef;
            
      
			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($lifeobj);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanDefinition[$defid] = $dataCleaner->cleanedData();
      //print_r($this->cleanDefinition);      
    
		}

		public function cleanedDefinition()
    {
      return $this->cleanDefinition;
		}


  }  // closes class
  
  
  ?>

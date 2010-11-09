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
//      $this->assumptions = $assumptions;
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
     //check to see if first time enter lifestyle definition words (for this example yes)
     
     // call wikipedia API  (this examples limited two pre pared source files)

      // start lifestyle definition array ie those already added
      $existingdefs = array();

      // new lifestyle definitions added via UI or control panel (assume all first time entry
      $newdefs = $this->defwikiword;
      //  compare two to array to get new wikipedia words that need to be collected.
      
          
      $this->definitionPrep = $newdefs;
      
		}


  
    public function startNewdefinition()
		{
			// starts methods to add new definition(s)
			      // one or more defintions?
           foreach ($this->definitionPrep as $defid=>$wikiword)
           {
             $this->buildDefinitions($defid, $wikiword);
            
            } // closes foreach loop

      
		}


    // call wikipedia api to retrive source definition content 
		public function buildDefinitions($defid, $wikiword)
		{
			// Note: use arrays and not database
      $lifedefobj = new wikipedia();

      $wdefwords = $lifedefobj->getpage($wikiword, $revid=null);     
      //print_r($wdefwords);
			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($wdefwords);
			
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

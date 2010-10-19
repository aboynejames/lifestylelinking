<?php

class LLframeworkmanager
{
  // overall management of the framework    apis, datachecking, core, display, testing, experimentation  
  // handles input of data third party (could be via node.js loop).
  // forms inputs order into LLcore and identifies inputs
  //  we need to know 1. data state, string, array, tidy undity. 2. is it definition or post words 3.  how many of each 10 blog posts and 3 wikipedia definition
  
		protected $frameworkSetup; // install or default settings for framework
    protected $definitionStart;  // input from individual
    protected $defSet;
    protected $contSet;
    protected $individual;
    protected $lifestyle;
    protected $source;
    
   public function __construct($individual, $inputSetup, $lifestyle, $sources)
		{
			$this->individual = $individual;
      $this->frameworkSetup = $inputSetup;
      $this->lifestyle = $lifestyle;
      $this->source = $sources;
      //$this->definitionStart = $definitionwords;
 		} 
    

      //  co ordinates apis plugin that feed data in and out of the whole framework  (installed feedreader, wikipedia api or pluged in as a service? will know from install.)
     		public function apiStatus()
		{
			// uses  llapi class include api classes or plug into third party servies 
      $apinew = new apimanagement($this->frameworkSetup);
      
      }
     
      
  
      // Start.  First time use, update use?
        public function indentityStatus()
		{
			// identity of Framework
      // identity of definition
      // identity of content
      
      
      }

    // tag identity  and definition (input stats about content/definitions, first time or update)  probably done as a result of def and identity content input process
      public function identityControl()
		{
      // to be used by definition and indentity content
      // pair up e.g. wikipedia api to definition id (where possible RDF URI dpedia in this case
      // pair content to api in e.g. feedreader, that will produce id but will be unique to each installation, need convert to RFD or identity service or build parser to match same identity
    }
 
  
      // or special case  starting defintions from wikipedia,  built in api or  as a service (from somewhere, mepath might provide)
      public function definitionControl($defin)
		{
			// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
      // read in test text.
      $newdef = new LLdefinitions();
      $newdef->definitionWord($defin);
      $newdef->definitionManager();
      $newdef->startNewdefinition();
      $this->defSet = $newdef->cleanedDefinition();
      //print_r($this->defSet);
     }
   
     
      public function contentControl($indata)
		{
    // where is the data coming from?
    // e.g. rss feedreader built in,  pubhubsubdub/cloudrss  or as a service for updates  ie. superfeeder
      
      $newdata = new LLcontent(); 
      // new content to be processed?
      $newdata->contentData($indata);
      $newdata->contentManager();
      $newdata->startNewcontent();
      $this->contSet[1] = $newdata->cleanedContent();
      //print_r($newdata);
    }

    // LLcore goes to play
      public function controlCore()
		{
    
    $llnew = new LLCore($this->defSet, $this->contSet);
    //$llnew->populateArray; 
    //print_r($llnew);
    //  time to enter the matrix
    $llnew->LLcoremanager();
    $llnew->createLLMatrix();
    $llnew->calculateLLStats();
    $llnew->calculateLLAvgOfAvg();
    $llnew->calculateLLNormalisation();
    // Self form LL groups
    //$llnew->calculateLLgroups(); 
    //print_r($llnew);
      
    }

      /*

      // results time-context
      $llnew->calculateLLresults();

      */


 
}  // closes class
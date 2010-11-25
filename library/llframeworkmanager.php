<?php

class LLframeworkmanager
{
  // overall management of the framework    apis, datachecking, core, display, testing, experimentation  
  // handles input of data third party (could be via node.js loop).
  // forms inputs order into LLcore and identifies inputs
  //  we need to know 1. data state, string, array, tidy undity. 2. is it definition or post words 3.  how many of each 10 blog posts and 3 wikipedia definition
  
		public $llnew;
    protected $individual;
    protected $identitysource;
    protected $frameworkSetup; // install or default settings for framework
    protected $lifestyle;  // input from individual
    protected $contentid;
    protected $defSet;
    protected $contSet;
    protected $source;
    protected $resultswindow;
    
   public function __construct($individual, $idsources, $inputSetup, $lifestyleDefs, $resultswindow)
		{
			$this->individual = $individual;
      $this->identitysource = $idsources;
      $this->frameworkSetup = $inputSetup;
      $this->lifestyle = $lifestyleDefs;
      $this->resultswindow = $resultswindow;

      $this->assumptionsSet();
      $this->indentityStatusmanger();
      
 		} 
    
    
        // load in current experimentation assumptions
      public function assumptionsSet()
      {
      global $aset;
      // uses llapi class include api classes or plug into third party servies
      $aset = new LLassumptions();
      $aset->loadAssumptions();
      //echo 'assump set up funct';
      //print_r($aset);
      //print_r($aset->assumptions['remove']);
      }

      // Start.  First time use, update use?
        public function indentityStatusmanger()
		{
			// identity of Framework
      // has the framework been unique identified?
        $this->apiStatus();
        
       // for all inputs load existing status ie if framework been used before load (from nosql or db)  then use those to control the input of new defs, content or result requests.
        $this->identityControl(); 
      
      }


      //  co ordinates apis plugin that feed data in and out of the whole framework  (installed feedreader, wikipedia api or pluged in as a service? will know from install.)
     		public function apiStatus()
		{
			// uses  llapi class include api classes or plug into third party servies 
      $apinew = new apimanagement($this->frameworkSetup);
      
      }


    // tag identity  and definition (input stats about content/definitions, first time or update)  probably done as a result of def and identity content input process
      public function identityControl()
		{

      // to be used by definition and indentity content
      // pair up e.g. wikipedia api to definition id (where possible RDF URI dpedia in this case
      // pair content to api in e.g. feedreader, that will produce id but will be unique to each installation, need convert to RFD or identity service or build parser to match same identity
      
     // check to see if existing framework setting exist  ie data from previous setup ie defs already added, sources of content, results windows?
      $loadstatus = $this->existingSettings();
      print_r($loadstatus);
       
       if ($loadstatus)
       {
             // for existing defs and sources of contents  see if updates,  ie updated wisewords for each definition or sources of content as new content authored into the universe?  (possible rescore of existing content with updated defintions and notify user of changes to results they have used in the past?)
             
             if ($loadstatus['startdefs'] !== 0 )
             {
             // load or update lifestyle definitions
            // status of definitions
            // nil, need to promoted to add first, have def. been updated, peer to peer to to community hub e.g. mepath.com for sport
              $this->definitionControl($loadstatus['startdefs']);
             
             }
             
             
             if ($loadstatus['startcontent'] !== 0 )
             {
                 // identity of content
                 // is this first time entry of any content, is addition of second content source, or rescoring of existing content on new definitions etc.
                  print_r($loadstatus['startcontent']);
                          // extract sources and then foreachloop on a per source basis
                          //but need to call call rssfeeder to find those?
                          foreach ($loadstatus['startcontent'] as $sid=>$surl)
                          {
                         
                         $this->contentControl($sid, $surl);
                         
                         // core  process wisewords, matrix, statistics break to create Avg. of Avg then proceed to normalization, peergroups,, break to input results window then display based on window ie make future 
                         // need some function to poll clean content to detect a new sources to allow content core to begin rather than waiting for all new content to be updated
                         $this->controlCore($sid, $loadstatus['startdefs']);
                         
                         }

               }

              
     } 
      
  }
 
 
      // depending on first time use, nosql, or sql setup, load existing frameworks status info. ie. exsting defs, sources of content, results windows, display etc.
      public function existingSettings()
		{
      // load last use settings
     // exsting definitions
      $existingdefs = $this->existingdef();
      $newdefs = $this->lifestyle;
      
      $comparedefnew = $newdefs;
      
      
      //  what are the current content inputs
      $existingsources = $this->existingsource();
      $newsource = $this->identitysource;
      // compare both are return the new to be processed
     // some array comparing to be added 
      $comparenewsource = $this->identitysource;
      
      $existingframework['startdefs'] = $comparedefnew;
      $existingframework['startcontent'] = $comparenewsource;
      
      return $existingframework;
 
    }
  
  
      public function existingdef()
		{
      // load last used definitions  (might be worth calling external api rdf for avg of avg updates?
     $existingdefarray = array(); 
      
    }
  
      public function existingsource()
		{
    // what sources already added rss , photo, video etc etc. call pubhubsubdub from here?
      $existingsourcesarray = array();
 
    }
  
  
      // or special case  starting defintions from wikipedia,  built in api or  as a service (from somewhere, mepath might provide)
      public function definitionControl($newdefs)
		{
			// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
      // read in test text.
      $newdef = new LLdefinitions($newdefs);
      $newdef->definitionManager();
      $newdef->startNewdefinition();
      $this->defSet = $newdef->cleanedDefinition();
      //print_r($this->defSet);
     }
   
     
      public function contentControl($sid, $surl)
		{
    // where is the data coming from?
    // e.g. rss feedreader built in,  pubhubsubdub/cloudrss  or as a service for updates  ie. superfeeder
      $newdata = new LLcontent($sid, $surl); 
      $newdata->contentManager();
      $this->contSet = $newdata->cleanedContent();
      //print_r($this->contSet);
    }

    // LLcore goes to play
      public function controlCore($sid, $defsforcore)
		{
    global $llnew;
    
    $llnew = new LLCore($this->defSet, $this->contSet[$sid]);
    //  time to enter the matrix
    $llnew->LLcoremanager($sid, $defsforcore);
  


    // import input context instance, ie results window  output make the future.
    
    //$llnew->calculateLLresults();
    //print_r($llnew);
    
    // from raw data feed json or rdf php array (see easy rdf code look at using)

    }

      /*

      // results time-context
      $llnew->calculateLLresults();

      */


 
}  // closes class
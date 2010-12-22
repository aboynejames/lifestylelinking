<?php
/**
 * LifestyleLinking
 *
 * Use this file to load the LifestyleLinking Framework.
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Framework for managing the whole LifestyleLinking experience.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class LLframeworkmanager
{
  // overall management of the framework    apis, datachecking, core, display, testing, experimentation  
  // handles input of data third party (could be via node.js loop).
  // forms inputs order into LLcore and identifies inputs
  //  we need to know 1. data state, string, array, tidy undity. 2. is it definition or post words 3.  how many of each 10 blog posts and 3 wikipedia definition
  
    protected $individual;
    protected $identitysource;
    protected $frameworkSetup; // install or default settings for framework
    protected $lifestyle;  // input from individual
    protected $resultspath;
    
    protected $intentionlogic;
    

     
    /**
     * Constructor 
     *
     * Setup of new or existing Framework settings 
     *
     * Data input from the UI
     *
     * @param  int  $individual    owner of frameworks id
     *
     */
   public function __construct($inputSetup, $resultspath, $individual, $iddefinition, $idsources)
		{
		
      $this->frameworkSetup = $inputSetup;
      $this->resultspath = $resultspath;
      $this->individual = $individual;
      $this->lifestyle = $iddefinition;
      $this->identitysource = $idsources;

      $this->assumptionsSet();
      $this->indentityManager();
   
 		} 
    
    /** load in current experimentation assumptions
     *
     * The default assumption active in the frawework
     *
     */ 
      public function assumptionsSet()
      {
      global $aset;
      // uses llapi class include api classes or plug into third party servies
      $aset = new LLassumptions();
      
      // pass the lifestylelinking science
      $aset->LLlogic($this->frameworkSetup['science']);
      
      //$aset->loadAssumptions();

      $this->intentionlogic = $aset->loadAssumptions();
 
        // active the appropriate apis local or from the web
        $this->apiStatus();
        
      }

      
    /** Co ordinates apis plugin that feed data in and out of the whole framework  
     *
     * (installed feedreader, wikipedia api or pluged in as a service? will know from install.)
     *
     */
      public function apiStatus()
      {
			// uses  llapi class include api classes or plug into third party servies 
      $apinew = new apimanagement($this->frameworkSetup);
      
      // any RDF linking established?   if so establish connection
      $rdfconnect = new LLrdf();
      
      }

    /** Establish the starting indienty of definitions and content sources
     *
     * setup resultpath object, definition object, content objects and get all data in universe upto date and pass that to core in priority of resultspath (process per source, this source list will be prioritised by the LLlogic that is this individuals science for this framework
     * What has already but processed by core?  What need to go into LLcore?
     *
     */
      public function indentityManager()
      {
        
      //  start results path class
      // what is the lifestyledefinition active resultspath e.g. swimming, what other LL logic this base upon, get all content if new, update or rescore, this set parameters, so everything else after
      $resultspath = new LLResults();
      
      // defintions class
      $this->definitionControl($this->resultspath['intention'], $this->intentionlogic, $this->lifestyle);  //  intention, iLLlogic,     
      
      // content
      //$this->contentControl($this->);
      
      
      // CORE  input data from defs and content and context get resultpath out or dailyupdate or general scoring or rescoring
      //$this->controlCore();

      }
      
  
  
    /** Controls creating a new lifestyle Definition 
     *
     * After adding markup is clean from the defintion words 
     *
     */
      public function definitionControl($intention, $llogic, $indefinition)
		{
			// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
      // read in test text.
      $newdef = new LLdefinitions($intention, $llogic, $indefinition);
      //$newdef->definitionManager();
      //$newdef->startNewdefinition();
      //$this->defSet = $newdef->cleanedDefinition();
      print_r($newdef);
     }
   
     
    /** Controls adding new content sources to the Framework
     *
     * After adding mark up is clean from source content words
     *
     */ 
      public function contentControl($sid, $surl)
		{
    // where is the data coming from?
    // e.g. rss feedreader built in,  pubhubsubdub/cloudrss  or as a service for updates  ie. superfeeder
      $newdata = new LLcontent($sid, $surl); 
      $newdata->contentManager();
      //$this->contSet = $newdata->cleanedContent();
      //print_r($this->contSet);
    }

    /** Control the data going into LLcore
     *
     * Fed into core on a per content sources basis (and as many definitions that need scoring)
     * 
     */
      public function controlCore($sid, $defsforcore)
		{
      global $llnew;
   
      $llnew = new LLCore($this->defSet, $this->contSet[$sid]);
      $llnew->sourcecontent($this->defSet, $this->contSet[$sid]);
      //  time to enter the matrix
      $llnew->LLcoremanager($sid, $defsforcore);
    
      //print_r($llnew);
      // import input context instance, ie results window  output make the future.
      
      
      // from raw data feed json or rdf php array (see easy rdf code look at using)

    }

      /*

      // results time-context
      $llnew->calculateLLresults();

      */


   /** Tag identity  and definition (input stats about content/definitions, first time or update)  probably done as a result of def and identity content input process
     *
     *
     */
      public function identityControl()
      {
//global $llnew;
      // to be used by definition and indentity content
      // pair up e.g. wikipedia api to definition id (where possible RDF URI dpedia in this case
      // pair content to api in e.g. feedreader, that will produce id but will be unique to each installation, need convert to RFD or identity service or build parser to match same identity
      
     // check to see if existing framework setting exist  ie data from previous setup ie defs already added, sources of content, results path?
      
      
      // new thinking here, treat each component seperately,  results path (input context), definitions and content
      //  get all input data to those classes and then get back what is required before CORE is called upon
      
      // start with results path (input context)
      // user intention will set the priorities to be processed to get the 'best' (quickests) results
      // therefore this will tell us what definition to include, create, update and score.
      // content sources, start with own content source and then add AMPL, auto crawl or rdf peertopeerkickstart
      //  then hold a results path object if results are needed again or can be called upon via rdf peertopeerkickstart.
      
      
      // resultspath  now seperate process
      
      
      // display  where is the new resultspath data going?  internet, mobile, laptop, touchdevice etc.
      
      /*   
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
                         $llnew = new LLCore(); 
                        foreach ($loadstatus['startcontent'] as $sid=>$surl)
                        {
                         echo 'start content';
                         $this->contentControl($sid, $surl);
                         
                         // core  process wisewords, matrix, statistics break to create Avg. of Avg then proceed to normalization, peergroups,, break to input results window then display based on window ie make future
                          echo 'start core';
                             // need some function to poll clean content to detect a new sources to allow content core to begin rather than waiting for all new content to be updated
                             //$this->controlCore($sid, $loadstatus['startdefs']);
                             // $llnew = new LLCore($this->defSet, $this->contSet[$sid]);
                            $llnew->sourcecontent($this->defSet, $this->contSet[$sid]);
                            //  time to enter the matrix
                            $llnew->LLcoremanager($sid, $this->lifestyle);
                            $llnew->saveSource();
                            $this->core[$sid] = $llnew;
                               
                         }
                     
               }

              
     } 
      */
       //print_r($llnew);
  }
 
 
   
    /** depending on first time use, nosql, or sql setup, load existing frameworks status info. ie. exsting defs, sources of content, results windows, display etc.
     *
     *
     * @return array of existing settings
     *
     */ 
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
  
  
    /** Find out existing defintion existing in the Framework
     *
     */ 
      public function existingdef()
		{
      // load last used definitions  (might be worth calling external api rdf for avg of avg updates?
     $existingdefarray = array(); 
      
    }
  
    /** Find out the exsting content sources in the Framework
     *
     */ 
      public function existingsource()
		{
    // what sources already added rss , photo, video etc etc. call pubhubsubdub from here?
      $existingsourcesarray = array();
 
    }
 

 
}  // closes class
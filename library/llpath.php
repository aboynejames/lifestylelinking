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
 * Class for transfering intention between UI and the framework.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class LLpath
{
  // input of data, display, api etc   
  
 
    protected $path;
     
    /**
     * Constructor 
     *
     * Default intention settings 
     *
     * Data input from the UI
     *
     * @param 
     *
     */
    public function __construct($path)
		{
		
    $this->path = $path;
    $this->pathManager();
      
   
 		} 
    
    /**  manager of paths
     *
     * 
     *
     */ 
    public function pathManager()
    {
 
        // ??  is path basically a set of logic functions that decides the order that  definitions, sources content, core, results and display   yes, sounds right but hard wire a scenario for now
        // Questions are 1. are defintions added or need updated,  sources of content updated or more sources needed added, call core,   no process required go straight to display, time period 
 
        // process the new lifestyle  1.  load/add defintition, 2. sources of content if a. none, promt to add (1.manual input, 2. input rssfeeder e.g. google, yahoo via api, 3. autocrawl, 4. rdf peertopeer ), 3. load and ready data for results, 4. raw results, 5 display theme selected/location for data
        // first stage is to see if info. from universe needs updated before results (if framework data exists, process that while update is going on ie. upload all relevant data to memeory if not already in and prep. peer lists based on LifestyleLinking Logic
                  
         if($this->path['intention'] == 'newstart')
         {
         //  from start page UI
         $this->definitionControl($intent = 'update', $this->lifestyle);  //  intention, iLLlogic,     
          
          // content
         $this->contentControl($intent = 'update', $this->identitysource);
         
         $this->controlCore();  
         
         $resultspath = new LLResults();
         
         $displayPath = new LLDisplay();
         
         }
         
        elseif($path['intention'] == 'results')
        {
        // user already in results UI

          //$resultspath = new LLResults();
          
          // content
          //$this->contentControl($intent = 'results', $this->identitysource);
          
          
          // CORE  input data from defs and content and context get resultpath out or dailyupdate or general scoring or rescoring
          //$this->controlCore();
         
          
         }

        elseif($path['intention'] == 'update')
        {
          // from control panel
          // defintions class
          //$this->definitionControl($intent = 'update', $this->lifestyle);  //  intention, iLLlogic,     
          
          // content
          //$this->contentControl($intent = 'update', $this->identitysource);
          
          
          // CORE  input data from defs and content and context get resultpath out or dailyupdate or general scoring or rescoring
          //$this->controlCore();
          }
      }
 
     /** Controls creating a new lifestyle Definition 
     *
     * After adding markup is clean from the defintion words 
     *
     */
      public function definitionControl($intention, $indefinition)
		{
			// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
      // read in test text.
      $newdef = new LLdefinitions($intention, $indefinition);
      //$newdef->definitionManager();
      //$newdef->startNewdefinition();
      //$this->defSet = $newdef->cleanedDefinition();
      //print_r($newdef);
     }
   
     
    /** Controls adding new content sources to the Framework
     *
     * After adding mark up is clean from source content words
     *
     */ 
      public function contentControl($intention, $source)
		{
    // where is the data coming from?
    // e.g. rss feedreader built in,  pubhubsubdub/cloudrss  or as a service for updates  ie. superfeeder
      $newdata = new LLcontent($intention, $source); 
      //$newdata->contentManager();
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
 
 
}  // closes class
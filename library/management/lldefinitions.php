<?php
/**
 * LifestyleLinking
 *
 * Controls new definitions into the Framework 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Definitions are all started from a wikipedia URL
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
 class LLdefinitions
 {

     protected $defpath;
     protected $defin;
     protected $loaddefinitions;
     protected $wiseDefinition;
     protected $defids;
     protected $setlivedefinition;

    /** Controls creating a new lifestyle Definition 
     *
     * accept input definition words (only allow from wikipedia (for now)) 
     *
     */
    public function __construct($intentionpath, $indefinition)
		{
      // always check for a. new definiitions, b, updates to definitions (that are proven to be better or of individuals request) 
      $this->defpath = $intentionpath; 
      $this->defin = $indefinition;
      
      $this->definitionManager();
      
		}


    /** Controls creating a new lifestyle Definition 
     *
     * accept input definition words (only allow from wikipedia (for now)) 
     *
     */
    public function definitionManager()
		{
      // load in existing definitions
			// If a new definition is being added then
      // a.  attach a new definition identity to it (no.1 + linked data url e.g. dpedia
      // b. also someday, defintions will be update i.e. crowd sourced from LL community(could be segments of a community) rather than wikipedia, or no. of words in list today 50 eventually all words ever used online.
      $existingdefs = $this->loadExistingdefintions();
     
      $newdef = $this->addDefinition($this->defin, $existingdefs);
      
		}

    /** Load existing definition or connect for updates to defitions 
     *
     * key wikipedia word and rdf url via dpedia 
     *
     */
    public function loadExistingdefintions()
		{
			//echo 'load existing definitions <br /><br />';
      // query local json txt, mysql, couchdb or RDF
      // local text files for now
      // need to have json txt for id of defintions already wise the foreach those
      $this->loaddefinitions = LLJSON::importJSONdata($defkey = 0, $defstage = 'definitions');
//print_r($this->loaddefinitions);
     
      if ($this->loaddefinitions['start'] == 'empty')
      {
      return null;
      }
      
      else
      {
//echo 'existing data found <br /><br />';    

          // form array of defintions and then loadup the wisedefinitions      
          foreach($this->loaddefinitions['definitions'] as $dkey=>$dw)
          {
          
            $this->defids[$dkey] = $dw['wikipedia']; 
          
          }
//print_r($defids);
          foreach($this->defids as $did=>$dwiki)
          {
          $importdef = LLJSON::importJSONdata($did, $defstage='wisedef');
          $this->existdef[$did] = $importdef[$did];
//echo 'the load existing def in array<br /><br />';
//print_r($this->existdef);
//echo 'any loaded';
          }
                    
          return $this->defids;
      }
      //  simplify array to id and wikipediaword

      // call RDF nextwork
      
		}
    
    /** compare new input definition to existing definition created
     *
     * if new definition word to framework? 
     *
     */
    public function addDefinition($newdef, $existingdef)
		{
//echo 'call the adddefinition function <br /><br />';
      if ($existingdef == null)
      {
      //print_r($newdef);
        // add to definition - FIRST time entry json txt files or mysql or couchdb
      $newdefstart['definitions']['1'] = $newdef;
      //print_r($newdefstart);
      LLJSON::storeJSONdata($newdefstart, $newdefid = 0, $defstage='definitions');
      
      $newdefarray = array('1'=>$newdef);
      //print_r($newdefarray);
      //echo ' before call to wikipedia';
      $this->startNewdefinition($newdefarray); 
      
     $this->setlivedefinitionid = 1;
     $this->defids[1] = $newdef['wikipedia'];

      }
      
      else
      {
      //print_r($newdef);
      //print_r($existingdef);
   
      // is the new wikipedia definition word already in the framework?
      $defcheck = array_search($newdef['wikipedia'], $existingdef);
     
         if ($defcheck == 0)
         {
        // echo 'add additional deff add <br /><br />';
         // need to store and append to json txt file, mysql or couchdb
         // form new summary definition array ie existing plus new
         $newdefid = $this->newdefidnumber($existingdef);
         
         $newdefupdate = $this->updatedefinitionlist($newdefid, $newdef);
         //echo 'new summary def array for json';
         //print_r($newdefupdate);

         LLJSON::storeJSONdata($newdefupdate, $newdefidstart = 0, $defstage='definitions');
         // not in framework , add it
         // append definition new allocated id 
         $newdefarray = array($newdefid=>$newdef);
         
         $this->startNewdefinition($newdefarray);
         
         $this->setlivedefinitionid = $newdefid;
         
         }
         
         else
         {
         // already in framework
         // attached a defid to the 'live' definition
         $this->setlivedefinitionid = $defcheck;
      
         }
     }
      
		}
    
    /** New defintion needs added to this framework 
     *
     * takes array of new wikipeida words 
     *
     */  
    public function newdefidnumber($existingdef)
    {
//print_r($existingdef); 
    // existing definition array - what was last id used?
    $flifdefid = array_flip($existingdef);
    $lastdefid = end($flifdefid);
    $newdefid = $lastdefid + 1 ;
    //echo 'newid'.$newdefid;
    return $newdefid;
    
    } 
    
   
    public function updatedefinitionlist($newdefid, $newdef)
    {
//echo 'before new add <br /><br />';
//print_r($this->loaddefinitions);
    
   // existing list of def data
    $newsavedef = $this->loaddefinitions;
    $newsavedef['definitions'][$newdefid] = $newdef;
    
   
    
//echo 'after add new';
//print_r($newsavedef);
    
    return $newsavedef;
    
    // new defintion and allocatea  new id    
    
    }
    
    
    

    /** New defintion needs added to this framework 
     *
     * takes array of new wikipeida words 
     *
     */  
    public function startNewdefinition($newdef)
		{
			// starts methods to add new definition(s)
			      // one or more defintions?
//echo 'startnew api';
//print_r($newdef);
           foreach ($newdef as $defid=>$indef)
           {
           
             $this->buildDefinitions($defid, $indef);
            
            } // closes foreach loop

      
		}
    
    /** Calls wikidpedia api for each defintion keyword 
     *
     * activates wikipedia class 
     *
     */    
		public function buildDefinitions($defid, $wikiword)
		{
    //echo $wikiword;
			// Note: use arrays and not database
      $lifedefobj = new wikipedia();

      $wdefwords = $lifedefobj->getpage($wikiword['wikipedia'], $revid=null);     
      //print_r($wdefwords);
			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($wdefwords);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanDefinition[$defid] = $dataCleaner->cleanedData();
     //echo 'after clean'; 
     // printf($this->cleanDefinition);
      LLJSON::storeJSONdata($this->cleanDefinition[$defid], $wikiword['wikipedia'], $stage = 'raw');
      
      // now make those list of words wise
      $this->makeDefinitions($defid, $this->cleanDefinition[$defid]);


		}
 
     /** Turns clean Definition array in Wise array of words
     *
     * based on frequency used author by wikipedia community (why?  Start crowd source vocabularly)
     * also certain words excluded  CQ and 'joining' words
     *
     */ 
  	public function makeDefinitions($defid, $defWords)
		{
			// Note: use arrays and not database
			
   		// Create a LLDataCleanser object
      $dataWisdom = new LLwordWisdom($defWords);
			
			// Clean the data
			$dataWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseDefinition[$defid] = $dataWisdom->wiseWords();
      //print_r($this->wiseDefinition);

      LLJSON::storeJSONdata($this->wiseDefinition, $defid, $stage = 'wisedef');

		}
 
     /** identifies every defitiion words to dpeida URI
     *
     * removal of special characters
     *
     */
		public function formDefinitionRDF()
    {
      
		}

     /** Returns a clean definition 
     *
     *  an array of words 
     *
     */
		public function setlifestyleword()
    {
     
     // TODO  need to pick this up after new id added (if new)
     return $this->defin;
     
     }

     /** Returns list of lifestyle menu 
     *
     *  lifestyle words and ids array
     *
     */
		public function setlifestylemenu()
    {
     
     // TODO  need to pick this up after new id added (if new)
     return $this->defids;
     
     }


     /** Returns required data back to API manager
     *
     *  an array of words 
     *
     */
		public function returnDefinition()
    {
     
      $livedefdata['livedefinition'] = $this->wiseDefinition;
      $livedefdata['livedefid'] = $this->setlivedefinitionid;
      $livedefdata['lifestyleword'] = $this->defin;
      $livedefdata['lifestylemenu'] = $this->defids;
      
      return $livedefdata;
    
		}


  }  // closes class
  
  ?>

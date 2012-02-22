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
echo $this->defin.'what has come in???';      
      $this->definitionManager();
      
	}


	/**  
	* Controls creating a new lifestyle Definition
	* accept input definition words (only allow from wikipedia (for now)) 
	*
	*/
	public function definitionManager()
	{
      // load in existing definitions
	// If a new definition is being added then
      // a.  attach a new definition identity to it (no.1 + linked data url e.g. dpedia
      // b. also someday, defintions will be update i.e. crowd sourced from LL community(could be segments of a community) rather than wikipedia, or no. of words in list today 50 eventually all words ever used online.
      
	      // does the definition already exist?  query couchdb definitions view for the word
	      $checkdefs = 2;
	      
	      if($checkdefs == 1)
	      {
	      // definitions document already exsits, in future need update crowd sourcing logic or update existing logic
	      
	      
	      }
	      else
	      {
	      // need to create a new couchdb document (eventually abstract all database interaction away)
	      $this->addDefinition();
	      
	      
	      }
	 
	$this->setlifestylemenu();
	      
      
	}

	/** 
	*
	* if new definition word to framework? 
	*
	*/
	public function addDefinition()
	{
	
	$this->buildDefinitions();

      
	}
    


    /** 
     * Calls wikidpedia api for each defintion keyword 
     * activates wikipedia class 
     *
     */    
	public function buildDefinitions()
	{
    //echo $wikiword;
			// Note: use arrays and not database
      $lifedefobj = new wikipedia();

      $wdefwords = $lifedefobj->getpage($this->defin['wikipedia'], $revid=null);     
      //print_r($wdefwords);
		// Create a LLDataCleanser object
		$dataCleaner = new LLDataCleanser($wdefwords);
		
		// Clean the data
		$dataCleaner->clean();
		
		// Get the cleaned data
		$this->cleanDefinition = $dataCleaner->cleanedData();
		//echo 'after clean'; 

      
      // now make those list of words wise
      $this->makeDefinitions();

	// got all new data for document store
	$builddef['definition'] = $this->defin['wikipedia'];
	$builddef['sourcewords'] = $this->cleanDefinition;
	$builddef['wisewords'] = $this->wiseDefinition;
echo 'def data pre couchinsert';
print_r($builddef);
// convert to JSON
//$JSONbuilddef =  json_encode($builddef);
//echo $JSONbuilddef ;
// store in couchdb
	$this->couchconnect =  'lifestylelinking';
	$this->couch_dsn = "http://localhost:5984/";
   
	// may need to form JSON array first or do it a couchdb class
	$couchdocset = new LLcouchdb($this->couch_dsn, $this->couchconnect, $builddef);	
	$couchdocset->saveCOUCHdoc();


	}
 
     /** Turns clean Definition array in Wise array of words
     *
     * based on frequency used author by wikipedia community (why?  Start crowd source vocabularly)
     * also certain words excluded  CQ and 'joining' words
     *
     */ 
  	public function makeDefinitions()
	{
	// Note: use arrays and not database
			
	// Create a LLDataCleanser object
       $dataWisdom = new LLwordWisdom($this->cleanDefinition);
			
			// Clean the data
	$dataWisdom->wisdomLogic();
			
	// Get the cleaned data
	$this->wiseDefinition[$this->defin['wikipedia']] = $dataWisdom->wiseWords();
      //print_r($this->wiseDefinition);
	
	}
 
 
	/**
	*  identifies every defitiion words to dpeida URI
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

     /**
     *  Returns list of lifestyle menu 
     *  lifestyle words and ids array
     *
     */
	public function setlifestylemenu()
	{
     
	// TODO  need to pick this up after new id added (if new)
	$this->defimenu[] = $this->defin['wikipedia'];
	
	return $this->defimenu;
     
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
	$livedefdata['lifestylemenu'] = $this->defimenu;
      
	return $livedefdata;
    
	}


  }  // closes class
  
  ?>

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

     protected $defwikiword; // the unique word for a page on wikipedia
     protected $definitionPrep; // list of definition with uniqueids / rdf uris
     protected $cleanDefinition; // array of definition words clean and split into single words.

    /** Controls creating a new lifestyle Definition 
     *
     * accept input definition words (only allow from wikipedia (for now)) 
     *
     */
    public function __construct($intention, $llogic)
		{
      // always check for a. new definiitions, b, updates to definitions (that are proven to be better or of individuals choice) 
      $this->defpath = $intention; 
      $this->deflinking = $llogic;
      
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
      
      
      
		}

    /** Load existing definition or connect for updates to defitions 
     *
     * key wikipedia word and rdf url via dpedia 
     *
     */
    public function loadExistingdefintions()
		{
			
      // query mysql/couchdb or RDF
      $definitionsSet = array('0' =>'Skiing', '1' => 'Swimming_(sport)'); // need to add dpedia url to this via function

      // call RDF nextwork
      
      
      
		}

    /** New defintion needs added to this framework 
     *
     * takes array of new wikipeida words 
     *
     */  
    public function startNewdefinition()
		{
			// starts methods to add new definition(s)
			      // one or more defintions?
           foreach ($this->definitionPrep as $defid=>$indef)
           {
             $this->buildDefinitions($defid, $indef);
            
            } // closes foreach loop

      
		}
    
    /** Calls wikidpedia api for each defintion keyword 
     *
     * activates wikipedia class 
     *
     */    
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
		public function cleanedDefinition()
    {
      return $this->cleanDefinition;
		}


  }  // closes class
  
  ?>

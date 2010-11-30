<?php
/**
 * LifestyleLinking
 *
 * Use this file to load the LLcore logic.
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Clean definition and source content are process to create LL data
 *
 * Manager hands the follow stages
 *
 * Make words wise, frequency count and removal of confusionQuotent/'joing' words e.g. that and at etc.
 * Matrix  Matching words in a content item to a definitions wiseWords
 * Statistics build aggregate statistics of a whole content source over time
 * Avgerage of Averages calculate for all sources in the universe for each definition
 * Normalization  given a community lifestyle definition average, how far is a particular source from that average
 * Peer Group   Given each sources 'distance from a lifestyle definition, order source top to bottom
 * Results  - given individuals input results window (input context) produce results
 * Make all data available (json) for distribution anywhere on the web
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
	class LLCore  {
	
		protected $cleanContent; // array of words from content
    protected $defstoscore;
		protected $cleanDefinition; // cleaned version of Wiki definiton
    protected $matrix;
  //  protected $statistics;
    protected $avgofavgs;
    protected $lifeGroup;
    protected $results;
    
    /**
     * Constructor 
     *
     *
     */
   public function __construct()
		{
			//$this->cleanDefinition = $dataDefinition;
      //$this->cleanContent = $dataContent;
		} 
    
    /** Clean definition and clean source content input to core (maybe put back in to constructor?)
     *
     *
     * @param array $this->cleanDefinition
     * @param array $this->cleanContent
     *
     */ 
    public function sourcecontent($dataDefinition, $dataContent)
		{
			$this->cleanDefinition = $dataDefinition;
      $this->cleanContent = $dataContent;
		} 
   

    /** Control how all the stages of core are handled
     *
     *
     *
     */ 
    public function LLcoremanager($source, $defstoscore)
    {
    // utility function to 
    // has information to tag data with so the right combintation of path through core is captured and recorded.
    // ie is this first time use of this data, update, or returning of the whole from a different starting point? 
    // core runs on a PER SOURCE basis (exept break for avgofavg update/calc) before resuming on per source basis, results aggregate data qualifying for results windows from indiv sources.
    //print_r($this->cleanDefinition);
    //print_r($this->cleanContent);
        
       $this->defstoscore = $defstoscore; 
        // make wise Definitions
        foreach ($this->cleanDefinition as $defid=>$defWords) 
        {
        
        $this->makeDefinitions($defid, $defWords);
        
        }
        
        // need some function to manage the source content identity and match source(s) to the owner of this framework
        
        // make wise Content
        // do on a per sourceid basis (but maybe others ie. total flexibility on input ordering
       //foreach($source as $sid)
        //{
                foreach ($this->cleanContent as $contid=>$contWords)
                {
               
                $this->makeContent($source, $contid, $contWords);
                
                }
        //}        
        
       // use this manager function to call other core functions
        // matrix
          $this->createLLMatrix($source);

        // statistics
          $this->calculateLLStats($source, $this->defstoscore);
        
        // break to make choice on avgofavg  required for normalization, select local avgofavg. or call out to other apps. or relevant spawning hub e.g mepath.com for sports defs?
        // break to update Avg of Avg.
          $this->calculateLLAvgOfAvg();
       
       // normalization
          $this->calculateLLNormalisation();
        
        // peergroups
        // Self form LL groups
          $this->calculateLLgroups();
       
       //results  
        
        //  aggregate all results and weight for input context to inherit results priorities  (can be automaic or human decided from UI/control panel
        
        
    } // closes function
    
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
		}
	
    /** Turns clean content arrays into wise list of words for each content item
     *
     * based on frequency used author by wikipedia community (why?  Start crowd source vocabularly)
     * also certain words excluded  CQ and 'joining' words
     *
     */ 
  		public function makeContent($sid, $contid, $contWords)
		{
			// Note: use arrays and not database
			
			// Create a LLDataCleanser object
			$dataContentWisdom = new LLwordWisdom($contWords);
			
			// Clean the data
			$dataContentWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseContent[$sid][$contid] = $dataContentWisdom->wiseWords();
      
		}
	
    /** Given the definition in Core, how alike are they?  
     *
     * identifies matrix of words showing how closely two or more definition are
     * 
     *
     */ 
    public function controlConfusionQuotent($definitionarray)
    {
      // if more than one definition in the universe - look to see if 'the system' will find them confusing to classify?
      // need to keep words that important to a definition
      
      // can we find the most requently used 'joining' words from perform CQ on enough definitions from wikipedia?
      
      // what definitions are 'live' run CQ over them
      // shows total no. words common to two definitions
      // need to feed function the top50 words for each lifestyle definition
      $newCQ = new LLconfusionQuotent($definitionarray);
      $newCQ->defmatseg();
      $newCQ->defmatsegorder();
      
            
  
    } 
    
    /** Matches the wise definition words to those in each content item
     *
     * each content item array is search to see if a definition words is match
     * matched words a ranked for frequency importance and allocate votes based on definition word weighting
     *
     */ 
    public function createLLMatrix($sid)
		{
			// score matrix
			// sub processes,    word frequency, def and posts(input) match top20 and top50 (create code to test/experiment no. of words and matching logic)
			// Use arrays instead of database
      
      $newmatrix = new LLmatrix($this->wiseDefinition, $this->wiseContent[$sid]); 
      // start matrix
      //$newmatrix->startLLmatrix();
      $newmatrix->matrixManager($sid);
      $this->matrix = $newmatrix->matrixComplete();
      //print_r($this->matrix);

		}
    
    /** Start the statistics class that aggregates data on a content source
     *
     * how many content items, how frequency do content items score? etc
     * Calculate average definition score (per scoring content items)
     * Frequency that a source score for each definition
     *
     */ 
		public function calculateLLStats($sid, $defstoscore)
		{
			// Take code from old core/logic/mestats.php
			// Use arrays instead of database
      $newstats = new LLstatistics($this->matrix, $defstoscore);
      $newstats->statisticsManager($sid);
      $this->matrix['avg'] = $newstats->statisticsComplete();
      //print_r($this->matrix['avg']);
      
		}

    /** Community definition averages class
     *
     * given all the framework individual sources in the universe, what is the average of average for that population?
     * 
     *
     */ 
		// average of averages
		public function calculateLLAvgOfAvg()
		{
			// Establish average of averages for each definition(s)
      $newavgs = new LLavgOfavg($this->matrix['avg']);
      $newavgs->AvgofAvgManager();
      $this->avgofavgs = $newavgs->avgOFavgsComplete();
      //print_r($this->avgofavgs);
      
		}
    
    /** Normalization of source data
     *
     * Given the community average and an individual source average
     * calculate that 'distance' as a simple percentage sum (that is the normalization used)
     *
     */     
		public function calculateLLNormalisation()
		{
			//  turns averages to percentages to allow comparison of apples with oranges.
      $newNormalization = new LLnormalization($this->avgofavgs, $this->matrix['avg']);
      $newNormalization->normalizationManager();
      $this->matrix['normdata'] = $newNormalization->normalizeComplete();
      //print_r($this->matrix['normdata']);      
      
		}

    /** Creates list of order sources base on 'distance' from avg.ofavg for each definition 
     *
     * Orders the normalized data for each source, highest to lowest  (maybe square to get rid of negative numbers?)
     * 
     *
     */ 
		public function calculateLLgroups()
		{
			// Take code from old core/logic/social.php and pre ie social folder two files
			// Use arrays instead of database
      // order list of identities by LLorder based on each definition
      $newGroups = new LLgroups($this->matrix['normdata']);
      $newGroups->groupManager();
      $this->lifeGroup = $newGroups->groupsComplete(); 
      //print_r($this->lifeGroup);      
        
		}
    
    /** Given individuals input context (results window) produce best results
     *
     * Uses all available data to produce results
     * What LL science has been used to connect all individuals?
     *
     */     
    public function calculateLLresults($contidsource)
    {
    // produce data to be passed to display
    $newResults = new LLresults($this->matrix);
    $newResults->resultsManager($contidsource);
    $this->results = $newResults->resultsComplete(); 
    
    }
    


// all ingredients formed.  data (array in right form) should be handed over to LLresults-> LLdisplay



    
	}  // closes llcore class

?>
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
    public $matrix;
  //  protected $statistics;
    public $avgofavg;
    protected $lifeGroup;
    protected $results;
    protected $coreobject;
    protected $wiseContent;
    protected $wiseDefinition;
    /**
     * Constructor 
     *
     *
     */
   public function __construct($sourcecontent, $defslive)
		{
		 
      $this->wiseContent = $sourcecontent;  // only the content need to produce results or update
      $this->wiseDefinition = $defslive;  /// only the def should come in that need to be process to get results or update done the quickets/most efficient
      
      $this->LLcoremanager();
      
		} 

    /** Control how all the stages of core are handled
     *
     *
     *
     */ 
    public function LLcoremanager()
    {
    // has information to tag data with so the right combintation of path through core is captured and recorded.
    // ie is this first time use of this data, update, or returning of the whole from a different starting point? 
    // core runs on a PER SOURCE basis (exept break for avgofavg update/calc) before resuming on per source basis, results aggregate data qualifying for results windows from indiv sources.
//echo 'wiseContent in core manager';
//print_r($this->wiseContent);
//echo 'wiseDefintion in core manager';
//print_r($this->wiseDefinition);

       // use this manager function to call other core functions
       

       
       
           // what sources are 'live' for this path?  What definitions are 'live' ie. one def. from startUI or batch of UI for update of LL for all sources
           foreach($this->wiseContent as $sid=>$postwisewords)
           {
            // matrix
              $this->createLLMatrix($sid, $postwisewords);

            // statistics
              $this->calculateLLStats($sid);
            
            // TODO: break to make choice on avgofavg  required for normalization, select local avgofavg. or call out to other apps. or relevant spawning hub e.g mepath.com for sports avgs?
                   // load existing community AverageofAverage values for the 'live' defintion
              //$newavgs = new LLavgOfavg($this->matrix['avg']);  // need to load all existing avg. data, do this here our within LLavgOfavg class? 
              //$this->avgofavg = $newavgs->avgOFavgsComplete();

           
           // normalization
              //$this->calculateLLNormalisation();
              
            }
//echo ' the matrix to be stored';
//print_r($this->matrix);
        // store all the matrix data
        $this->storeMatrixstats($sid, $this->matrix); 
        
        } // closes function
	
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
    public function createLLMatrix($sid, $postwisewords)
		{
			// score matrix
			// sub processes,    word frequency, def and posts(input) match top20 and top50 (create code to test/experiment no. of words and matching logic)
			// Use arrays instead of database
//echo 'wisedef array??';
//print_r($this->wiseDefinition);
      $newmatrix = new LLmatrix($sid, $postwisewords, $this->wiseDefinition); 
      // start matrix
      //$newmatrix->startLLmatrix();
      //$newmatrix->matrixManager();
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
		public function calculateLLStats($sid)
		{
			// Take code from old core/logic/mestats.php
			// Use arrays instead of database
      $newstats = new LLstatistics($sid, $this->matrix, $this->wiseDefinition);
      //$newstats->statisticsManager($sid);
      $this->matrix['avg'] = $newstats->statisticsComplete();
      //print_r($this->matrix['avg']);
      
		}

    /** Store per source its matrix, stats, normalized data
     *
     *
     *
     *
     */     
		public function storeMatrixstats($sid, $matrixstats)
		{
			//  store per source the data created in core
      LLJSON::storeJSONdata($matrixstats, $sid, $contentstage='matrix');
      
      
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
      //$newGroups->groupManager();
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
    //$newResults = new LLresults($this->matrix);
    //$newResults->resultsManager($contidsource);
    //$this->results = $newResults->resultsComplete(); 
    
    }
    


// all ingredients formed.  data (array in right form) should be handed over to LLresults-> LLdisplay


  /** Save this source data to the CORE object
     *
     * 
     *
     */     
    public function saveSource()
    {
    // list of data that need to be held
    $this->coreobject = $this->wiseDefinition;
    $this->coreobject = $this->wiseContent;
    $this->coreobject = $this->matrix;
    $this->coreobject = $this->matrix['avg'];
    $this->coreobject = $this->avgofavgs;
    $this->coreobject = $this->matrix['normdata'];
    $this->coreobject = $this->lifeGroup;
    $this->coreobject = $this->results;
    
    //print_r($this->coreobject);
    return $this->coreobject;
    
    }
    


    
	}  // closes llcore class

?>
<?php
	
	class LLCore {
	
		protected $cleanContent; // array of words from content
		protected $cleanDefinition; // cleaned version of Wiki definiton
    protected $matrix;
  //  protected $statistics;
    protected $avgofavgs;
    protected $lifeGroup;
    protected $results;
    
    
   public function __construct($dataDefinition, $dataContent)
		{
			$this->cleanDefinition = $dataDefinition;
      $this->cleanContent = $dataContent;
		} 
    
		
    public function LLcoremanager($source)
    {
    // utility function to 
    // has information to tag data with so the right combintation of path through core is captured and recorded.
    // ie is this first time use of this data, update, or returning of the whole from a different starting point? 
    // core runs on a PER SOURCE basis (exept break for avgofavg update/calc) before resuming on per source basis, results aggregate data qualifying for results windows from indiv sources.
    //print_r($this->cleanDefinition);
    //print_r($this->cleanContent);
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
          $this->createLLMatrix();

        // statistics
          $this->calculateLLStats();
        
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
	
  
		// tidy data, excluded words (need to crowd source these via confusion )
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
	

    public function createLLMatrix()
		{
			// score matrix
			// sub processes,    word frequency, def and posts(input) match top20 and top50 (create code to test/experiment no. of words and matching logic)
			// Use arrays instead of database
      
      $newmatrix = new LLmatrix($this->wiseDefinition, $this->wiseContent['1']); 
      // start matrix
      //$newmatrix->startLLmatrix();
      $newmatrix->matrixManager();
      $this->matrix = $newmatrix->matrixComplete();
      //print_r($this->matrix);

		}

		// cal stats
		public function calculateLLStats()
		{
			// Take code from old core/logic/mestats.php
			// Use arrays instead of database
      $newstats = new LLstatistics($this->matrix);
      $newstats->statisticsManager();
      $this->matrix['avg'] = $newstats->statisticsComplete();
      //print_r($this->matrix['avg']);
      
		}
	
		// average of averages
		public function calculateLLAvgOfAvg()
		{
			// Establish average of averages for each definition(s)
      $newavgs = new LLavgOfavg($this->matrix['avg']);
      $newavgs->AvgofAvgManager();
      $this->avgofavgs = $newavgs->avgOFavgsComplete();
      //print_r($this->avgofavgs);
      
		}

		// calc avg. of averages
		public function calculateLLNormalisation()
		{
			//  turns averages to percentages to allow comparison of apples with oranges.
      $newNormalization = new LLnormalization($this->avgofavgs, $this->matrix['avg']);
      $newNormalization->normalizationManager();
      $this->matrix['normdata'] = $newNormalization->normalizeComplete();
      //print_r($this->matrix['normdata']);      
      
		}


		// calc melife
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

    // calculat results
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
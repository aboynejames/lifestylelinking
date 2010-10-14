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
    
		
    public function LLcoremanager()
    {
    // utility function to 
    // has information to tag data with so the right combintation of path through core is captured and recorded.
    // ie is this first time use of this data, update, or returning of the whole from a different starting point? 
   
    // make wise Definitions
    foreach ($this->cleanDefinition as $defid=>$defWords) 
    {
    
    $this->createDefinitions($defid, $defWords);
    
    }
    
    // made wise Content
    foreach ($this->cleanContent as $contid=>$contWords)
    {
   
    $this->createContent($contid, $contWords);
    
    }
    
    } // closes function


	public function createDefinitions($defid, $defWords)
		{
			// Note: use arrays and not database
			
			// Call the Wikipedia API for URL for $subject
			
			// Create a LLDataCleanser object
      $dataWisdom = new LLwordWisdom($defWords);
			
			// Clean the data
			$dataWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseDefinition[$defid] = $dataWisdom->wiseWords();
		}
	
  
		// tidy data, excluded words (need to crowd source these via confusion )
		public function createContent($contid, $contWords)
		{
			// Note: use arrays and not database
			
			// Create a LLDataCleanser object
			$dataContentWisdom = new LLwordWisdom($contWords);
			
			// Clean the data
			$dataContentWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseContent[$contid] = $dataContentWisdom->wiseWords();
		}
	

    public function createLLMatrix()
		{
			// score matrix
			// sub processes,    word frequency, def and posts(input) match top20 and top50 (create code to test/experiment no. of words and matching logic)
			
			// Take code from old core/logic/scorematrix.php
			// Use arrays instead of database
      
      $newmatrix = new LLmatrix($this->wiseDefinition, $this->wiseContent); 
      
      // start matrix
      $newmatrix->startLLmatrix();
      $this->matrix = $newmatrix->matrixComplete();
      //print_r($this->matrix);

		}

		// cal stats
		public function calculateLLStats()
		{
			// Take code from old core/logic/mestats.php
			// Use arrays instead of database
      $newstats = new LLstatistics($this->matrix);
      $this->matrix[1][averages] = $newstats->statisticsComplete();
      //print_r($this->statistics);
      
		}
	
		// average of averages
		public function calculateLLAvgOfAvg()
		{
			// Establish average of averages for each definition(s)
      $newavgs = new LLavgOfavg($this->matrix[1][averages]);
      $this->avgofavgs = $newavgs->avgOFavgsComplete();
      
      
		}

		// calc avg. of averages
		public function calculateLLNormalisation()
		{
			//  turns averages to percentages to allow comparison of apples with oranges.
      $newNormalization = new LLnormalization();
      $this->matrix[1][meLife] = $newNormalization->normalizeComplete();
      
		}


		// calc melife
		public function calculateLLgroups()
		{
			// Take code from old core/logic/social.php and pre ie social folder two files
			// Use arrays instead of database
      // order list of identities by LLorder based on each definition
      $newGroups = new LLgroups;
      $this->lifeGroup = $newGroups->groupsComplete(); 
      
      
		}

    // calculat results
    public function calculateLLresults()
    {
    // produce data to be passed to display
    $newResults = new LLresults;
    $this->results = $newResults->resultsComplete(); 
    
    }
    


// all ingredients formed.  data (array in right form) should be handed over to LLresults-> LLdisplay



    
	}  // closes llcore class

?>
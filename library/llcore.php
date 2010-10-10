<?php
	
	class LLCore {
	
		protected $cleanContent; // array of words from content
		protected $cleanDefinition; // cleaned version of Wiki definiton
    
    
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
    
    
    } // closes function


	public function createDefinitions()
		{
			// Note: use arrays and not database
			
			// Call the Wikipedia API for URL for $subject
			
			// Create a LLDataCleanser object
      $dataWisdom = new LLwordWisdom($this->cleanDefinition);
			
			// Clean the data
			$dataWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseDefinition = $dataWisdom->wiseWords();
		}
	

		

		// tidy data, excluded words (need to crowd source these via confusion )
		public function createContent()
		{
			// Note: use arrays and not database
			
			// Create a LLDataCleanser object
			$dataContentWisdom = new LLwordWisdom($this->cleanContent);
			
			// Clean the data
			$dataContentWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseContent = $dataContentWisdom->wiseWords();
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
      
      
		}
	
		// average of averages
		public function calculateLLAvgOfAvg()
		{
			// Take code from old core/logic/melife.php
			// Use arrays instead of database
      
      
		}

		// calc melife
		public function calculateLLNormalisation()
		{
			// Take code from old core/logic/melife.php
			// Use arrays instead of database
      
      
		}


		// calc melife
		public function calculateLLgroups()
		{
			// Take code from old core/logic/social.php and pre ie social folder two files
			// Use arrays instead of database
      // order list of identities by LLorder based on each definition
      
      
		}

// all ingredients formed.  data (array in right form) should be handed over to LLresults-> LLdisplay



    
	}  // closes llcore class

?>
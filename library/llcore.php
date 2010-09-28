<?php
	require_once 'lldatacleanser.php';

	class LLCore {
	
		protected $postWords; // array of words from content
		protected $cleanDefinition; // cleaned version of Wiki definiton
		protected $cleanContent; // cleand version of content (e.g. blogposts)
	
		// populate the index array from a string of text
		// TODO: Define to the world the format of the postWords array
		public function populateArray($arrayOfWords)
		{
			// TODO: Check that postWords is in the correct format
		
			$this->postWords = $arrayOfWords;
		}

		// build the definitions from the wikipedia description
		// defintions and those to be scored
		public function buildDefinitions($subject)
		{
			// Note: use arrays and not database
			
			// Call the Wikipedia API for URL for $subject
			
			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($wikipediaDefinition);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanDefinition = $dataCleaner->cleanedData();
		}
	
		// tidy data, excluded words (need to crowd source these via confusion )
		public function cleanseData()
		{
			// Note: use arrays and not database
			
			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($this->postWords);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanContent = $dataCleaner->cleanedData();
		}
	
		public function createLLMatrix()
		{
			// score matrix
			// sub processes,    word frequency, def and posts(input) match top20 and top50 (create code to test/experiment no. of words and matching logic)
			
			// Take code from old core/logic/scorematrix.php
			// Use arrays instead of database
		}

		// cal stats
		public function calculateLLStats()
		{
			// Take code from old core/logic/mestats.php
			// Use arrays instead of database
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
	}  // closes llcore class

?>
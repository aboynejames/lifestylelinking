<?php

class LLcontent
{

     protected $contentin;  // input from e.g. rss feedreader 
     
     
     		public function contentData($contentraw)
		{
			// TODO: Check that postWords is in the correct format
		
			  $this->contentin = $contentraw;
    
		}
     
    // call wikipedia api to retrive source definition content 
		public function buildContent()
		{
			// Note: use arrays and not database

			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($this->contentin);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanContent = $dataCleaner->cleanedData();
            
    
		}




  }  // closes class
  
  
  ?>

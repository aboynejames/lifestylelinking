<?php

	class LLResults
	{
		// 1. input context and filter status
    
    
    protected $meresults;
		
		public function defineResultsWindow() 
		{
     // 1. set context for results (time, filter context, sources, identity)
     
     
		}
		
		// Use average ll science
		public function averageResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}
		
		// Use personalised filtered ll science
		public function personalisedFilteredResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}
		
		// Use personalised unfiltered ll science
		public function personalisedUnfilteredResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}
		
		// Use experimental ll science
		public function experimentalResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}








  	public function resultsComplete()
		{
      // 
      $this->meresults = array('1' => '1');
      //print_r($this->meresults);
      return $this->meresults;
  
    } 



}  // closes class

?>
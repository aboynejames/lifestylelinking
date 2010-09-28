<?php

	class LLResults
	{
		// Use old core/logic/dailyresults.php
		
		public function defineResultsWindow() 
		{
			
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
		
		// peergroups (maybe a different class for variations)
		public function buildLLGroups()
		{
			// Ordering list of sources
		}
	}
?>
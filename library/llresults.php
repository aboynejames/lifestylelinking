<?php
/**
 * LifestyleLinking
 *
 * Take all LL data to produce results based on input context (results window)
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Calcluates results
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLResults
	{
		//  what is the Lifestylelinking logic to use for results  ie how is all life connected?  start in context of same definition, science to add together lifestyle logic (to be found chaos theory?)
		
		public function defineResultsPath() 
		{
		
      //  user intention  or daily update of all (or part or rescoring due to new data)
      
      
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
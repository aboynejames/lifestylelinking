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
    
        /**
     * Constructor 
     *
     * Setup of new or existing Framework settings 
     *
     * Data input from the UI
     *
     * @param  int  $individual    owner of frameworks id
     *
     */
   public function __construct($lifestylebuild, $LLlogic, $timeperiod)
		{
		
    $this->lifestylemenu = $lifestylebuild;
    $this->pathlogic = $LLlogic;
    $this->pathtime = $timeperiod;
   
 		} 
		    
    /**  
     *
     * 
     *
     */ 
		public function resultsManager() 
		{
		
    // make sure relevant data is live in memory if not co ordinate other class to get all data ready to go, updated and LL logic flexibility
    
    // given lifestylelogic settings prepare relevant peergroups
    
    // prepare weighted listing of qualifying results
    
    // publish raw JSON (ready for api export or delivery to display formatting before published to the web.
     
      
		}
		
    
    
    
    
    
    /**  
     *
     * 
     *
     */ 
		public function buildPeers($peerlogic)
		{
			// extration of correct peergroup
			$peerlist = new LLgroups();
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
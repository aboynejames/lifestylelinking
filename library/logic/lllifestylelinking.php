<?php
/**
 * LifestyleLinking
 *
 * Lifestyelinking logic class
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * LifestyleLinking logic class
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLlifestylelinking
{
  
  //  
  protected $melife;
  protected $peerdata;
  protected $scorestatdatalive;

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
   public function __construct($meid, $logiclinking, $linkdefinition, $linksources, $livecommaverage, $livedefinition)
		{
		
      $this->meidentity = $meid;
      $this->lifestylelogic = $logiclinking;
      $this->definitionlink = $linkdefinition;
      $this->sourceslink = $linksources;
      $this->currentavgofavg = $livecommaverage;
      $this->currentdefinition = $livedefinition;

      $this->LLlogicmanager();
  
 		} 
    
    /** 
     *
     *
     */
      public function LLlogicmanager()
      {
      //   what is the LL logic applied, a single defintions (start) , or upto top 5lifestyle definition and eventually dynamic equation(via discovery engine - auto or manual UI switch on off (now))  
      
          // what definitions and sources will need to be normalized?
          if($this->lifestylelogic == 'single')
          {

            $this->calculateLLNormalisation();
            $this->buildPeers();
            
          }
          
          else
          {
           // will be an array of definitions and sources that need to be 
           //  for lifestyle definitions to be linked on, there is a. order, b. no. of lifestyles,  update 'live' and accept historical for rest or update all?
          
          //  $this->calculateLLNormalisation();
          //  $this-> buildPeers($identity, $peerlogic);
             
          
          }
           
      }
  
  
    /** Normalization of source data
     *
     * Given the community average and an individual source average
     * calculate that 'distance' as a simple percentage sum (that is the normalization used)
     *
     */     
		public function calculateLLNormalisation()
		{
			//  turns averages to percentages to allow comparison of apples with oranges.
      $newNormalization = new LLnormalization($this->currentavgofavg, $this->sourceslink, $this->currentdefinition);  // 1st, commmunity avg. 2nd live source being normalized
      //$newNormalization->normalizationManager();
      $this->melife['normdata'] = $newNormalization->normalizeComplete();
      $this->scorestatdatalive = $newNormalization->sourceScorestatsData();
//print_r($this->matrix['normdata']);      
//print_r($newNormalization);            
		}
    
    /**  
     *
     * 
     *
     */ 
		public function buildPeers()
		{
			// extration of correct peergroup
      // single lifestyle connection for now ie.  swimming order peer groups on all those sources scoring for that lifestyle definitions
      // will get more complicated as  logic will equal  this source has order of lifestyle 1. swimming, 2, skiing, 3. hillwalking,  then filter on that basis in that priority, could be top 5 top10   this will require a how new science to be developed (give User UI filter tools mean time and discovery engine./platform will find out connect in orders and wieights of lifestyle defintions connections  definitions to DNA ie how all life is connected) 
      
			$peerlist = new LLgroups($this->meidentity, $this->currentdefinition, $this->melife['normdata']);
//print_r($peerlist);      
      $this->peerdata = $peerlist->groupsComplete();
		}
 
    /**  
     *
     * 
     *
     */ 
		public function logicapplied()
		{ 
  
  
      return ;
        
     }
  

    
     /**  
     *
     * 
     *
     */ 
     public function returnscorestatdatalive()
		{
      
      return  $this->scorestatdatalive; 
  
    } 

     /**  
     *
     * 
     *
     */ 
     public function lldatareturn()
		{
      
      return  $this->peerdata; 
  
    } 
  
  
}  // closes class
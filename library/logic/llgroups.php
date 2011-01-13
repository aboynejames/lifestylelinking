<?php
/**
 * LifestyleLinking
 *
 * Creates list of peer groups for each context/definition 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Applies LL logic to pull together sources of feeds around lifestyle.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLgroups
{
       //
    protected $normalinput;
    protected $peerGroup;

    public function __construct($identity, $peerlogic)
		{
    
      $this->meidentity = $identity;
      $this->normalinput = $peerlogic;
      $this->groupManager();
      //print_r($this->normalinput);
    }
    
    /**  
     *
     * 
     *
     */ 
    public function groupManager()
    {
      // pickup llLogic ie. default single defintion linking this can be 1. assume annon user therefore 'average' used or 2. blog url added personalize on their placing to average.
      
        // need to add a loop foreach individual identity source 
        foreach($this->normalinput as $sid=>$dids)
        {
        //print_r($dids);
              // order each source top diff positive to negative
                foreach($dids as $did=>$davg)
                {
                //print_r($this->normalinput[$sid][$did]);
                $defgrouparray[$did][$sid] =  $this->normalinput[$sid][$did];
                
                }
         //$this->buildPeergroups($did, $defgrouparray);
          
        }
          //print_r($defgrouparray);
          $this->buildPeergroups($dids, $defgrouparray);
    
    }
    
    /**  
     *
     * 
     *
     */ 
    public function buildPeergroups($dids, $defgrouparray)
    {
    // given all the identities, list them in an order based on 'normalized distance from average'
    //echo 'buld group';
    //print_r($dids);
        foreach($dids as $did=>$davgs)
        {
        //print_r($defgrouparray[$did]);
        asort($defgrouparray[$did]);
        $this->peerGroup =  $defgrouparray;
        }
        
    //print_r($this->peerGroup);
    }
    
     /**  
     *
     * 
     *
     */ 
     public function groupsComplete()
		{
      //print_r($this->peerGroup);
      return $this->peerGroup;
  
    } 

} // closes class

?>
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

    public function __construct($peerlogic)
		{
    
      $this->normalinput = $peerlogic;
      $this->peerManager();
      //print_r($this->normalinput);
    }
    
    /**  
     *
     * 
     *
     */ 
    public function peerManager()
    {
      // what sort of list, 1. assume average, 2 personalized on idenitity of individual  (could be lists by aggregating or add various lifestyle defs together e.g swimming + trialthon ie a swimmer that also does triathlon.
      
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
<?php


class LLgroups
{
       //
    protected $normalinput;
    protected $peerGroup;

    public function __construct($normalin)
		{
    
      $this->normalinput = $normalin;
      //print_r($this->normalinput);
    }
    
    
    public function groupManager($contidarray)
    {
      // what sort of list, 1. assume average, 2 personalized on idenitity of individual  (could be lists by aggregating or add various lifestyle defs together e.g swimming + trialthon ie a swimmer that also does triathlon.
      $source = $contidarray;
      // average list  do per lifestyle definition
      $defids = array('0'=>'1', '1'=>'2');
      
        // need to add a loop foreach individual identity source 
        foreach($source as $sid=>$cid)
        {
              // order each source top diff positive to negative
                foreach($defids as $did)
                {
                //print_r($this->normalinput[$sid][$did]);
                $defgrouparray[$did][$sid] =  $this->normalinput[$sid][$did];
                
                }
         //$this->buildPeergroups($did, $defgrouparray);
          
        }
          //print_r($defgrouparray);
          $this->buildPeergroups($defids, $defgrouparray);
    
    }
    

    public function buildPeergroups($defids, $defgrouparray)
    {
    // given all the identities, list them in an order based on 'normalized distance from average'
    //echo 'buld group';
    foreach($defids as $did)
    {
    //print_r($defgrouparray[$did]);
    asort($defgrouparray[$did]);
    $this->peerGroup =  $defgrouparray;
    }
    
    //print_r($this->peerGroup);
    }
    
  	public function groupsComplete()
		{
      //print_r($this->peerGroup);
      return $this->peerGroup;
  
    } 

} // closes class

?>
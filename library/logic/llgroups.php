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
    protected $currentdefid;
    protected $peerGroup;

    public function __construct($meidentity, $currentdefinition, $normalizeddata)
		{
    
      $this->meidstatus = $meidentity;
      $this->currentdefid = $currentdefinition;
      $this->normalinput = $normalizeddata;
//echo 'innto groups';
//print_r($this->normalinput);
      $this->groupManager();

    }
    
    /**  
     *
     * 
     *
     */ 
    public function groupManager()
    {
      // pickup llLogic ie. default single defintion linking this can be 1. assume annon user therefore 'average' used or 2. blog url added personalize on their placing to average.
      
        $this->buildPeergroups($this->currentdefid, $this->normalinput);
          
          //$this->grouplistlogicapplied();, $defgrouparray);
          
        //$this->grouplistlogicapplied();
      
     /* 
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
          
        }
//print_r($defgrouparray);
*/
    
    }
    
    /**  
     *
     * 
     *
     */ 
    public function buildPeergroups($did, $defgrouparray)
    {
     // given all the identities, list them in an order based on 'normalized distance from average'
//echo 'buld group';
//print_r($dids);

        foreach($defgrouparray as $sid=>$normdata)
        {
//print_r($normdata);
//echo $normdata[$did];
         $extractnormdata[$sid] = $normdata[$did]; 
        
        }
        
         
        arsort($extractnormdata);
        $this->peerGroup = $extractnormdata;

/*
        foreach($dids as $did=>$davgs)
        {
        //print_r($defgrouparray[$did]);
        asort($defgrouparray[$did]);
        $this->peerGroup =  $defgrouparray;
        }
   */     
//echo 'peergrouplowtohigh';
//print_r($this->peerGroup);
     }
    
    /**  
     *
     * 
     *
     */ 
     public function grouplistlogicapplied()
		{
      // given lifestylelinking and meidenity tailor source that are linked.
     
         if(isset($meid) == 1 )
         {
           // given source position in group, take 10% either side  why 10%?  (should be crowd sourced)
           //$this->personalizeGroupsources();
         
         
         }
         else
         {
          // display based upon top sources ie leave peerGrouplist as it is
      
         }
  
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

     /**  
     *
     * 
     *
     */ 
     public function personalizeGroupsources()
		{

        //how many source are in full lifestylefeedgroup
        $indpeers = count($this->peerGroup);
//echo $indpeers.'nofeeds<br />';
//80-20 rule used for now 
        $peertwenty = $indpeers * 0.1 ;
        //echo $peertwenty.'20% feeds<br />';

        $steps = new Steps();
        $poslist = array();

            foreach ($perdiffarr[$unid] as $key=>$reindex)
            {

             $steps->add($key);  
             
             }
         //echo 'listorder';
         //print_r($steps->all);
         $feedindv = $pfma;
         //echo 'indiv feedid'.$feedindv.'<br /><br />';
        // set this individuals avg. position
         $steps->setCurrent($feedindv);

            for ($i = 1; $i <= $peertwenty; $i++)
            {
              
            //echo $i;
            //echo $steps->getNext().'<br>';
            $newset = $steps->getNext();
            $indivset = $steps->setCurrent($newset);

                if (strlen($newset) > 0) 
                {

                $poslist[] = $newset;

                }

            }
        //print_r($poslist);
        $steps->setCurrent($feedindv);

            for ($i = 1; $i <= $peertwenty; $i++)
            {
              
            //echo $i;
            //echo $steps->getPrev().'<br>';
            $newset = $steps->getPrev();
            $indivset = $steps->setCurrent($newset);

                if (strlen($newset) > 0)
                {

                $poslist[] = $newset;

                }
           }
    }



} // closes class


     /**  
     * class to find list of personalized peergroups
     * 
     *
     */ 
    class Steps
    {
  
    public $all;
    private $count;
    private $curr;
  
    public function __construct ()
    {
    
      $this->count = 0;
    
    }
  
    public function add ($step)
    {
    
      $this->count++;
      $this->all[$this->count] = $step;
    
    }
  
    public function setCurrent ($step)
    {
    
      reset($this->all);
      for ($i=1; $i<=$this->count; $i++)
      {
        if ($this->all[$i]==$step) break;
        next($this->all);
      }
      $this->curr = current($this->all);
    
    }
  
    public function getCurrent ()
    {
    
      return $this->curr;
    
    }
  
    public function getNext () 
    {
          self::setCurrent($this->curr);
          return next($this->all);
    
    }
   
    public function getPrev () 
    {
    
      self::setCurrent($this->curr);
      return prev($this->all);
    
    }
      
  }  // closes class
  
?>
<?php


class LLnormalization
{
       //
       protected $avgavgcomm;
       protected $indivavg;
       protected $normalMe;


    public function __construct($avgofavg, $indavgarray)
		{
    // need avg of avg array & array for each defintion per individual source
    $this->avgavgcomm = $avgofavg;
    $this->indivavg = $indavgarray;
    //echo 'in normalization';
    //print_r($this->avgavgcomm);
    //echo 'indv avg';
    //print_r($this->indivavg);
    }


   public function normalizationManager ()
		{
      // need to take each individual definition average and 
      $indid = 1; 
      $defids = array('0'=>'1', '1'=>'2');
        
       // need to add a loop foreach individual identity source 
        
        foreach($defids as $did)
          {
          
          $this->normalizeDistances($indid, $did, $avgavgcomm[$did]);
          
          }
      
    }


    public function normalizeDistances($inid, $did, $avgDef)
    {
    // need to build arrays to perform calculations on
    // sum is   each identity average / average value for a whole defintion
    //echo 'norm number';
    //print_r($this->indivavg[$inid][$did]);
    $indivavg = $this->indivavg[$inid][$did][3];
    $diffsum = (($indivavg-$avgDef)/$avgDef)*100;
    $diffpercent = round($diffsum, 2);
    $this->normalMe[$inid][$did] = $diffpercent;
    
    }

  	public function normalizeComplete()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->normalMe);
      return $this->normalMe;
  
    } 

}  // closes class

?>
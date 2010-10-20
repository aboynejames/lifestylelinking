<?php


class LLavgOfavg
{
  
  // calculates average of average for any given definition (note definitions could be wikipedia or unverisal measurement + an identity e.g. blood pressure data)
  // perform on a per framework basis and in context of all decentralized LLdata in the universe
  
  	protected $avgraw;	
    protected $averageofaverages;
    
    public function __construct($avgrawarray)
		{
      
      $this->avgraw = $avgrawarray;
      print_r($this->avgraw);
     }
	
    
   public function AvgofAvgManager ()
		{
      // how many individual sourceids? How many definitions  (should pick this up from framework manager)
    $indid = 1; 
    $defids = array('0'=>'1', '1'=>'2');
   
    $avgstart = $this->buildAvgofAvg($indid, $defids);
          
          foreach($defids as $did)
          {
          
          $this->calculateAvgofAvg($did, $avgstart);
          
          }
      
    }
     
     
  	public function buildAvgofAvg ($indid, $defids)
		{
        // find out latest avg avg data, extra from existing array data held in core or will this be done before entering this class? need to think
        // already done and inputted correctly above
          //echo 'build';
         // print_r($this->avgraw);
          $avgtotal = count($this->avgraw);
                foreach($defids as $did)
                {
                  //print_r($this->avgraw[$indid][$did]);
                  $aggscore[$did]= $this->avgraw[$indid][$did][3];
                }
                
            
       $avgavginput[0] = $avgtotal;
       $avgavginput[1] = $aggscore;
      // print_r($avgavginput);
       return $avgavginput;

    } 
    
    
  	public function calculateAvgofAvg ($did, $avgstart)
		{
      // takes above array and performs average calculation ie. sum of no. averages / no. of averages per a definition
     //  sum averages
     //print_r($avgstart); 
     $noavgs = $avgstart[0];
     $avgavgsum = $avgstart[1][$did];

      // divide by total no. of averages
      $this->averageofaverages[$did] = ($avgavgsum/$noavgs);
      
    }
    
    
     	public function avgOFavgsComplete()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->averageofaverages);
      return $this->averageofaverages;
  
    }  
    
    
}  // closes class    
?>    
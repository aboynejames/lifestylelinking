<?php
/**
 * LifestyleLinking
 *
 * Given a community of sources, for each definition was the average of the average value per definition? 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Wisdom of the crowd average aggregation calculation
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLavgOfavg
{
  
  // calculates average of average for any given definition (note definitions could be wikipedia or unverisal measurement + an identity e.g. blood pressure data)
  // perform on a per framework basis and in context of all decentralized LLdata in the universe
  
  	protected $avgraw;	
    protected $averageofaverages;
    
     /**
     *  
     *
     *  
     *
     */   
    public function __construct($avgrawarray)
		{
      
      $this->avgraw = $avgrawarray;  // the live source content average live in Core
echo 'new average data';
print_r($this->avgraw);
      
      $this->AvgofAvgManager(); 
      
     }
	
     /**
     *  
     *
     *  
     *
     */   
   public function AvgofAvgManager ()
		{
      // done per source basis but need to add existing avg. source data in (if it exists)
   // check for community avgofavgs numbers from the network
    //$this->networkAvgofAvgs();
    
    $avgstart = $this->buildAvgofAvg();
          
      foreach($avgstart['aggscore'] as $did=>$davgs)
      {
      
       $this->calculateAvgofAvg($did, $avgstart);
      
      }
      
     $this->storeAvgOfAvg();
      
    }
     
     /**
     *  
     *
     *  
     *
     */    
    public function networkAvgofAvgs ()
    {
    // ask LL community if network averages exist for this definition, user RDF dipedia to make the request (maybe lifestylinking.net or mepth.com api query for now?)
    
    // first reach out to network rdf and known apis where averages exist.  (does user want to do this?)
    
    
    
    }
     
    /**
     *  
     *
     *  
     *
     */   
  	public function buildAvgofAvg ()
		{
        // find out latest avg avg data, extra from existing array data held in core or will this be done before entering this class? need to think
        
        // import existing source average date for this defintion
        $existingavgs =  $this->loadexistingAverages();
echo 'existing averageofaverage data';
print_r($existingavgs);
        // live source matrixstatsdata is the source avg data passed to the constructor
        if($existingavgs ['start'] !== 'empty')
        {
        $communitystats = array_merge($this->avgraw, $existingavgs);
        
        }
        
        else
        {
        
        $communitystats = $this->avgraw;
        
        }
    

           foreach($communitystats  as $sid=>$dids)
          {
//print_r($sid);
//print_r($dids);
               // print_r($this->avgraw);
                $avgtotal = count($this->avgraw);
                      foreach($dids as $did=>$defavg)
                      {
                        //print_r($did);
                        //echo $defavg['3'];
                        $aggscore[$did][$sid] = $defavg['3'];
                      }
                      
           }
           
       $avgavginput['avgtot'] = $avgtotal;
       $avgavginput['aggscore'] = $aggscore;
//print_r($avgavginput);
       return $avgavginput;

    } 
    
   /**
     *  
     *
     *  
     *
     */   
  	public function loadexistingAverages()
		{ 
      // load the lifestyleaverages JSON file to see if existing average data exists
          
    $existingaverages = LLJSON::importJSONdata($sid = 0, $stage='lifestyleaverage');
           
    return $existingaverages;
    
    }
    
     /**
     *  
     *
     *  
     *
     */   
  	public function calculateAvgofAvg ($did, $avgstart)
		{
      // takes above array and performs average calculation ie. sum of no. averages / no. of averages per a definition
     //  sum averages
//print_r($avgstart); 
     $noavgs = $avgstart['avgtot'];
     $avgavgsum = array_sum($avgstart['aggscore'][$did]);

      // divide by total no. of averages
      $this->averageofaverages[$did] = ($avgavgsum/$noavgs);
      
    }

    /**
     *  
     *
     *  
     *
     */  
     public function storeAvgOfAvg()
		{
          // store source content data
      LLJSON::storeJSONdata($this->averageofaverages, $did = 0, $contentstage='lifestyleaverage');
    
    
    }
    
    /**
     *  
     *
     *  
     *
     */  
     	public function avgOFavgsComplete()
		{
      // loadup exlcluded works if not alreadyloaded
echo 'avg of avg to pass to core';
print_r($this->averageofaverages);
      return $this->averageofaverages;
  
    }  
    
    
}  // closes class    
?>    
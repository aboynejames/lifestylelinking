<?php
/**
 * LifestyleLinking
 *
 * Normalization of source averages compared to a community average 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Calculates a normalizaton based on a simple percentage
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	

class LLnormalization
{
       //
       protected $avgavgcomm;
       protected $indivavg;
       protected $normalMe;
       protected $loadedaverages;
       protected $existingsourceavg;

    /**
     *  
     *
     *  
     *
     */
    public function __construct($avgofavg, $listofsourcestonormalize, $definitionlive)
		{
    // need avg of avg array & array for each defintion per individual source
     $this->avgavgcomm = $avgofavg;
     $this->indivsourceids = $listofsourcestonormalize;
     $this->setdefinition = $definitionlive;
//print_r($this->indivsourceids);
//echo 'in normalization';
//print_r($this->avgavgcomm);
//echo 'indv avg';
//print_r($this->indivavg);

    $this->normalizationManager();

    }

    /**
     *  
     *
     *  
     *
     */
   public function normalizationManager ()
		{
      // need to take each individual definition average
      // first extract out the average data from the sources (local, network, whole universe)
      $this->loadedaverages = $this->loadaveragedata($this->indivsourceids);
echo 'loaded matrix data start';
print_r($this->loadedaverages);
        
       // need to add a loop foreach individual identity source 
        foreach($this->avgavgcomm as $did=>$avgv)
          {
          
                foreach($this->loadedaverages as $sid=>$savg)
                {
                  //echo 'def avg'.$this->avgavgcomm[$did];
                  $this->normalizeDistances($sid, $did, $avgv, $savg);
                }
        
          }
          
      
    }

    /**
     *  
     *
     *  
     *
     */
    public function loadaveragedata($sourceids)
    {
    
//echo 'source array in nnormalization';
//print_r($sourceids);
        foreach($sourceids['source'] as $sid=>$sdetail)
        {
          
          $this->existingsourceavg[$sid] = LLJSON::importJSONdata($sid, $stage='matrix');
        
        }
    
    // simplify to average data per source
    foreach($this->existingsourceavg as $sid=>$smatrix)
    {
//print_r($smatrix['avg']);
      $sourceaverages[$sid] = $smatrix['avg'];
      
          foreach($smatrix['avg'] as $sid=>$avgdata)
          {
//print_r($avgdata);
                 $sourceaverages[$sid] = $avgdata[$this->setdefinition][3];
          
          }
     
    }
    
    return $sourceaverages;
    
    }

    /**
     *  
     *
     *  
     *
     */
    public function normalizeDistances($sid, $did, $avgDef, $sourceavg)
    {
    // need to build arrays to perform calculations on
    // sum is   each identity average / average value for a whole defintion
    //echo $avgDef;
    //echo 'norm number';
    //print_r($this->indivavg[$sid][$did]['3']);
    //$indivavg = $this->indivavg[$sid][$did]['3'];
    $diffsum = (($sourceavg-$avgDef)/$avgDef)*100;
    $diffpercent = round($diffsum, 2);
echo 'percent'.$diffpercent;
    $this->normalMe[$sid][$did] = $diffpercent;
    
    }

    /**
     *  
     *
     *  
     *
     */
  	public function sourceScorestatsData()
		{

      return  $this->existingsourceavg;
  
    } 

    /**
     *  
     *
     *  
     *
     */
  	public function normalizeComplete()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->normalMe);
      return $this->normalMe;
  
    } 

}  // closes class

?>
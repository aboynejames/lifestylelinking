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
	public function __construct($avgofavg, $matrixavglive, $listofsourcestonormalize, $definitionlive)
	{
	// need avg of avg array & array for each defintion per individual source
	$this->avgavgcomm = $avgofavg;
	$this->livematrixavg = $matrixavglive;
	$this->indivsourceids = $listofsourcestonormalize;
	$this->setdefinition = $definitionlive;
//print_r($this->avgavgcomm);
//echo 'in normalization';
//print_r($this->livematrixavg);
//echo 'indv avg';
//print_r($this->indivsourceids);
//echo 'setdef';
//print_r($this->setdefinition);


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
	// take livematrix and live avgofavg and perform normalization
	
	
       // need to add a loop foreach individual identity source 
        foreach($this->avgavgcomm as $did=>$avgv)
          {
          
                foreach($this->livematrixavg as $sid=>$savg)
                {
//echo 'def avg'.$this->avgavgcomm[$did];
                  $this->normalizeDistances($sid, $did, $avgv['davg'], $savg[$did]['avgscore']);
                }
        
          }
          
      
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
//echo 'percent'.$diffpercent;
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
//echo 'nornalizedddd';
//print_r($this->normalMe);
	return $this->normalMe;

	} 


}  // closes class

?>
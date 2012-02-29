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
  
	protected $avgdefid;	
	protected $existingdefavg;
	protected $averageofaverages;
	protected $definitionarray;
	
	/**
	*	  
	*
	*	  
	*
	*/   
	public function __construct($averagedef, $wiseDefinitionin)
	{
      
	$this->avgdefid = $averagedef;  // the live source content average live in Core
//echo 'new average data required';
//print_r($this->avgdefid);
	$this->definitionarray = $wiseDefinitionin;
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
	//  need to check that the 'current' avgofavg might be in update and live in an object?
	
	//otherwise, query couchdb view and perform avgofavg calculations and set them live
	$this->averageofaverages = $this->formAVGOFAVGdata ();
 
	    
	   // check for community avgofavgs numbers from the network
	    //$this->networkAvgofAvgs();
	    
	    
	    
	}
     
    /**
     *  
     *
     *  
     *
     */    
    public function getavgofavglive ()
    { 
    
    
    }

    /**
     *  
     *
     *  
     *
     */    
    public function formAVGOFAVGdata ()
    { 
    
    // what definition name?
	
	foreach($this->definitionarray as $dkey=>$klists)
	{
	$dkey;
	}

    
    
    // setup couchview (if not set up)
  //   $client = new couchClient ('http://localhost:5984','lifestylelinking');
/*     
    $view_fn="function(doc) {
	if(doc.matrixstats['avg'])
	{

	emit(doc.matrixstats['avg'], null);
	}
}";
	$design_doc->_id = '_design/avgofavgs';
	$design_doc->language = 'javascript';
	$design_doc->views = array ( 'by_avgofavgs'=> array ('map' => $view_fn ) );
	$client->storeDoc($design_doc);
*/
	// query couchdb  view called
//	$result = $client->getView('avgofavgs','by_avgofavgs');
//echo 'couchdb object daataa  avvvvofavvvvg';	 
//print_r($result);
	 
	 
	 $liveaverages = array($dkey=>array("davg"=> 20 , "dfscoreavg"=> 0.76 ));
	 
	return $liveaverages;
    
    
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
 //       $existingavgs =  $this->loadexistingAverages();
//echo 'existing averageofaverage data';
//print_r($existingavgs);
        // live source matrixstatsdata is the source avg data passed to the constructor
 
 
 
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
     	public function avgOFavgsComplete()
	{
	// loadup exlcluded works if not alreadyloaded
//echo 'avg of avg to pass to core';
//print_r($this->averageofaverages);
	return $this->averageofaverages;
  
    }  
    
    
}  // closes class    
?>    
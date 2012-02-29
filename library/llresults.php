<?php
/**
 * LifestyleLinking
 *
 * Take all LL data to produce results based on input context (results window)
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Calcluates results
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLResults
{
//  what is the Lifestylelinking logic to use for results  ie how is all life connected?  start in context of same definition, science to add together lifestyle logic (to be found chaos theory?)
    
    protected $melife; 
    protected $definitionidliv;
    protected $resultsin;
    protected $linkingdata;
    protected $postdatalive;
    protected $postqualify;
    protected $resultsready;
    protected $lifestyleword;
    protected $pathidset;
    protected $resultsid;
    
    /**
     * Constructor 
     *
     * Setup of new or existing Framework settings 
     *
     * Data input from the UI
     *
     * @param  int  $individual    owner of frameworks id
     *
     */
	public function __construct($resultsidentity, $lifestylebuild, $inpath, $livelistsource, $liveavgofavg, $livematrix )
	{
		
	$this->personalizedid = $resultsidentity;
	$this->lifestylemenu = $lifestylebuild;
	$this->pathtaken = $inpath;
	$this->linkinglogic = $inpath['logic'];
	$this->pathperiod = $inpath['timebatch'];
	$this->resultsfilter = $inpath['filter'];
	$this->starttime = $inpath['starttime'];
	$this->endtime = $inpath['endtime'];
	$this->sourcesinresults = $livelistsource;
	$this->livecommaverage = $liveavgofavg;
	$this->livematrixcurrent = $livematrix;
//echo 'live matrix in resultttts';
//print_r($this->livematrixcurrent);    
	$this->resultsManager();

	} 
		    
    /**  
     *
     * 
     *
     */ 
	public function resultsManager() 
	{
    
	//TODO construct a mechanism to figure out what is the best path to form results (resultspath class might work this out when build)
    
	// how are the results being formed?  1. filter post on time?  2. lifestylelinking logic, 3. filtered/unfiltered ie in context post, any context post of LL sources
      
	// extract definition id from livedefinition
	$this->definitionidlive = key($this->lifestylemenu); 
//echo 'definition live in resultttttts'.$this->definitionidlive;   
	// make sure relevant data is live in memory if not co ordinate other class to get all data ready to go, updated and LL logic flexibility
	// two types, first arrays of time, source post ids  and then the fuller content (but only those that make the results)
	// needs to be called here to get source posts authored time (should have this in seperate data to 'lighter' loading?
   
		// if results already processed then get those and then update all info. in universe and show that in realtime?
		if( ($this->pathtaken['intention'] == 'newstart')  ||  ($this->pathtaken['intention'] == 'controlpanel') )
		{
$this->sourcesinresults = 2;		
		    if(count($this->sourcesinresults) >= 1 )
		    {
		    
		    // create a unique results id and link it to the path and lifestyle definition 
		    $this->resultsid = $this->setresultsid();
		    
		    
		    // pick out source/post that meet the time constraint
		    $this->resulttime();
		    

		    // apply lifestylelinking logic this will set normalization and groups required.
		    $this->applylifestylelinking();

		    //  given time window,  and whether filter is on or off and LLlogic build array of relevant data
		    $this->livescoreldef = $this->buildresultsarray($this->definitionidlive);
//echo 'livescoredefdata';
//print_r($this->livescoreldef);
		    // prepare weighted listing of qualifying results
		    $this->makeresults();
		  
		    // publish raw JSON (ready for api export or delivery to display formatting before published to the web.
		    $this->resultsJSON();
		    
		    }
		    else 
		    {
		    // all that can be done is display the one source data in results
		    
		    }
		  
		}
		else 
		{
		  // results are already prepared (TODO but how long ago?  Need to be constantly updating)
		  //$this->resultsready = LLJSON::importJSONdata($this->pathtaken['resultsid'], $stage='liveresults');  // load existing results array prepared
		  
		
		}

           
	}   

    /** 
     * 
     * 
     *
     */     
	public function setresultsid ()
	{
	// set unique results id
	$uniqueresultform = $this->pathtaken['pathid'].$this->pathtaken['endtime'];
//echo 'formresultsid'.$uniqueresultform;
	$ram = sha1($uniqueresultform);
    
	//$shortjam = strlen($jam, 16);
	$shortresults = substr($ram, 0, 16);
    
	return $shortresults;
    
	}



    /** 
     * 
     * 
     *
     */     
	public function resulttime ()
	{
	//  look at results array and limit to times selected via UI

	$this->starttime = 1233660900;
	$this->endtime = 1328966121 ;
	
	// query couchDB by_date view to build array of time relevant posts
	    // setup couchview (if not set up)
	$client = new couchClient ('http://localhost:5984','lifestylelinking');
	// query couchdb  view called
	$resulttime = $client->asArray()->startkey($this->starttime)->endkey($this->endtime)->getView('postdate','by_postdate');
//echo 'couchdb date list of posts';
//print_r($resulttime);
	// use list of time relevant post to ...
	
	// need to covert this into an array of source and postids.
		foreach($resulttime['rows'] as $pkey=>$oo)
		{

		$sourcepostsq[$oo['value'][0]][] =  $oo['value'][1]; 
		
		}
//echo 'timeresults by source and postid';
//print_r($sourcepostsq);
	
	$this->resultbatch = $sourcepostsq;
	
      
	}

     /**  
     * form topscore/match and avg of avg data per content source
     * 
     *
     */      
       public function buildresultsarray ($livedefin )
      {

		$livedef = $livedefin;


		$scoredataldef = "function(doc) {


	for( var psource in doc.matrixstats['avg'] )
	{
	
	if(doc.matrixstats['avg'][psource]['".$livedef ."'])
	{
		emit (psource, [doc.matrixstats[psource]['".$livedef ."'], doc.matrixstats['avg'][psource]['".$livedef ."']]);
	}
	}

}
		";

		  $client = new couchClient ('http://localhost:5984','lifestylelinking');
		 

		$view_fn= $scoredataldef;
		$design_doc->_id = '_design/scoreperldef';
		$design_doc->language = 'javascript';
		$design_doc->views = array ( 'by_scoreperldef'=> array ('map' => $view_fn ) );
		$client->storeDoc($design_doc);

		$result = $client->asArray()->getView('scoreperldef','by_scoreperldef');
//print_r($result);

			foreach($result['rows'] as $s=>$q )
			{
			
			$dataids[$q['key']]= $q['value'];
			
			
			}
//echo 'afffffffffffffffffffffffffff';
//print_r($dataids);


	
	$doc = $client->getDoc('_design/scoreperldef');

	$result = $client->deleteDoc($doc);

        return $dataids;	
      }


    /**
     *
     * 
     *
     */     
	public function applylifestylelinking()
	{
	//  given the results required applys lifestylelinking to set normalization and peerGroups required to be contructured.
      $resultslinking = new LLlifestylelinking( $this->linkinglogic);
//print_r($resultslinking);
      $this->linkingdata = $resultslinking->lldatareturn();
//echo 'peer groups plus any ordering based on LL logic figured out';
//print_r($this->linkingdata);
      //$this->postdatalive = $resultslinking->returnscorestatdatalive();
      
      }
		
	/**  
	*
	* 
	*
	*/ 
	public function postarralist($arraytolist)
	{
	// list array be post number
	
//$arraytolist = array ( "4"=> "1", "3" =>"0" , "2" => "0", "1" =>"0" );	
		foreach($arraytolist as $pid=>$pqual)
		{
			
		 if($pqual == 1)
		 {
		 $prid[] = $pid;
		 
		 }
		
		}

//echo 'arrayqualifybypostid';
//print_r($prid);
     
	return $prid;
   
	} 
    
     /**  
     *
     * 
     *
     */ 
	public function makeresults()
	{
      // used identity, LLlogic->peerGroup, filtered/unfiltered, time period
      //  start, personalized by url source id yes/now, -> 1. order posts be source  LL significance    2.  post in and poor context post get in if (top5 & frequency >75%)  3.  filter on/off  in context or just any datafrom LLsources (give the time period)
      
                
//          foreach($this->linkingdata as $sidorder=>$melife)
   //       {
           // go through each source in order and see if post given (filter conditions to date)
               if(count($this->resultbatch) > 0 )
               {
  //echo 'resultbatchextract'.$sidorder.'anynumberbefore';
  //print_r($this->resultbatch[$sidorder]);
        
                 //$sourefilterposts = $this->resultbatch[$sidorder];
                  // does each individual post in context for this lifestyle definitions (apply rules)
                  foreach($this->resultbatch as $qsource=>$qposts)
                  {
                  
			if($this->resultsfilter == 'off')
			{      
			// build array of sources/posts based on LL order
				foreach($qposts as $qnid=>$qpid)
				{
				$this->postqualify[$qsource][$qpid] = 1;
				}
			}
			else
			{
			  
// post score date for this
//echo 'poststatspassedto resultcalc';

					foreach($qposts as $qnid=>$qpid)
					{
//echo 'sourceiiiiiiiiiiiiiiiiiiiiiid'.$qsource;
//echo 'postcalac'.$qpid;
					$this->postqualify[$qsource][$qpid] = $this->resultcalc($this->livescoreldef[$qsource][0][$qpid], $this->livescoreldef[$qsource][1]);
					
					}

			     // if more than one post per source then order those on weighted avg. between context and TODO
			    //$this->weightingresults($this->postqualify);
			    
			}
			      
//echo 'qualiffffying posts';
//print_r($this->postqualify);
                  }
               }
      //    }
        
      // all qualifying posts are known  now hookup to source data required for dispaly
      $this->resultsready = $this->resultsdatahookup($this->postqualify);
      $this->resultsready['peergroup'] = $this->blogrolldatahookup();
     

	} 

    /**  
     *
     * 
     *
     */    
	public function resultsMaker($meid, $filtervalue, $resultsarrays) 
	{
     
    // this needs to be  re audited for new framework logic coming in (TODO) 
     
     // what context to output results eg. personalization  lifestyle, time period, logic of LL ie added blog or assume average

      //  source has an significance and posts on own have a significance.

/*
      
        //foreach($defids as $did)
         //{
               //echo '<br /><br />START DEFid'.$did;
               foreach($contidarray as $sid=>$cid)
               {
               //echo '<br /><br />start source'.$sid;
                $this->resultperdef = '';
                $this->resultperdef = $this->buildresultsarray($did, $this->window, $sid, $contidarray);  
                $forresults[$did][$sid] = $this->resultcalc($did, $sid, $this->resultperdef);
               //echo '<br /><br />results after all calculations'; 
                //print_r($this->resultperdef);
                
               //echo $sid.'END each source<br /><br />';
                }
         // got all qualifying contentitems, what order do they get presented, weighted avges of top and diffavg
        //echo 'before weighting function'; 
        //print_r($forresults);
         // $this->weightingresults($forresults);
         //echo $did.'END each definition<br /><br />';
         //}
     $this->meresults = $forresults;   
     return $this->meresults;
  */   
	}
   

    /**  
     *
     * 
     *
     */    
        public function resultcalc ($indscore, $indstats) 
        {

          // Does any content post contain top lifestyle definition word?  (this is pretty primitive, with CQ in use could select top unqiue words needs testing)
//echo 'resultscalcstarted';
//print_r($indscore);
//echo 'resultscalcstatssssss';
//print_r($indstats);
//echo 'what has been passed';
          $topmm = $indscore['matched'][1];

                            if ($topmm  >= 1 )
                            {
                              // should also try and qualify the positive context with  sourceTopfive and requencyScore why?  positive qualification(down side risk one off post from in context)
//echo 'topmatch??? <br /><br />';
                              $aftercalc = 1;
//print_r($aftercalc);
//echo 'one for topmatch';
                            }
                            else
                            {
//echo 'does it have some context at all???????';
//print_r($indsource['scoring']['50']);
                                 if ($indscore[scoring][50] > 0)  //  has to have some context to qualify for two results 
                                {
  //echo '<br /><br /> start two tests <br /><br />';
  // topfive  need to call topfive function
                                      //$fivematch = $this->sourceTopfive($did, $sid, $pid, $indstats);
                                      $fivematch = 1;
  //echo 'fivematch'.$fivematch;
                                          
// frequency over 75%
                                      $freqmatch = $this->frequencyScore($indstats);
                                      //$freqmatch = 1;
//echo 'frequencyhigh'.$freqmatch;
//echo 'END two tests <br /><br />';
                                    
                                       // now need to form array of the sources with their contentids that will make it to results
                                       if(($fivematch == 1)  && ($freqmatch == 1))
                                       {
                                        $aftercalc = 1;
//print_r($aftercalc);
//echo 'two none context test met, allow to be included for results';
                                       }
                                      else 
                                      {
//echo 'failed two test';  //  note this and does this mean this post is on diff. def. not scored? probably or we got it wrong!
                                      }
                                               
                                  }

                                  else
                                  {
//echo 'fails as has no top50 context at all';
                                  }
                            }
//echo 'before aftercalc';
//print_r($aftercalc);
//echo 'end of calculation run<br /><br />';     
                        
       return $aftercalc;
       
    }  // closes function

    /**  
     *
     * 
     *
     */    
    public function frequencyScore($livestats)
    {
    //echo '<br /><br />START frequencyscore<br /><br />';
          // look at stats to see if this source has scoring average of over 75% for this lifestyle definition)
          if ($livestats->scorefreq > 0.75 )
          {
          
            $freqentyes = '1';
           //echo 'yes frequency over 75%';
          }
          
          else 
          {
          $freqentyes = null;
          //echo 'no poor frequency score';
          }
     //echo 'ENDfrequency over 75%';   
     return $freqentyes;   
     
    }
    
    /**  
     *
     *  looks at a source orders lifestyle definitions highest to lowest
     *
     */ 
	public function sourceTopfive($sourceid)
	{
			// order per source, definitions and limits the list to 5  (need to develop a smart way to cut off the length of the list ie. what are the lifestyle definition that really are this source?)
// echo '<br /><br />START topfive<br /><br />';
//print_r($this->resultsarray['normdata'][$sid]);
//echo 'source DEF id being used in this context'.$did.'source id'.$sid;
    $siddiff =	'';  // need to query couchdb to aggregate the top5
    arsort($siddiff);
//echo 'diff avg order';
     
    array_slice($siddiff, 5, true);
//print_r($siddiff); 
    $intop = array_key_exists($did, $siddiff);
//echo 'keylist number one or null??'.$intop;
   
            if ($intop > 0 ) 
            {
            // yes for this source, this defid is in the top5
            $topfive = 1;
            }
            
            else
            {
  // for this source , this defid is NOT in the top5
            $topfive = null;
  //echo 'not in top five';
            }
  //echo 'END TOPFIVE FUNCTION';
  //echo $topfive;
    
    return $topfive;
      
		}

    /**  
     *
     * 
     *
     */    
      public function weightingresults ()
      {

        // set sort 
        $SortOrder=0; // desc by default , 1- asc

        // lifestyle rank for each  post
        //  thinking here is to have two based on word context e.g. matched2 and score50   and  one/two on  lifestyleavg.  e.g diffavg/topmatched     could weight two group 2/3 word context  1/2 avg context.
        // rank for topword
        unset($indexord);
        $indexord = (sortByField($rankexpand,'1',$SortOrder));

        unset($trorder);
        foreach ($indexord as $keytr => $trank)  {

        $trorder[] = $keytr;

        }

        // rank for post score points
        unset($indexordsc);
        $indexordsc = (sortByField($rankexpand,'2',$SortOrder));

        unset($scorder);
        foreach ($indexordsc as $keytr => $trank)  {

        $scorder[] = $keytr;

        }


        // need to combine rankings to an over all ranking
        if ($trorder && $scorder)  {

        unset($trordera);
        unset($scordera);
        //unset($drordera);
        unset($postaggrank);
        unset($postaggranka);



        $trordera = array_flip($trorder);

        $scordera = array_flip($scorder);


        foreach ($trorder as $keyo => $postid )  {

        $aggrank = ($trordera[$postid]/2) + ($scordera[$postid]/2) ;

        $postaggrank[$postid] = round(($aggrank), 4);

        }

        asort($postaggrank);

        $postaggranka = array_reverse($postaggrank, true);




        }

	}
   

    /**  
     *
     *   merges arrays based on keys
     *
     */    
        public function array_merge_keys($arr1, $arr2)
        {

        foreach($arr2 as $k=>$v) {
                if (!array_key_exists($k, $arr1)) { //K DOESN'T EXISTS //
                    $arr1[$k]=$v;
                }
                else { // K EXISTS //
                    if (is_array($v)) { // K IS AN ARRAY //
                        $arr1[$k]=array_merge_keys($arr1[$k], $arr2[$k]);
                    }
                }
            }
            return $arr1;
        }

    /**  
     *
     *   // function to sort multidimentional array
     *
     */   
        public function sortByField($multArray,$sortField,$desc=true)
        {

                    $tmpKey='';
                    $ResArray=array();

                    $maIndex=array_keys($multArray);
                    $maSize=count($multArray)-1;

                    for($i=0; $i < $maSize ; $i++) {

                       $minElement=$i;
                       $tempMin=$multArray[$maIndex[$i]][$sortField];
                       $tmpKey=$maIndex[$i];

                        for($j=$i+1; $j <= $maSize; $j++)
                          if($multArray[$maIndex[$j]][$sortField] < $tempMin ) {
                             $minElement=$j;
                             $tmpKey=$maIndex[$j];
                             $tempMin=$multArray[$maIndex[$j]][$sortField];

                          }
                          $maIndex[$minElement]=$maIndex[$i];
                          $maIndex[$i]=$tmpKey;
                    }

                   if($desc)
                       for($j=0;$j<=$maSize;$j++)
                          $ResArray[$maIndex[$j]]=$multArray[$maIndex[$j]];
                   else
                      for($j=$maSize;$j>=0;$j--)
                          $ResArray[$maIndex[$j]]=$multArray[$maIndex[$j]];

                   return $ResArray;
               
               }   // closes function


    /**  
     * 
     * 
     *
     */ 
	public function resultsdatahookup ($postresultrequired)
	{
//echo 'hookup results';   
//print_r($postresultrequired);
	// given the source and posts qualifying for results, get the source content in memory.
	
	foreach($postresultrequired as $ksource=>$qspostarr)
	{
	// sort post array to contain just postid array
		$postarray = $this->postarralist($qspostarr);

		
//		$postarray = array(2,9);

		foreach($postarray as $idr=>$qpid)
		{

		$postlist .= 'plist == '.$qpid.' ||';

		}

		// eat the last ||
		$postlist = substr($postlist,0,(strLen($postlist)-2));

//echo $postlist;


		$blogname = $ksource;


		$perblogview = "function(doc) {
			if((doc.bloginfo['url'] == '".$blogname."') )
			{

			for(var plist in doc.source['posts'])
			{

			if(".$postlist.")
			{
				emit(plist, doc.source['posts'][plist]);
			}	
			
			}
			
			
			}


		}
		";

		  $client = new couchClient ('http://localhost:5984','lifestylelinking');
		 

		$view_fn= $perblogview;
		$design_doc->_id = '_design/resultsperblog';
		$design_doc->language = 'javascript';
		$design_doc->views = array ( 'by_resultsperblog'=> array ('map' => $view_fn ) );
		$client->storeDoc($design_doc);

		$result = $client->getView('resultsperblog','by_resultsperblog');
//echo 'resultscontentttttt';
//print_r($result);


			foreach($result->rows as $qspid=>$qdetail )
			{

			      $resultsorder ++;
		//echo $resultsorder.'end';
			      $resultscomplete[$resultsorder]['postdate'] = $qdetail->value->authordate;
			      $resultscomplete[$resultsorder]['blogname'] = $blogname;
			      $resultscomplete[$resultsorder]['blogurl'] = $blogname;
			      $resultscomplete[$resultsorder]['posttitle'] = $qdetail->value->posttitle;
			      $resultscomplete[$resultsorder]['posturl'] = $qdetail->value->permalink;
			      $resultscomplete[$resultsorder]['postcontent'] = $qdetail->value->content;
			      
			}


//echo 'content ready for displayyyyyy';
//print_r($resultscomplete);

		$doc = $client->getDoc('_design/resultsperblog');

		$result = $client->deleteDoc($doc);
		      
	}      
	      
	return $resultscomplete;
	
    }
        
    /**  
     * 
     * 
     *
     */ 
	public function blogrolldatahookup()
	{
//echo 'blogroll hookup ';   
            //integrate results source/post qualifying to content required for display
        
        $blogorder = 0;
            
        foreach($this->linkingdata as $snameid=>$postsdata)
        {
         
         $blogorder ++;
         $blogrollcomplete[$blogorder]['blogname'] = $snameid;
         $blogrollcomplete[$blogorder]['blogurl'] = $snameid;
        
        }
      
	return $blogrollcomplete;
        
	}

	/**  
	* 
	* 
	*
	*/ 
	public function resultsJSON ()
	{
    
//	    LLJSON::storeJSONdata($this->resultsready, $this->resultsid, $stage='liveresults');

	}

    /**  
     * 
     * 
     *
     */ 
	public function setdefinitionpathresults ()
	{
    
	$setresultslink[$this->definitionidlive]['pathid'] = $this->pathtaken['pathid'];  // pathid for this definition
	$setresultslink[$this->definitionidlive]['resultsid'] = $this->resultsid;  // resultsid for this definition.
	$setresultslink[$this->definitionidlive]['time'] = $this->endtime;  //  time results were calculated
    
    
	return $setresultslink;

	}

    
    /**  
     * 
     * 
     *
     */ 
	public function liveResultsdata()
	{
    
	return $this->resultsready;

	}
		

}
  
?>
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
   public function __construct($resultsidentity, $lifestylebuild, $inpath, $livelistsource, $liveavgofavg )
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
    
    // how are the results being form?  1. filter post on time?  2. lifestylelinking logic, 3. filtered/unfiltered ie in context post, any context post of LL sources
      
    // extract definition id from livedefinition
    $this->definitionidlive = key($this->lifestylemenu); 
    
     // make sure relevant data is live in memory if not co ordinate other class to get all data ready to go, updated and LL logic flexibility
    // two types, first arrays of time, source post ids  and then the fuller content (but only those that make the results)
    // needs to be called here to get source posts authored time (should have this in seperate data to 'lighter' loading?
   
        // if results already processed then get those and then update all info. in universe and show that in realtime?
        if($this->pathtaken['intention'] == 'newstart')
        {
        
            if(count($this->sourcesinresults) >= 1 )
            {
            
            // create a unique results id and link it to the path and lifestyle definition 
            $this->resultsid = $this->setresultsid();
            
            // a brand new path needing results
            $this->loadsourceprepareddata();
            
                // pick out source/post that meet the time constraint
            $this->resulttime();
            
            // apply lifestylelinking logic this will set normalization and groups required.
            $this->applylifestylelinking($this->personalizedid, $this->linkinglogic, $this->lifestylemenu, $this->sourcesinresults, $this->livecommaverage, $this->definitionidlive);
            
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
          $this->resultsready = LLJSON::importJSONdata($this->pathtaken['resultsid'], $stage='liveresults');  // load existing results array prepared
          
        
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
echo 'formresultsid'.$uniqueresultform;
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

         // now extract list of  source post that satify this time period
         foreach($this->sourceposttime as $sid=>$post)
         {
//print_r($post);          
            foreach($post as $pid=>$authortime)
            {
            
                if($authortime >  $this->starttime && $authortime < $this->endtime)
                {
                
                $this->resultbatch[$sid][$pid] = $authortime;
                
                }
            }
          }
//echo 'results making based on time filter';
//print_r($this->resultbatch); 
      
    }

    /**
     *
     * 
     *
     */     
		public function applylifestylelinking($perid, $theLLlogic, $thedefinition, $thesources, $theavgofavg, $setdefinition)
		{
			//  given the results required applys lifestylelinking to set normalization and peerGroups required to be contructured.
      $resultslinking = new LLlifestylelinking($perid, $theLLlogic, $thedefinition, $thesources, $theavgofavg, $setdefinition);
print_r($resultslinking);
      $this->linkingdata = $resultslinking->lldatareturn();
      $this->postdatalive = $resultslinking->returnscorestatdatalive();
      
      }
		
    /**  
     *
     * 
     *
     */ 
		public function loadsourceprepareddata()
		{
      // just memory to see what results JSON files are loaded, if this definitions results data is not in memory, load it ready for use
     // list of source and postids
     
     // if content sources array not live in memory make it live.
     
         foreach($this->sourcesinresults['source'] as $sid=>$sdetail )
         {
         
          $this->resultsin[$sid] = LLJSON::importJSONdata($sid, $stage='sourceprepared');
        
         }
         
         // form source, postid, data arry
         foreach($this->resultsin as $sid=>$contentdetail)
         {
          
              foreach($contentdetail['posts'] as $pid=>$postdata)
              {
              
               $this->sourceposttime[$sid][$pid] = $postdata['authordate'];
               
              }
          }
//echo 'results source post data array';
//print_r($this->sourceposttime);
    return $this->resultsin;
   
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
      
                
          foreach($this->linkingdata as $sidorder=>$melife)
          {
           // go through each source in order and see if post given (filter conditions to date)
               if(count($this->resultbatch[$sidorder]) > 0 )
               {
  //echo 'resultbatchextract'.$sidorder.'anynumberbefore';
  //print_r($this->resultbatch[$sidorder]);
        
                 $sourefilterposts = $this->resultbatch[$sidorder];
                  // does each individual post in context for this lifestyle definitions (apply rules)
                  foreach($sourefilterposts as $pid=>$postdate)
                  {
                  
                      if($this->resultsfilter == 'off')
                      {      
                        // build array of sources/posts based on LL order
                        $this->postqualify[$sidorder][$pid] = 1;
        
                      }
                      else
                      {
                  
                    // post score date for this
//echo 'poststatspassedto resultcalc';
    //print_r($this->postdatalive[$sidorder][$sidorder][$pid][$this->definitionidlive]);
                    $this->postqualify[$sidorder][$pid] = $this->resultcalc($pid, $this->definitionidlive, $sidorder, $this->postdatalive[$sidorder][$sidorder][$pid][$this->definitionidlive]);

                     // if more than one post per source then order those on weighted avg. between context and TODO
                    //$this->weightingresults($this->postqualify);
                    
                      }
                      
                      
                  }
               }
          }
        
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
       public function buildresultsarray ($did, $winlimit, $sid, $contidarray)
      {
       // will need to pick out the list of content ids /info. universe that are incluced in results.
       // pickout for each source the content for this results window per lifestyle definition
//echo '<br /><br />start build for defid'.$did.'and source'.$sid;
                $this->resultconids = '';
                $this->scontids = '';                
                
                foreach($contidarray[$sid] as $ccid)
                     {

                      $this->resultconids[$sid][$ccid] = $this->resultsarray[$sid][$ccid][$did];
                      $this->scontids[] = $ccid;
                      }
        
        $dataids['data'] = $this->resultconids;
        $dataids['ids'] = $this->scontids;
//print_r($dataids);
//echo 'end build array<br /><br />';

        return $dataids;
      }

    /**  
     *
     * 
     *
     */    
        public function resultcalc ($pid, $did, $sid, $indsource) 
        {

          // Does any content post contain top lifestyle definition word?  (this is pretty primitive, with CQ in use could select top unqiue words needs testing)
//echo 'resultscalcstarted';
//print_r($indsource);
//echo 'what has been passed';
          $topmm = $indsource['matched']['1'];

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
                                 if ($indsource['scoring']['50'] > 0)  //  has to have some context to qualify for two results 
                                {
  //echo '<br /><br /> start two tests <br /><br />';
  // topfive  need to call topfive function
                                      //$fivematch = $this->sourceTopfive($did, $sid, $pid, $indsource);
                                      $fivematch = 1;
  //echo 'fivematch'.$fivematch;
                                          
// frequency over 75%
                                      //$freqmatch = $this->frequencyScore($sid, $did);
                                      $freqmatch = 1;
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
    public function frequencyScore($sid, $did)
    {
    //echo '<br /><br />START frequencyscore<br /><br />';
          // look at stats to see if this source has scoring average of over 75% for this lifestyle definition)
          if ($this->resultsarray['avg'][$sid][$did]['4'] > 0.75 )
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
		public function sourceTopfive($did, $sid, $cid, $unsurep)
		{
			// order per source, definitions and limits the list to 5  (need to develop a smart way to cut off the length of the list ie. what are the lifestyle definition that really are this source?)
// echo '<br /><br />START topfive<br /><br />';
//print_r($this->resultsarray['normdata'][$sid]);
//echo 'source DEF id being used in this context'.$did.'source id'.$sid;
    $siddiff =	$this->resultsarray['normdata'][$sid];
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

        $resultsorder = 0;
      //integrate results source/post qualifying to content required for display
      foreach($postresultrequired as $sid=>$postsdata)
      {
//echo 'postresults';
//print_r($postsdata);

         foreach($postsdata as $pid=>$resultsin)
         {
          
              if($resultsin == 1)
              {
              $resultsorder ++;
//echo $resultsorder.'end';
              $resultscomplete[$resultsorder]['postdate'] = $this->resultsin[$sid]['posts'][$pid]['authordate'];
              $resultscomplete[$resultsorder]['blogname'] = $this->resultsin[$sid]['title'];
              $resultscomplete[$resultsorder]['blogurl'] = $this->resultsin[$sid]['link'];
              $resultscomplete[$resultsorder]['posttitle'] = $this->resultsin[$sid]['posts'][$pid]['posttitle'];
              $resultscomplete[$resultsorder]['posturl'] = $this->resultsin[$sid]['posts'][$pid]['permalink'];
              $resultscomplete[$resultsorder]['postcontent'] = $this->resultsin[$sid]['posts'][$pid]['content'];
              
              }
        
         }
          
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
            
        foreach($this->linkingdata as $sid=>$postsdata)
        {
         
         $blogorder ++;
         $blogrollcomplete[$blogorder]['blogname'] = $this->resultsin[$sid]['title'];
         $blogrollcomplete[$blogorder]['blogurl'] = $this->resultsin[$sid]['link'];
        
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
    
    LLJSON::storeJSONdata($this->resultsready, $this->resultsid, $stage='liveresults');

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
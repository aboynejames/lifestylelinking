<?php

	class LLResults
	{
		// 1. input context and filter status
    
    
    protected $resultconids;
    protected $resultsarray;
    protected $window;
    protected $resultperdef;
    protected $scontids;
    
     public function __construct($matrix)
		{
    // new data 
      $this->resultsarray = $matrix;
      //print_r($this->resultsarray);
  	}

    
		
		public function defineResultsWindow() 
		{
     // 1. set context for results (time, filter context, sources, identity)
     // first stage is to lifestylelink all the sources appropriate for this individual just skiing or skiing + swimmer or skiing + all of life, now this tricky but the problem we are solving)
     $this->window = 'all';
     
		}
		
    
    public function resultsManager($contidarray) 
		{
     // what context to output results eg. personalization  lifestyle, time period, logic of LL ie added blog or assume average
     // for example three score results per lifestyle definition and gather data on a per source basis, then aggregate all 'qualifying' source content items and order (weighted ranking) 
     $defids = array('0'=>'1', '1'=>'2');
     //print_r($contidarray);
      
        foreach($defids as $did)
         {
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
         }
     $this->meresults = $forresults;   
     return $this->meresults;
     
		}
   
   
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


        public function resultcalc ($did, $sid, $indsource) 
        {

              // Does any content post contain top lifestyle definition word?  (this is pretty primitive, with CQ in use could select top unqiue words needs testing)
              //echo '<br /><br />START OF CALC'.$did.'and source'.$sid.'<br /><br />';
              //  need to sort this loop array.
                    foreach($indsource['ids'] as $ccid)
                     {
                     //echo '<br /><br />CALCsource'.$sid.'contentitem'.$ccid.'<br /><br />';
                     // go through each content items for this source and see if they make it to results
                     //echo '<br /><br />START TWO RULES'.$ccid.'<br /><br />';
                     
                    $topmm = $indsource['data'][$sid][$ccid]['matched']['1'];

                            if ($topmm  >= 1 )
                            {
                              // should also try and qualify the positive context with  sourceTopfive and requencyScore why?  positive qualification(down side risk one off post from in context)
                            //echo 'topmatch??? <br /><br />';
                              //$wordtopm[$sid][$ccid] = $topmm;
                              $aftercalc[$sid][$ccid]['in'] = 1;
                              //print_r($aftercalc);
                              //echo 'one for topmatch';
                            }
                            else
                            {
                            //echo 'does it have some context at all???????';
                            //print_r($indsource['data'][$sid][$ccid]['scoring']['50']);
                                 if ($indsource['data'][$sid][$ccid]['scoring']['50'] > 0)  //  has to have some context to qualify for two results 
                                {
                                          //echo '<br /><br /> start two tests <br /><br />';
                                            // topfive  need to call topfive function
                                          $fivematch = $this->sourceTopfive($did, $sid, $ccid, $indsource['data'][$sid][$ccid]);
                                          //echo 'fivematch'.$fivematch;
                                          
                                          // frequency over 75%
                                          $freqmatch = $this->frequencyScore($sid, $did);
                                          //echo 'frequencyhigh'.$freqmatch;
                                          //echo 'END two tests <br /><br />';
                                    
                                               // now need to form array of the sources with their contentids that will make it to results
                                               if(($fivematch == 1)  && ($freqmatch == 1))
                                               {
                                                $aftercalc[$sid][$ccid]['in'] = 1;
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
                  }
                      //echo 'before aftercalc';
//print_r($aftercalc);
//echo 'end of calculation run<br /><br />';     
                        
       return $aftercalc;
       
    }  // closes function


		// looks at a source orders lifestyle definitions highest to lowest
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


        // OK, last stage save ranking and appropriate info. to make display results as quick as possible.
        $drposts = '';
        $rank = 0;

        foreach ($postaggranka as $key => $dayps)  {

        $rank++;

        $drposts .="( '$rank', '$finishtime', '$lifestyleidc', '$key' ), ";

        }

        $drposts=substr($drposts,0,(strLen($drposts)-2));//this will eat the last comma


        if (strLen($drposts) > 0 )  {  //  if no posts for that day, no need for query

        //$db->query ="INSERT INTO ".RSSDATA.".dailyposts (rank, enddate, lifestyleid, postid) VALUES ";

        //$db->query .="$drposts";
        //echo $db->query;
        //$resultpostinsert = mysql_query($db->query) or die(mysql_error());

        }
        }

   }
   

        // need to update feeds for new data, score, stats, melife,   whole lifestyle averages  before running this function
        // need to create online control panel secure for James to perform 24hrs updates.  NOW ONLINE at /lifestylelinking/loginfiles/rssfeed/dailyupdate

        // merges arrays based on keys
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





        // function to sort multidimentional array
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




		// Use average ll science
		public function averageResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}
		
		// Use personalised filtered ll science
		public function personalisedFilteredResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}
		
		// Use personalised unfiltered ll science
		public function personalisedUnfilteredResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}
		
		// Use experimental ll science
		public function experimentalResults()
		{
			// extration of correct peergroup
			$this->buildLLGroups();
		}








  	public function resultsComplete()
		{
      // 
      //$this->meresults = array('1' => '1');
      //print_r($this->meresults);
      return $this->meresults;
  
    } 



}  // closes class

?>
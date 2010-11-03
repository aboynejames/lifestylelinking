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
      print_r($this->resultsarray);
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
     $defids = array('0'=>'1');//, '1'=>'2');
     print_r($contidarray);
      
        foreach($defids as $did)
         {
               echo '<br /><br />START DEFid'.$did;
               foreach($contidarray as $sid=>$cid)
               {
               echo '<br /><br />start source id'.$sid.'and contentid'.$cid;
                $this->resultperdef = '';
                $this->resultperdef = $this->buildresultsarray($did, $this->window, $sid, $contidarray);  
                $forresults[$did] = $this->resultcalc($did, $sid, $this->resultperdef);
                //print_r($this->resultperdef);
                
               echo $sid.'END each source<br /><br />';
                }
         // got all qualifying contentitems, what order do they get presented, weighted avges of top and diffavg
        echo 'before weighting function'; 
        //print_r($forresults);
         // $this->weightingresults($forresults);
         echo $did.'END each definition<br /><br />';
         }
         
     
		}
   
   
       public function buildresultsarray ($did, $winlimit, $sid, $contidarray)
      {
       // will need to pick out the list of content ids /info. universe that are incluced in results.
       // pickout for each source the content for this results window per lifestyle definition
          echo '<br /><br />start build array'.$did.'and source'.$sid;
                $this->resultconids = '';
                foreach($contidarray[$sid] as $ccid)
                     {

                      $this->resultconids[$sid][$ccid] = $this->resultsarray[$sid][$ccid][$did];
                      $this->scontids[$sid][$ccid] = '';
                      }

        echo 'reduced array for source'.$sid; 
        print_r($this->resultconids);
        echo 'end build array<br /><br />';
        return $this->resultconids;
      }


        public function resultcalc ($did, $sid, $indsource) 
        {

              // Does any content post contain top lifestyle definition word?  (this is pretty primitive, with CQ in use could select top unqiue words needs testing)
              echo '<br /><br />START OF CALC'.$did.'and source'.$sid;
              //  need to sort this loop array.
                    foreach($indsource[$sid] as $ccid)
                     {
                     echo 'source'.$sid.'contentitem'.$ccid.'<br /><br />';
                     // go through each content items for this source and see if they make it to results
                     echo '<br /><br />START FOREACH SID CONIDS'.$ccid;
                      //echo 'matched'.$sid.'conteid'.$ccid.'matchedno';
                      //print_r($this->resultperdef[$sid][$ccid]['matched']['1']);
                      //$topmm = $this->resultperdef[$sid][$ccid]['matched']['1'];

                            if ($topmm  >= 1 )
                            {
                              // should also try and qualify the positive context with  sourceTopfive and requencyScore why?  positive qualification(down side risk one off post from in context)
                            
                              $wordtopm[$sid][$ccid] = $topmm;
                              $aftercalc[$sid][$ccid]['in'] = 1;
                            }
                            else
                            {
                                  echo '<br /><br /> start two tests ';
                                    // topfive  need to call topfive function
                                 // $fivematch = $this->sourceTopfive($sid, $ccid, $this->resultperdef[$sid][$ccid]);
                                  //echo 'fivematch'.$fivematch;
                                  
                                  // frequency over 75%
                                  //$freqmatch = $this->frequencyScore($sid, $did);
                                  //echo 'frequencyhigh'.$freqmatch;
                                  echo 'END two tests <br /><br />';
                            
                                       // now need to form array of the sources with their contentids that will make it to results
                                       if(($fivematch == 1)  && ($freqmatch == 1))
                                       {
                                        $aftercalc[$sid][$ccid]['in'] = 1;
                                        //print_r($aftercalc);
                                       }
                               
 
                            }
                  }
                       echo 'end of calculation run<br /><br />';
print_r($aftercalc);
     
                            /*
                            $wordtopm = null ;
                            }
                          
                             // echo 'matched top';
                              //print_r($wordtopm);
                                
                                  if (count($wordtopm) > 0)
                                  {
                                  //$unsurep = (array_diff_assoc($this->resultperdef[$sid], $wordtopm));
                                  $unsurep = null;
                                  }
                                  
                                  else
                                  {
                                  $unsurep= $this->resultperdef[$sid][$ccid];
                                  }

                                   //echo 'diffkey';
                                   //print_r($unsurep);

                                  // what about post that have context but not top word, include those if a. feed me top5  or b. score avg. > 0.75 lifestlyes includes that lifestyle definition being processed.
                                            if (count($unsurep) > 0) 
                                            {
                                              // if a content id has some context score ie top50 is greater than zero
                                           
                                              // then find for this source the definition the results are for is in the top5 for this source and this source score with a freqency over .75 
                                                    foreach ($unsurep as $cid=>$msc)
                                                    {
                                                    echo '<br /><br /> start two tests ';
                                                      // topfive  need to call topfive function
                                                    $fivematch = $this->sourceTopfive($sid, $msc, $unsurep);
                                                    //echo 'fivematch'.$fivematch;
                                                    
                                                    // frequency over 75%
                                                    $freqmatch = $this->frequencyScore($sid, $did);
                                                    //echo 'frequencyhigh'.$freqmatch;
                                                    echo 'END two tests <br /><br />';
                                                    }
                                                    
                                                     // now need to form array of the sources with their contentids that will make it to results
                                                       if(($fivematch == 1)  && ($freqmatch == 1))
                                                       {
                                                        $aftercalc[$sid][$msc]['in'] = 1;
                                                        //print_r($aftercalc);
                                                        }
                               
                                             }
                                             print_r($aftercalc);

                                */
      
       return $aftercalc;
       
    }  // closes function


		// looks at a source orders lifestyle definitions highest to lowest
		public function sourceTopfive($sid, $cid, $unsurep)
		{
			// order per source, definitions and limits the list to 5  (need to develop a smart way to cut off the length of the list ie. what are the lifestyle definition that really are this source?)
		//print_r($this->resultsarray['normdata'][$sid]);
    $siddiff =	$this->resultsarray['normdata'][$sid];
    arsort($siddiff);
    echo 'diff avg order';
    print_r($siddiff);  
    array_splice($siddiff, 5);
    $intop = array_key_exists($sid, $siddiff);
    //echo $intop;
   
            if ($intop > 0 ) 
            {
            // yes for this source, this defid is in the top5
            $topfive = 1;
            }
            
            else
            {
            // for this source , this defid is NOT in the top5
            $topfive = null;
            }
    //echo 'in top five yes or now come on tell me';
    //echo $topfive;
    
    return $topfive;
      
		}


    public function frequencyScore($sid, $did)
    {
          // look at stats to see if this source has scoring average of over 75% for this lifestyle definition)
          if ($this->resultsarray['avg'][$sid][$did]['4'] > 0.75 )
          {
          
            $freqentyes = '1';
          
          }
          
          else 
          {
          $freqentyes = null;
          }
     //echo 'frequency over 75%'.$freqentyes;   
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

        $db->query ="INSERT INTO ".RSSDATA.".dailyposts (rank, enddate, lifestyleid, postid) VALUES ";

        $db->query .="$drposts";
        //echo $db->query;
        $resultpostinsert = mysql_query($db->query) or die(mysql_error());

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
      $this->meresults = array('1' => '1');
      //print_r($this->meresults);
      return $this->meresults;
  
    } 



}  // closes class

?>
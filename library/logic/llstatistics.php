<?php


class LLstatistics
{
  
  // two techniques on offer  (basic crowd wisdom is based on frequency of word use in authoring)
  // 1. exluded words, 1 length characters
  // 2. CQ  confusion quotent - identifies differenciating words between definitions (if definitions are being called)
  // other stuff that will go on.  look at structure of text, updating of definition over time, combining definitions
  
  
    protected $statsarray;
    protected $statsSummary;
 
    /**
     *  
     *
     *  
     *
     */ 
    public function __construct($sid, $matrix, $defstoscore)
		{
    // new data 
      $this->sourceid = $sid;
      $this->statsarray = $matrix;
      $this->definitions = $defstoscore;
echo 'matrix array passed to stats'; 
print_r($this->statsarray);
echo 'def passed to stats';
print_r($this->definitions);
      $this->statisticsManager();
  	}

    /**
     *  
     *
     *  
     *
     */
    public function statisticsManager() 
    {
    // feeds startLLmatrix with input arrays per definition
   
    // what def ids are being scored? (find out and loop around) for now each content post is scored for all definitions,
    
                  
                  $votes = $this->formScorearray ($this->sourceid, $this->definitions);
                  //print_r($votes);
                  foreach ($this->definitions as $did=>$durl)
                  {
                        //foreach($this->statsarray as $sid=>$cid)
                        //{
                               
                               //echo 'defid='.$did.'and sid'.$sid.'andcid='.$ccid;
                               $this->statcalulator($this->sourceid, $did, $votes);                        
                        //}
                    
                  }  
          
    }

    /**
     *  
     *
     *  
     *
     */
    public function formScorearray ($sid, $defids)
    {
//echo 'form';
//print_r($this->statsarray[1][1][1]['scoring'][50]);
         //foreach($conSet as $sid=>$cid)
          //{
          
                foreach($defids as $did=>$durl)
                {
                
                        foreach($this->statsarray[$sid] as $ccid=>$ar)
                        {
                        //echo 'sid'.$sid;
                        //echo 'cid'.$ccid;
                        //echo 'did'.$did;
                        //print_r($this->statsarray[$sid][$ccid][$did]['scoring'][50]);
                        //print_r($this->statsarray[$sid][$ccid][$did]['scoring'][1]);
                        $top50[$sid][$did][$ccid] = $this->statsarray[$sid][$ccid][$did]['scoring'][50];
                        $topmatch[$sid][$did][$ccid] = $this->statsarray[$sid][$ccid][$did]['matched'][1];
                        //print_r($top50);
                        }
                }
                
           //}
//print_r($top50);
//print_r($topmatch);
      
     $statinput['sco'] = $top50;
     $statinput['mat'] = $topmatch;
     //print_r($statinput);
      return $statinput;

    }


    /**
     *  
     *
     *  
     *
     */
    public function  statcalulator ($sid, $did, $votes)
    {
    //echo 'votes array';
    //print_r($votes);
    $gotdata = '';

    $gotdata = count($this->statsarray[$sid]);
   
              if ($gotdata  > 0 )  {

                        $meavcount = '';
                        $meavsum = '';                        
                        $meavscposcou = '';
                        $avgscore = '';
                        $scavg = '';
                        $topmat = '';

                        // total number of post for this identity
                        $meavcount = count($votes['sco'][$sid][$did]);
                        //echo $meavcount.'count';
                        
                        //print_r($this->statsarray[$indid][$did][scoring][50]);
                        // accumulated scoring votes for all content from a source identity  
                        // first need to form array of just the top50 votes for an individual id ie. all the content posts for this source
                        $meavsum = array_sum($votes['sco'][$sid][$did]);
                        //echo $meavsum.'sum';
                        
                            // calculate number of posts that have scored for a defintion
                            $scocont = '';
                            //print_r($votes['sco'][$sid][$did]);
                            foreach ($votes['sco'][$sid][$did] as $svalue) 
                            {
                             
                                if ($svalue > 0)
                                {
                                
                                $scocont[] = $svalue;
                                
                                }
                           
                            }
                             //print_r($scocont);
                            $meavscposcou = count($scocont);
                            // user array above to count no. of content posts that have scored.  
                            //echo $meavscposcou.'scocount';

                                  if ($meavscposcou > 0 )  {
                                  // calcuate average score statistic
                                  $avgscore = ($meavsum)/($meavscposcou);
                                  $avgscore =  round($avgscore, 2);
                                  // scoreposts ration
                                  $scavg = round(($meavscposcou/$meavcount), 2);

                                  }

                                  else  {
                                  $avgscore = -1;
                                  $scavg = -1;
                                  }

                                // calculate the content posts that have the top words scored.
                                $meavtpm = '';
                                //echo 'top match stats';
                                //print_r($votes['1'][$sid][$did]);
                                $meavtpm = array_sum($votes['mat'][$sid][$did]);
                                // find no. topmatches
                                //echo 'sum array topmatch';
                                //print_r($meavtpm);
                                //  to do form array of topmatches and count from it
                                
                              //$meavscpotpm = '';  
                              //$meavscpotpm = count($meavtpm);
                              //$meavscpotpm = 1;
                              //echo $$meavscpotpm.'scocount';

                                if ($meavtpm > 0 )
                                {

                                $topmat = $meavtpm;
                                //echo $topmat.'topcount';
                                }

                              else
                              {
                              $topmat = -1;
                              }

                  }  // closes if no array to score

        else  {

        
        $meavcount = -1;
        $meavsum = -1;
        $meavscposcou = -1;
        $avgscore = -1;
        $topmat = -1;
        $scavg = -1;
        }

            // build to create insert sql string.
            //$this->statsSummary[] .= 1;
            //$this->statsSummary[] .= 1; 
            $this->statsSummary[$sid][$did][] .= $meavcount; 
            $this->statsSummary[$sid][$did][] .= $meavsum;
            $this->statsSummary[$sid][$did][] .= $meavscposcou;
            $this->statsSummary[$sid][$did][] .= $avgscore;
            $this->statsSummary[$sid][$did][] .= $scavg;
            $this->statsSummary[$sid][$did][] .= $topmat;            
            //$this->statsSummary[] .= $scoredate;
             
 
    } // closes function

    /**
     *  
     *
     *  
     *
     */
  	public function statisticsComplete()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->statsSummary);
      return $this->statsSummary;
  
    } 



}  // closes class

?>
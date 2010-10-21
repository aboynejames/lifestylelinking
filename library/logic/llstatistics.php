<?php


class LLstatistics
{
  
  // two techniques on offer  (basic crowd wisdom is based on frequency of word use in authoring)
  // 1. exluded words, 1 length characters
  // 2. CQ  confusion quotent - identifies differenciating words between definitions (if definitions are being called)
  // other stuff that will go on.  look at structure of text, updating of definition over time, combining definitions
  
  
    protected $statsarray;
    protected $statsSummary;
    
    public function __construct($matrix)
		{
    // new data 
      $this->statsarray = $matrix;
      print_r($this->statsarray);
  	}


    public function statisticsManager($contidarray) 
    {
    // feeds startLLmatrix with input arrays per definition
   
    // what def ids are being scored? (find out and loop around) for now each content post is scored for all definitions, this should be smarter to save un-nessary scoring.
    // data should be picked up from framework object
     
    $defids = array('0'=>'1', '1'=>'2');
    $conSet = $contidarray; // include sid and cid ie source and it content data ids for that source
          
          $votes = $this->formScorearray ($defids, $conSet);
          
          //foreach($indid as $inid)
          //{

                foreach ($defids as $did)
                {
                //echo 'defid='.$did.'andcid='.$cid;
                $this->statcalulator($indid, $did, $votes);
                
                }
            
          //}
    }


    public function formScorearray ($defids, $conSet)
    {
//echo 'form';
//print_r($this->statsarray[1][1][1][scoring][50]);
          foreach($conSet as $pid)
          {
          
                foreach($defids as $did)
                {
                //echo 'pid'.$pid;
                //echo 'difid'.$did;
                //echo 'indiv'.$indid;
                //print_r($this->statsarray[$indid][$pid][$did][scoring][50]);
                $top50[$indid][$did][$pid] = $this->statsarray[$indid][$pid][$did][scoring][50];
                $topmatch[$indid][$did][$pid] = $this->statsarray[$indid][$pid][$did][matched][1];
                //print_r($top50);
                }
                
          }
//print_r($top50);
//print_r($topmatch);
      
     $statinput[0] = $top50;
     $statinput[1] = $topmatch;
     //print_r($statinput);
      return $statinput;

    }



    public function  statcalulator ($inid, $did, $votes)
    {

    $gotdata = '';

    $gotdata = count($this->statsarray[$inid]);
   
              if ($gotdata  > 0 )  {

                        $meavcount = '';
                        $meavsum = '';                        
                        $meavscposcou = '';
                        $avgscore = '';
                        $topmat = '';
                        $scavg = '';

                        // total number of post for this identity
                        $meavcount = count($votes[0][$inid]);
                        //echo $meavcount.'count';
                        
                        //print_r($this->statsarray[$indid][$did][scoring][50]);
                        // accumulated scoring votes for all content from a source identity  
                        // first need to form array of just the top50 votes for an individual id ie. all the content posts for this source
                        $meavsum = array_sum($votes[0][$inid][$did]);
                        //echo $meavsum.'sum';
                        
                        // calculate number of posts that have scored for a defintion
                        $meavscposcou = count($votes[0][$inid]);
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
                                $meavtpm = array_sum($votes[1][$inid][$did]);
                                // find no. topmatches
                                //  to do form array of topmatches and count from it
                                
                                
                              $meavscpotpm = count($meavtpm);
                              $meavscpotpm = 1;
                              //echo $$meavscpotpm.'scocount';

                                if ($meavscpotpm > 0 )
                                {

                                $topmat = $meavscpotpm;
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
            $this->statsSummary[$inid][$did][] .= $meavcount; 
            $this->statsSummary[$inid][$did][] .= $meavsum;
            $this->statsSummary[$inid][$did][] .= $meavscposcou;
            $this->statsSummary[$inid][$did][] .= $avgscore;
            $this->statsSummary[$inid][$did][] .= $scavg;
            $this->statsSummary[$inid][$did][] .= $topmat;            
            //$this->statsSummary[] .= $scoredate;
             
 
    } // closes function

  	public function statisticsComplete()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->statsSummary);
      return $this->statsSummary;
  
    } 



}  // closes class

?>
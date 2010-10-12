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
      // temporary hack to add identity
      $addidentity[1] = $matrix;
      $this->statsarray = $addidentity;
      //print_r($this->statsarray);
     // need to pull in existing matrix for this identity-def combition 
      
      $this->statcalulator($this->statsarray);
		}



    public function  statcalulator ($startstats)
    {

    $gotdata = '';

    $gotdata = count($startstats[1]);
   
              if ($gotdata  > 0 )  {

                        $meavcount = '';
                        $meavsum = '';                        
                        $meavscposcou = '';
                        $avgscore = '';
                        $topmat = '';
                        $scavg = '';

                        // total number of post for this identity
                        $meavcount = count($startstats[1]);
                        //echo $meavcount.'count';
                        
                        // accumulated scoring votes for all content from a source identity   
                        $meavsum = array_sum($startstats[1][1][scoring][50]);
                        // need to pickout all scoring50 foreach content entry-> form array and count that
                        //print_r($startstats[1][1][scoring][50]);
                        $meavsum = $startstats[1][1][scoring][50];
                        //echo $meavsum.'sum';
                        
                        // calculate number of posts that have scored for a defintion
                        //$meavscpos = array();
                        // user array above to count no. of content posts that have scored.

                        $meavscposcou = count($startstats[1][1][scoring][50]);
                        $meavscposcou = 1;
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
                                $meavtpm = array();
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
            $this->statsSummary[] .= $meavcount; 
            $this->statsSummary[] .= $meavsum;
            $this->statsSummary[] .= $meavscposcou;
            $this->statsSummary[] .= $avgscore;
            $this->statsSummary[] .= $scavg;
            $this->statsSummary[] .= $topmat;            
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
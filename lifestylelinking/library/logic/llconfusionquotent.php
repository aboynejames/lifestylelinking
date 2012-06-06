<?php
/**
 * LifestyleLinking
 *
 * Confusion Quotent class 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * How alike are definitions?
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLconfusionQuotent
{

  // OLD code needs reviewed, some should be discarded.
  
// CQ confusion quotient how like are definitions, if confusion how to clarify Q. when does one or more defintions become hard to select from e.g. roller skating, ice skating //

      protected $deflist;
      protected $defnomatch;


      public function __construct($wisedefinitions)
      {
        // input definitions to CQ
        $this->deflist = $wisedefinitions;
        print_r($this->deflist);
        
      }



      public function defmatseg ()
      {
      // want to take one definition, segment it and then match against all other definitions

      $topseg = array ( 1, 2, 3, 4, 5, 10, 20, 50 );

            foreach ($this->deflist as $defnolist => $wdatal)
            {

                    // takes list of all definition array and splits to find def. numbers
                    foreach ($this->deflist as $defind => $wdata)
                    {

                    //$insertscore = '';
                    $insertmatched = '';
                    $insertscored = '';

                    // here we need to bring in segmenation for intersect, then save results and insert into new db table definitionscorea
                            foreach ($topseg as $seg)
                            {

                            $dms = '';
                            //unset($lifewordsarrays);


                            $defmatseg = array_slice($this->deflist[$defnolist]['1'], 0, $seg);
                            // intersect array list unique words
                            //echo '<br /><br />defmegseg';
                            //print_r($defmatseg);
                            //echo '<br /><br />deflist';
                            //print_r($this->deflist[$defind]);
                            $dms = array_intersect_key($defmatseg, $this->deflist[$defind]['1']);
                            //echo '<br /><br />dms';
                            //print_r($dms);

                                  if (count($dms) > 0 )
                                  {
                                  //echo '<br /><br />';
                                  $wordsmatched = count($dms);
                                  //echo $wordsmatched;
                                  //echo '<br /><br />';
                                  $postscore = array_sum($dms);
                                  //echo $postscore;
                                   
                                  $scoring[$seg] = $postscore;
                                  $matched[$seg] = $wordsmatched;

                                  }

                                  else
                                  {

                                  $matched[$seg] = 0;
                                  $scoring[$seg] = 0;

                                  }

                            } // closes opening foreach

                    $insertscore[$defnolist][$defind]['matched'] = $matched;
                    $insertscore[$defnolist][$defind]['score'] = $scoring;
                }
            }

      //print_r($insertscore);
      return $insertscore;
      
      } // closes function






      public function defmatsegorder ()
      {
      // want to take one definition, segment it and then match against all other definitions

      $topseg = array ( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49 );


      foreach ($this->deflist as $defnolist => $wdatal)
      {

              // takes list of all definition array and splits to find def. numbers
              foreach ($this->deflist as $defind => $wdata)
              {

              $positw = '';

                    // here we need to bring in segmenation for intersect, then save results and insert into new db table definitionscorea
                    foreach ($topseg as $seg)
                    {

                    $dms = '';
                    $orderw = '';
                    //unset($lifewordsarrays);


                    $defmatseg = array_slice($this->deflist[$defnolist]['1'], $seg, 1);
                    //print_r($lifewordsarrays);

                    //$diffab = '';
                    // intersect array list unique words
                    //echo '<br /><br />defmegseg';
                    //print_r($defmatseg);
                    //echo '<br /><br />deflist';
                    //print_r($deflist[$defind]);
                    //echo '<br /><br />ordernumber';
                        foreach ($this->deflist[$defind]['1'] as $keyw=>$kvotes)
                        {
                        $orderw[] =$keyw;
                        }
                        //print_r($orderw);



                    $dms = array_intersect_key($defmatseg, $this->deflist[$defind]['1']);
                    //echo '<br /><br />dms';
                    //print_r($dms);
                    //echo '<br /><br />orderposition';
                    // need to find word within $defmatseg
                    $wordsega = array_keys($defmatseg);
                    $wordseg = $wordsega[0];
                    //echo $wordseg;
                    $orderdms = array_search($wordseg, $orderw);
                    //echo $orderdms;
                    //echo '<br /><br />endposition';


                          if (strlen($orderdms) == 0 )
                          {
                          $positw[] = -1;
                          //$positw[] = $orderdms;

                          }

                          else
                          {

                          $positw[] = $orderdms;
                          //$positw[] = 99;

                          }

                      $defwordscq[$defnolist][$defind] = $positw;
                    }

              

              }
      }
   print_r($defwordscq);
   return $positw;
    
  } // closes function



  public function cqtwodef ()
  {


    // 1. what words are unique between two definitions?
    // 2. take first def and see what word match again all other defs. then take 2nd def and repeat, then 3rd def etc. etc.
    // Then we have array of all words the intersect each on a pairs level both ways, now use that array to find absolute unique words for each def and experiment with finding a variable to indicate a high level of confunsion exists and thus more effort should be put into disingushing the correct def. using that new data created.

        foreach ($this->deflist as $defnolist => $wdatal)
        {

        //
              foreach ($this->deflist as $defind => $wdata)
              {

              //$diffab = '';
              // intersect array list unique words
              $diffab = array_intersect_key($this->deflist[$defnolist], $this->deflist[$defind]);
              //echo $defind;
              //print_r($deflist[$defind]);
              //echo '<br /><br />';

              //print_r($diffab);
              //echo '<br /><br />';

              // from array from each def and associated matched words
                    foreach ($diffab as $difm => $difmno)
                    {

                    $defnomatch[$defnolist][$defind][] = $difm;

                    }


              } // closes foreach


        } // closes opening foreach


    } // closes function





        // function to count array matches and produce array of def with matching scores
        public function defmatcount ()
        {

        global $defnomatch;
        global $lifewordsagg;

        print_r($lifewordsagg);

              //foreach ($defnomatch as $defkey=>$defmat) {
              foreach ($lifewordsagg as $defkeyl=>$defnol)
              {

              echo '<br />deffirst<br />';
              echo $defkeyl;
              echo '<br /><br />';
              //print_r($defmat);
              //echo '<br />mat<br />';


              //print_r($defnomatch[$defkeyl][$defkeyl]);
              echo '<br />postmat<br />';

                  foreach ($lifewordsagg as $defkeylb=>$defnolb)
                  {

                  $matno = count($defnomatch[$defkeyl][$defkeylb]);

                  echo $matno;
                  echo '<br />mat<br />';
                  // form new array with def pair and match count
                  $defmatpair[$defkeyl][$defkeylb] = $matno;

                  } // closes 2nd foreach


              } // closes foreach

print_r($defmatpair);


      } // closes function


} // closes class

?>

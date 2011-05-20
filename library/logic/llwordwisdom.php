<?php
/**
 * LifestyleLinking
 *
 * Make a definition or content source words wise by frequency count and or confusion quotent 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Removes markup around content authored on the web
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLwordWisdom
{
  
  // two techniques on offer (basic crowd wisdom is based on frequency of word use in authoring)
  // 1. exluded words, 1 length characters
  // 2. CQ confusion quotent - identifies differenciating words between definitions (if definitions are being called)
  // other stuff that will go on. look at structure of text, updating of definition over time, combining definitions
  
    protected $defdata;
    protected $indivData;
    protected $excludewords;
    protected $remove;
    protected $wiselength;
    
    /** laods in id and words along with assumptions 
     *
     * frequency count and excluded words  (CS not live) 
     *
     */
    public function __construct($cleanDefinition)
    {
      global $aset;
      $this->remove = $aset->assumptions['remove'];
      $this->wiselength = $aset->assumptions['numberwisewords'];
      $this->defdata = $cleanDefinition;
      $this->wisdomLogic();
    }

    /**  Calls on two wise functions
     *
     *  excluded words and word frequency
     *
     */
   public function wisdomLogic()
  {
      // loadup exlcluded words if not alreadyloaded
      $this->loadExcludewords();
      $this->wordFrequency();
      //$this->wiseWords();
  }
  
    /**  counts word frequency
     *
     *  frequency count called votes for a word
     *
     */  
  public function wordFrequency()
  {
      // order words by frequency of occurance and then knockout excluded words
      ;
      // remove special words from post words
            if ((isset($this->defdata) == 1) && (isset($this->excludewords) == 1) ) {

            // contains an array of words that belong to both post and special words arrays
            $a3 = array_intersect($this->defdata, $this->excludewords);
            //echo count($a3);

                      if ( (isset($this->defdata) == 1 ) && (isset($a3) == 1 ) ) {

                      // removes special words to leave an array ready for sort and limit size
                      $result = array_diff_assoc($this->defdata, $a3);
                      //print_r($result);

                      $wordsorder = (array_count_values($result));
                      //print_r($wordsorder);

                      arsort($wordsorder);
                      //print_r($wordsorder);

                      // contains array of words order by frequency they scored, highest first, limited to fifty?
                      $this->wiseData[1] = array_slice($wordsorder, 0, $this->wiselength);
                      
                      }
            }

  
    }
  
  /**  excluded words
     *
     *  'joining' languages  (will be replaced be CQ)
     *
     */  
  public function loadExcludewords()
  {
      // if more than one definition in the universe - look to see if 'the system' will find them confusing to classify?
     $sourcelist = file_get_contents('http://www.aboynejames.co.uk/opensource/LL/llcore/text/excludewords.txt');
     
     // are any of the excluded words in definitions if so, do not exclude them
     
     $this->excludewords = explode(",", $sourcelist);
      
    }
  
  /**  return the wise words
     *
     *  
     *
     */
   public function wiseWords()
  {
      //print_r($this->wiseData);
      return $this->wiseData;
  }
  
  
  
  /**  removes special characters
     *
     *  
     *
     */
  public function tidyspecialchars()
  {
    
    // before running this function need to make sure none of the remove list are in a definition
    
      // if more than one definition in the universe - look to see if 'the system' will find them confusing to classify?
     $remove = $this->remove;
     $rawcontentc = str_replace($remove," ", $rawcontentb);
      
  
    }



  /**  find frequent words via CQ
     *
     *  
     *
     */
  public function frequentWords()
  {
      // can we find the most requently used 'joining' words from perform CQ on enough definitions from wikipedia ie crowd source the most frequently use words e.g. a and the another also etc. but all for inclusion of core to definition?
      
      
      
  
    }
  
  
} // closes class




?>
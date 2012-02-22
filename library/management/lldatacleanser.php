<?php
/**
 * LifestyleLinking
 *
 * Clean definition and source content of markup 
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
	class LLDataCleanser {

    protected $data;
    protected $cleanedData;
    protected $wlen;
    protected $postcontent;
    protected $limitlist;
    //public $aset;
    protected $remove;
    protected $minlength;

   /**  constructor
     *
     *  
     *
     */
    public function __construct($dataToBeCleaned)
    {
        
        global $aset;
        
          $this->remove = $aset->assumptions['remove'];
          $this->charperwordlength = $aset->assumptions['characterperwordmax'];
          $this->minlength = $aset->assumptions['wordlength'];
          $this->data = $dataToBeCleaned;
//echo 'clean data in';
//print_r($this->data);
        }

   /**  cleans markup
     *
     *  also want to collect basic stats on input content and to extract html links to video, photos links etc.
     *
     */
    public function clean()
    {
    // removes markup, goal is to produce the actual input content the author expressed and non of the markup or code to display or make portible etc.
          // split into single text units (capturing stats on content structure, no. words, sentences, time, identity, place, weather, any input context data?
          
         //$rawcontent = html_entity_decode($this->data);
        // echo $rawcontent;
         //$rawcontentb = strip_tags($rawcontent);
         
         // this remove is in two places need to think out chicken n egg untidy v tidy, e.g. html markup or context of the text authored?
        
         $remove = $this->remove;
         $rawcontent = str_replace($remove, " ", $this->data);
         //$rawcontentd = trim($rawcontentc);
          //echo $rawcontentd;    
          // $startc = strip_tags($rawcontent);
          //$rawcontentc = html_entity_decode($rawcontent);
         $this->wlen = strlen($rawcontent);
         //echo $wlen;
          //should be done in wise words, also html could be in text not just as mark up.
                    if ($this->wlen > 0)
                    {

                     $this->postcontent = explode(" ", $rawcontent);
                                
                     }
          
          $this->postwords();
          
          } // closes function

   /**  turns string of words in an array list
     *
     *  sperates words
     *
     */
    public function postwords ()
    {
                // for list of words (array and ready for 'save format' could be xml s3 save (ie no sql) or insert to mysql (database)

                // logic only allow words greater than 1 character
                // limit the number of words included in list 50 give flexibilit to change.
                // make sure white space removed
                    if ($this->wlen > 0 )
                    {
                            while(list($key, $val)=each($this->postcontent))
                            {
                            //$val = ereg_replace("(\\\*)+(/*)+('*)", "", $val);
                           // echo $val."\n";
                            $val = trim($val);
                            $val = substr($val, 0, $this->charperwordlength);
                            

                                       if(strlen($val) > $this->minlength )
                                       {
                                   
                                        $this->limitlist[] .= strtolower($val);
                                        
                                      }
                            }
                      
                  } // closes opening if

        } // closes function
          
   /**  cleans markup from simplepie feedreader
     *
     *  also want to collect basic stats on input content and to extract html links to video, photos links etc.
     *
     */
    public function cleanContent()
    {
    
      $rawstrip = strip_tags($this->data);
      $trans = get_html_translation_table(HTML_ENTITIES);

      $encoded = strtr($rawstrip, $trans);
      $decoded = str_replace($trans, "", $encoded);
      $arraywords = str_word_count($decoded, 1, '');

      foreach ($arraywords as $word)
      {
            if(strlen($word) > $this->minlength )
            {

            $small[] = strtolower($word);
        
            }

      
      }
//print_r($small);
      return $small;
    
    }

   /**  returns array of words
     *
     *  
     *
     */
    public function cleanedData()
  {
          return $this->limitlist;
    }

}

?>

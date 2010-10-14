<?php


class LLwordWisdom
{
  
  // two techniques on offer  (basic crowd wisdom is based on frequency of word use in authoring)
  // 1. exluded words, 1 length characters
  // 2. CQ  confusion quotent - identifies differenciating words between definitions (if definitions are being called)
  // other stuff that will go on.  look at structure of text, updating of definition over time, combining definitions
  
  
    protected $defdata;
		protected $indivData;
    protected $excludewords;
    
    public function __construct($cleanDefinition)
		{
      $this->defdata = $cleanDefinition;
      $this->wisdomLogic();
		}
	
	
  	public function wisdomLogic()
		{
      // loadup exlcluded works if not alreadyloaded
      $this->loadExcludewords();
      $this->wordFrequency();
//      $this->wiseWords();
    } 
  
  
		public function wordFrequency()
		{
      // order words by frequency of occurance and then knockout excluded words
      ;
      //  remove special words from post words
            if ((isset($this->defdata) == 1)  &&  (isset($this->excludewords) == 1) )  {

            // contains an array of words that belong to both post and special words arrays
            $a3 = array_intersect($this->defdata, $this->excludewords);
            //echo count($a3);

                      if ( (isset($this->defdata) == 1 ) && (isset($a3) == 1 ) )  {

                      // removes special words to leave an array ready for sort and limit size
                      $result = array_diff_assoc($this->defdata, $a3);
                      //print_r($result);

                      $wordsorder = (array_count_values($result));
                      //print_r($wordsorder);

                      arsort($wordsorder);
                      //print_r($wordsorder);

                      // contains array of words order by frequency they scored, highest first, limited to twenty?
                      $this->wiseData[1] = array_slice($wordsorder, 0, 50);
                      
                      }
            }            

  
    } 
  
  
		public function confusionQuotent()
		{
      // if more than one definition in the universe - look to see if 'the system' will find them confusing to classify?
      
  
    }   
  
  
		public function loadExcludewords()
		{
      // if more than one definition in the universe - look to see if 'the system' will find them confusing to classify?
     $sourcelist = file_get_contents('C:\apache\htdocs\llcore\text\excludewords.txt');
     $this->excludewords = explode(",", $sourcelist);
      
    }   
  
  
  	public function wiseWords()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->wiseData);
      return $this->wiseData;
  
    } 
  
  
  
  
} // closes class


?>
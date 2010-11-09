<?php

	class LLDataCleanser {
		
		protected $data;
		protected $cleanedData;
    protected $wlen;
    protected $postcontent;
    protected $limitlist;
    public $aset;
	
		public function __construct($dataToBeCleaned)
		{
    
    global $aset;
    echo 'from within data cleanser assump set up funct';
      //print_r($aset);
      $this->charperwordlength = $aset->assumptions['characterperwordmax'];  
      $this->data = $dataToBeCleaned;
   echo $this->charperwordlength.'max no characters per world';
		}
		
   //  also want to collect basic stats on input content and to extract html links to video, photos links etc. 
    
		public function clean()
		{
			//   removes markup,  goal is to produce the actual input content the author expressed and non of the markup or code to display or make portible etc.
      //  split into single text units  (capturing stats on content structure, no. words, sentences, time, identity, place, weather, any input context data?
      
     $rawcontent = html_entity_decode($this->data);
     //echo $row->content;    
     $rawcontentb = strip_tags($rawcontent);
    // $remove = array("'", "-", ",", "(",")", "?", ".", "&rsquo;", "&ldquo;", "&rsquo;", "&rdquo;", ":", "@", "!", "#",  "^", "%", "/", "|", '\'', "+", "=", "{", "}", "[", "]", '"', ";", "*", "<", ">", "_", "~", "<br />", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "also", "www", "jpg", "org", "html", "http", "–", "com" );
     //$rawcontentc = str_replace($remove," ", $rawcontentb); 
     $rawcontentd = trim($rawcontentb); 
         
     $this->wlen = strlen($rawcontentd);      
     //echo $wlen;
      //should be done in wise words,  also html  could be in text not just as mark up.
                if ($this->wlen > 0)
                {

                 $this->postcontent = explode(" ", $rawcontentd);
                            
                 }
      
      $this->postwords();

      } // closes function


		public function postwords ()
		{
            // for list of words (array and ready for 'save format' could be xml s3 save (ie no sql) or insert to mysql (database)

            // logic only allow words greater than 1 character
            // limit the number of words included in list 50  give flexibilit to change.
            // make sure white space removed
                if ($this->wlen > 0 )
                {
                        while(list($key, $val)=each($this->postcontent))
                        {
                        $val = ereg_replace("(\\\*)+(/*)+('*)", "", $val);
                        $val = substr($val, 0, $this->charperwordlength);
                        $val = trim($val); 

                                   if(strlen($val) > 0 )
                                   {
                               
                                    $this->limitlist[] .= strtolower($val);
                                    
                                  }
                        }
                  
              } // closes opening if

    } // closes function 
      

		
		public function cleanedData()
    {
      return $this->limitlist;
		}
	}

?>
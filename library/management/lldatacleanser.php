<?php

	class LLDataCleanser {
		
		protected $data;
		protected $cleanedData;
    protected $wlen;
    protected $postcontent;
    protected $limitlist;
    //public $aset;
    protected $remove;
    protected $minlength;
	
		public function __construct($dataToBeCleaned)
		{
    
    global $aset;
    
      $this->remove = $aset->assumptions['remove'];
      $this->charperwordlength = $aset->assumptions['characterperwordmax']; 
      $this->minlength = $aset->assumptions['wordlength'];      
      $this->data = $dataToBeCleaned;
   		}
		
   //  also want to collect basic stats on input content and to extract html links to video, photos links etc. 
    
		public function clean()
		{
			//   removes markup,  goal is to produce the actual input content the author expressed and non of the markup or code to display or make portible etc.
      //  split into single text units  (capturing stats on content structure, no. words, sentences, time, identity, place, weather, any input context data?
      
     $rawcontent = html_entity_decode($this->data);
     //echo $row->content;    
     $rawcontentb = strip_tags($rawcontent);
     
     // this remove is in two places need to think out chicken n egg  untidy v tidy,  e.g. html markup or context of the text authored?
     $remove = $this->remove;
     $rawcontentc = str_replace($remove," ", $rawcontentb); 
     $rawcontentd = trim($rawcontentc); 
         
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

                                   if(strlen($val) > $this->minlength )
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
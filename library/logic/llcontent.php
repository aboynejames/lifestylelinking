<?php

class LLcontent
{

     protected $contentin;  // input from e.g. rss feedreader 
     protected $contentStart;

        // feed in the content
     		public function contentData($contentraw)
		{
			// TODO: Check that postWords is in the correct format
      
        $inputdata[1][1] = file_get_contents('C:\apache\htdocs\llcore\text\skiing.txt');  // temporary data
        $inputdata[1][2] = file_get_contents('C:\apache\htdocs\llcore\text\swimming.txt');  // temporary data
        $inputdata[2][3] = file_get_contents('C:\apache\htdocs\llcore\text\skiings2.txt');
        $inputdata[2][4] = file_get_contents('C:\apache\htdocs\llcore\text\swimmings2.txt');
        
			  $this->contentin = $inputdata;
        //print_r($this->contentin);
            
		}
     
     
  

    public function contentManager($source)
		{
			// If a new content is being added then attach a new content identity to it (no.1 + linked data url e.g. dpedia
      //  also someday, the source content maybe 'rescored 'ie used based on a 'new' science
      // also what api will be use installed rssreader or 'as a service' to superfeedr/third party rss/firehose
      
     // check if new, if so attached content id to it ie a number for this framework and ideally a FOAF i.e. unique id for whole of web.

      // first call and get list of all content ids stored in the framework (has the new content id be process else where in the LL universer check peer to peer)
      // to be built
      
      $this->contentStart = $this->contentin;
      
      //$source = array('0'=>'1', '1'=>'2');
     // feed in new content on a per sourceid
      foreach($source as $sid)
      {
      
      $this->startNewcontent($sid);
      
      }
      
      
		} 
   

    public function startNewcontent($sid)
		{
			// starts methods to add new definition(s)
			      // one or more defintions?
           // echo 'new content';
            
           foreach ($this->contentStart[$sid] as $contid=>$incont)
           {
            
            $this->buildContent($sid, $contid, $incont);
            
            } // closes foreach loop

      
		}

     
    // clean the new content data 
		public function buildContent($sid, $contid, $incont)
		{
			// Note: use arrays and not database

			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($incont);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanContent[$sid][$contid] = $dataCleaner->cleanedData();
        
      }


		public function cleanedContent()
    {
    //print_r($this->cleanContent);
      return $this->cleanContent;
		}


  }  // closes class
  
  
  ?>

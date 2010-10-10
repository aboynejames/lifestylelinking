<?php

	class LLmatrix {
		
		protected $wordsarray;
		protected $definitionarray;
    protected $wordseg;
    protected $matched;
    protected $scoring;
    protected $matrix;
	
		public function __construct($definitiontidy, $wordstidy)
		{
      $this->definitionarray = $definitiontidy;	
      $this->wordsarray = $wordstidy;
           
      //  need to set segmentation (need to allow future flexibility on this e.g. sentence structure, NLP
      $this->wordseg = array ( 1, 2, 3, 4, 5, 10, 20, 50 );

    }



    public function startLLmatrix() 
    {
      
      // if word and definition data not in arrays, then need to make them (either input nosql or query database}.
      if ( (isset($this->definitionarray) == 1)  &&  (isset($this->wordsarray) == 1)  )
      {
  
      // this required if more than one definition in core
      foreach ($this->definitionarray as $lifeindexid=>$lifewordsarray)
      {
//print_r($lifewordsarray);
                 foreach ($this->wordseg as $seg)
                 {
//echo $seg;
                  unset($aa3);
                  unset($lifewordsarrays);
                  unset($insertscore);


                  $lifewordsarrays = array_slice($lifewordsarray, 0, $seg);
                  print_r($lifewordsarrays);

                  echo "<br />newwww<br />";
                  print_r($this->wordsarray[1]);
                  $aa3 = array_intersect_key( $lifewordsarrays, $this->wordsarray[1]);
                  print_r($aa3);

                              if (count($aa3) > 0 )
                              {
                              //echo '<br /><br />';
                              $wordsmatched = count($aa3);
                              //echo $wordsmatched;
                              //echo '<br /><br />';
                              $postscore = array_sum($aa3);
                              //echo $postscore;
                               
                              $this->matrix[1][matched][$seg] = $wordsmatched;
                              $this->matrix[1][scoring][$seg] = $postscore;

                              }

                              else
                              {

                              $this->matrix[1][matched][$seg] = 0;
                              $this->matrix[1][scoring][$seg] = 0;
                              }

                }  // closes slice foreachloop
        }  // first loop 
       } // closes if
      
      }  //  closes function

  
  	public function matrixComplete()
		{
      // loadup exlcluded works if not alreadyloaded
      //print_r($this->matrix);
      return $this->matrix;
  
    } 



} // closes class

?>
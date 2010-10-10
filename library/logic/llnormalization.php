<?php


class LLstatistics
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





?>
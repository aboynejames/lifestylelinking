<?php

	class LLDataCleanser {
		
		protected $data;
		protected $cleanedData;
	
		public function __construct($dataToBeCleaned)
		{
			$this->data = $dataToBeCleaned;
		}
		
		public function clean()
		{
			// Take the coode from old core/logic/wordprep.php
			// James - use  confusion quotient
		}
		
		public function cleanedData()
		{
			return $cleanedData;
		}
	}

?>
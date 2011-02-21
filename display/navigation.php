<?php
/**
 * LifestyleLinking
 *
 * Takes raw data and make it available to display anywhere on the web
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Handles all display for the framework
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
	class LLNavigation
	{
  
  
    public $navigation;
    protected $navcontext;
    protected $resultstringpath;
  
        /**
     * Constructor 
     *
     *  // 
     *
     * 
     *
     * @param  
     *
     */
   public function __construct($selectedlifestyle, $lifestylemenu, $resultpath, $sitedomain, $resultlinking)
		{
		
    $this->lifestylelive = $selectedlifestyle['wikipedia'];
 echo 'passednavigation';
 print_r($selectedlifestyle);
    $this->lifemenu = $lifestylemenu;
    $this->resultstringpath = $resultpath;
    $this->domainurl = $sitedomain;
    $this->resultlinking = $resultlinking;
    
    $navigation = $this->buildnavigation();
    
 		} 

    /**
     *
     *
     *
     */
    public function buildnavigation ()
    {
    
        if(is_array($this->lifemenu) == true)
        {
        
        $this->navigation();
        $this->formurllifestyleurlstrings($this->lifestylelive, $this->lifemenu);
        $this->navigationLifestyle($this->lifestylelive, $this->lifestylemenudata);
        
        }
        
        else
        {
        
        $this->navigation();
          
        }

    
    }


    /**
     *
     *
     *
     */
    public function navigation ()
    {
?>    
    <header id="accountnav" class="body">
	
  	<nav><ul>
		<li class="active"><a href="#">login</a></li>
	   </ul></nav>
  
  </header><!-- /#banner -->

<?php
    
    }

    /**
     *
     *
     *
     */
    public function formurllifestyleurlstrings ($menulive, $lifestylemenu)
    {
 echo 'liveresultlinking';
print_r($this->resultlinking); 
      $baseurl =  $this->domainurl;
echo 'baseurl=='.$baseurl;      
      $startscriptpath = $this->resultstringpath['pathscript'];
      $currentpathquerystring = $this->resultstringpath['pathurlstring'];
echo 'currrent string url';
print_r($this->resultstringpath);
      parse_str($currentpathquerystring, $reformpathquerystring);
print_r($reformpathquerystring);
      // reform query path string url for  intention and resultsid
          foreach($reformpathquerystring as $llq=>$qvalue)
          {
//echo $qvalue.'index';
            if($llq == 'intention')
            {
            
             $newmenupathstring[$llq] = 'results';
             
             }
             
             elseif($llq == 'll')
             {
             
              // ignore will be build in below 
              
             
             }
             
             elseif($llq == 'pathid')
             {
             
              // ignore will be build in below 
              
             
             }
             
             else
             {
             
             $newmenupathstring[$llq] = $qvalue;
             
             }
          
          }
      
              // add resultsid
              //$newmenupathstring['pathid'] = $this->resultstringpath['pathid'];
//print_r($newmenupathstring);          
              // convert array to string
              $newquerypart = http_build_query($newmenupathstring);
      
     
        foreach($lifestylemenu as $lid=>$lifestyleword)
        {
          
             if(isset($this->resultlinking[$lid]))
            {
             $this->lifestylemenudata[$lid]['pathurl'] = $baseurl.$startscriptpath.'?ll='.$lifestyleword.'&'.$newquerypart.'&pathid='.$this->resultlinking[$lid]['pathid'].'&resultsid='.$this->resultlinking[$lid]['resultsid'];
             $this->lifestylemenudata[$lid]['lifestyle'] = $lifestyleword;
             }
             else
             {
              // new results need to be processed
              $this->lifestylemenudata[$lid]['pathurl'] = $baseurl.$startscriptpath.'?ll='.$lifestyleword.'&logic=single&intention=newstart&display=blogposts&pathtime=86400&make=past&filter=on&psource=&stream=10&pathid=&resultsid=';
              $this->lifestylemenudata[$lid]['lifestyle'] = $lifestyleword;
             
             }
        }
echo 'finished url data';         
print_r($this->lifestylemenudata);
    
    return $this->lifestylemenudata;
    
    }

    /**
     *
     *
     *
     */
    public function navigationLifestyle ($menulive, $lifestylemenu)
    {
?>
      <header id="banner" class="body">
       <nav><ul>
<?php
//print_r($lifestylemenu);
        $lifemenu = '';
      // needs to be built from 
      foreach($lifestylemenu as $lid=>$lifestyle)
      {
//echo 'live'.$menulive.'menu'.$lifestyle['lifestyle'];
      if($menulive == $lifestyle['lifestyle'])
      {
      
      $lifemenu .=     '<li class="active"><a href="'.$lifestyle['pathurl'].'">'.$lifestyle['lifestyle'].'</a></li>';
      
      }
      
      else
      {
      
      $lifemenu .= '<li><a href="'.$lifestyle['pathurl'].'">'.$lifestyle['lifestyle'].'</a></li>';
       
       }


      }
      echo $lifemenu; 
?>    
          </ul></nav>

        </header><!-- /#banner -->

<?php
    
    }

        

} // closes class
        ?>
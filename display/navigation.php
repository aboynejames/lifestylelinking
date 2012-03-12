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
    
	//$this->tempmenu();
	$this->lifestylelive = $selectedlifestyle['wikipedia'];
	//echo 'passednavigation';
	//print_r($selectedlifestyle);
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
//echo 'lifestylemenuindisplay';
//print_r($this->lifemenu);   
        if(is_array($this->lifemenu) == true)
        {
        
   //     $this->navigation();
        $this->formurllifestyleurlstrings($this->lifestylelive, $this->lifemenu);
        $this->navigationLifestyle($this->lifestylelive, $this->lifestylemenudata);
        $this->addnewlifestyledefinition ();
	$this->addnewcontentsource ();
       
       }
        
        else
        {
        
     //   $this->navigation();
          
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
	
  	<nav>
			<ul class="menu-lifestyle">
				  <li class="active">
                <a class="menu-text" text="Signin" title="signin" href="api/index.php?signin">Sign In</a>
            </li>
            <li class="active">
                <a class="menu-text" text="start" title="start" href="api/index.php?ll=start">Start</a>
            </li> 
			</ul>  
     </nav>
  
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
//echo 'liveresultlinking';
//print_r($this->resultlinking); 
      $baseurl =  $this->domainurl;
//echo 'baseurl=='.$baseurl;      
      $startscriptpath = $this->resultstringpath['pathscript'];
      $currentpathquerystring = $this->resultstringpath['pathurlstring'];
//echo 'currrent string url';
//print_r($this->resultstringpath);
      parse_str($currentpathquerystring, $reformpathquerystring);
//print_r($reformpathquerystring);
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
              $this->lifestylemenudata[$lid]['pathurl'] = $baseurl.$startscriptpath.'?ll='.$lifestyleword.'&logic=single&intention=results&display=blogposts&pathtime=86400&make=past&filter=on&psource=&stream=10&pathid=&resultsid=';
              $this->lifestylemenudata[$lid]['lifestyle'] = $lifestyleword;
             
             }
        }
//echo 'finished url data';         
//print_r($this->lifestylemenudata);
    
    return $this->lifestylemenudata;
    
    }

    /**
     *
     *
     *
     */
    public function navigationLifestyle ($menulive, $lifestylemenu)
    {
    
    
$amingfor ='          <header id="banner" class="body">

        <nav>
			<ul class="stream-lifestyle">
				  <li class="stream-lifestyle stream-lifestyle-skiing live" >
                <a class="lifestyle-text" text="Skiing lifestyle" title="home" href="api/index.php?ll=Skiing">Skiing</a>
            </li>
				  <li class="stream-lifestyle stream-lifestyle-Swimming">
                <a class="lifestyle-text" text="Swimming lifestyle" title="news" href="api/index.php?ll=Swimming">Swimming</a>
            </li>
            <li class="stream-lifestyle stream-lifestyle-Hill Walking">
               <a class="lifestyle-text" text="Hillwalking lifestyle" title="interviews" href="api/index.php?ll=HIllwalking">Hill Walking</a>
            </li>
            <li class="stream-lifestyle stream-lifestyle-Fiddling">
                <a class="lifestyle-text" text="Fiddling lifestyle" title="external" href="api/index.php?ll=Fiddling">Fiddling</a>
            </li>
			</ul>
			<span class="clear"></span>
      </nav>
		
    </header>'; 
    
    
?>
      <header id="banner" class="body">
       <nav>
       <ul class="stream-lifestyle">
<?php
//print_r($lifestylemenu);
        $lifemenu = '';
      // needs to be built from 
      foreach($lifestylemenu as $lid=>$lifestyle)
      {
//echo 'live'.$menulive.'menu'.$lifestyle['lifestyle'];
      if($menulive == $lifestyle['lifestyle'])
      {
      
      $lifemenu .= '<li  class="stream-lifestyle stream-lifestyle-'.$lifestyle['lifestyle'].'-live">';
      $lifemenu .= '<a href="'.$lifestyle['pathurl'].'">'.$lifestyle['lifestyle'].'</a></li>';
      
      }
      
      else
      {
      
      $lifemenu .= '<li  class="stream-lifestyle stream-lifestyle-'.$lifestyle['lifestyle'].'">';
      $lifemenu .= '<li><a href="'.$lifestyle['pathurl'].'">'.$lifestyle['lifestyle'].'</a></li>';
       
       }


      }
      echo $lifemenu; 
?>    
          </ul></nav>

        </header><!-- /#banner -->

<?php
    
    }
    
    
    /**
     *
     *
     *
     */    
	public function addnewlifestyledefinition ()
	{
	
	
?>
<strong>new</strong>
 <form id="addnewlife" action=""  method="post">

<input type="text" id="life_def" name="lldef" />
<p><input id="addnew-life" type="submit" name="submitBtn" value="Add new lifestyle" /> </p>

</form>
	
	
<?php	
	}
    


	/**
	*
	*
	*
	*/    
	public function addnewcontentsource ()
	{
	
	
?>
<strong>new</strong>
 <form id="addnewcontent" action=""  method="post">

<input type="text" id="life_content" name="llcont" />
<p><input id="addnew-content" type="submit" name="submitBtn" value="Add new content feed" /> </p>

</form>
	
	
<?php	
	}
    





public function tempmenu ()
{

?>
          <header id="banner" class="body">

        <nav>
			<ul class="stream-lifestyle">
				  <li class="stream-lifestyle stream-lifestyle-skiing live" >
                <a class="lifestyle-text" text="Skiing lifestyle" title="home" href="api/index.php?ll=Skiing&intention=results">Skiing</a>
            </li>
				  <li class="stream-lifestyle stream-lifestyle-Swimming">
                <a class="lifestyle-text" text="Swimming lifestyle" title="news" href="api/index.php?ll=Swimming&intention=results">Swimming</a>
            </li>
            <li class="stream-lifestyle stream-lifestyle-Hill Walking">
               <a class="lifestyle-text" text="Hillwalking lifestyle" title="interviews" href="api/index.php?ll=HIllwalking&intention=results">Hill Walking</a>
            </li>
            <li class="stream-lifestyle stream-lifestyle-Fiddling">
                <a class="lifestyle-text" text="Fiddling lifestyle" title="external" href="api/index.php?ll=Fiddling&intention=results">Fiddling</a>
            </li>
			</ul>
			<span class="clear"></span>
      </nav>
		
    </header>'
 
<?php 
    }
        

} // closes class
        ?>
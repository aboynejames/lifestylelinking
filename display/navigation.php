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
   public function __construct($selectedlifestyle, $lifestylemenu)
		{
		
    $this->lifestylelive = $selectedlifestyle;
    $this->lifemenu = $lifestylemenu;
    
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
        $this->navigationLifestyle($this->lifestylelive, $this->lifemenu);
        
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
    public function navigationLifestyle ($menulive, $lifestylemenu)
    {
?>
      <header id="banner" class="body">
       <nav><ul>
<?php
      // needs to be built from 
      foreach($lifestylemenu as $lifestyle)
      {
      
      if($menulive == $lifestyle)
      {
      
      $lifemenu .= '	<li class="active"><a href="#">'.$lifestyle.'</a></li>';
      
      }
      
      else
      {
      
      $lifemenu .= '<li><a href="#">'.$lifestyle.'</a></li>';
       
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
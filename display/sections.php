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
	class LLSections
	{
  
    public $sections;
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
   public function __construct($selectedlifestyle, $resultsdata, $contextfilter, $startpathtime, $endpathtime)
		{

    $this->lifestylelive = $selectedlifestyle;
    $this->datatodisplay = $resultsdata;
    $this->filterstatus = $contextfilter;
    $this->startime = $startpathtime;
    $this->endtime = $endpathtime;
    
    $this->buildsections();
    
 		} 

    /**
     *
     *
     *
     */
    public function buildsections()
    {
      // what display media has been selected startpage, blogresults, photos, videos etc.
         // if(is_array($this->datatodisplay) == true )
          //{
          
          $this->lifestyleSummary();
    //      $this->blogsections($this->datatodisplay);
      //    $this->buildBlogroll($this->datatodisplay['peergroup']);
          $this->personalizeSettings();
          
         // }
      
    
    }

    /**
     *
     *
     *
     */
    public function lifestyleSummary()
    {
?>    
       <aside id="featured" class="body">
       <article>
      <figure>
        <img src="display/images/wikipedia.png" alt=" definition" />  text from wikipedia for this lifestyle ...
      </figure>
      <hgroup>
        <h2><?php echo $this->lifestylelive['wikipedia'] ?></h2> Lifestyle 
        <a href="#"><img src="display/images/chart.png"></a>
      </hgroup>
      <p>
      <?php echo $noposts . 'new posts'  .$this->startime . 'to'. $this->endtime . 'Filter' . $this->filterstatus; ?>
      </p>

    </article>
    </aside><!-- /#featured --> 
<?php
    }
    
    /**
     *
     *
     *
     */
    public function blogsections($blogresults)
    {
?>
    <section id="content" class="body">

      <ol id="posts-list" class="hfeed">

<?php
          foreach($blogresults as $resultid=>$content)
          {
          ?>
          <li><article class="hentry">
            <header>
              <h2 class="entry-title"><a href="<?php echo $content['posturl'] ?>" rel="bookmark" title="<?php echo $content['posttitle'] ?>"><?php echo $content['posttitle'] ?></a></h2>
            </header>

            <footer class="post-info">
              <abbr class="published" title="<?php echo $content['postdate'] ?>"><!-- YYYYMMDDThh:mm:ss+ZZZZ --><?php echo $content['postdate'] ?>
              </abbr>

              <address class="vcard author">
                By <a class="url fn" href="<?php echo $content['blogurl'] ?>"><?php echo $content['blogname'] ?></a>
              </address>
            </footer><!-- /.post-info -->

            <div class="entry-content">
              <p><?php echo $content['postcontent'] ?>.</p>

            </div><!-- /.entry-content -->
          </article></li>
  <?php        
          }
?>
      </ol><!-- /#posts-list -->

    </section><!-- /#content -->
    
<?php
      }
     
     /**
     *
     *
     *
     */
    public function buildBlogroll($blogroll)
    {
?>
    <section id="extras" class="body">
      <div class="blogroll">
        <h2><?php echo $this->lifestylelive['wikipedia'] ?> Blog Roll</h2>
        <ul>
<?php
          foreach($blogroll as $peerid=>$peer)
          {
?>          
             <li><a href="<?php echo $peer['blogurl'] ?>" rel="external"><?php echo $peerid . $peer['blogname'] ?></a></li>
<?php          
          }
          
?>
          
        </ul>
      </div><!-- /.blogroll -->

      
    </section><!-- /#extras -->
<?php
      }
      
      
     /**
     *
     *
     *
     */
    public function personalizeSettings()
    {
 ?>   
    <section id="extras" class="body">

    <h2>Personalize further</h2>

    <div class="social">
        <h2>social</h2>
        <ul>

          <li><a href="http://delicious.com/aboynejames" rel="me">delicious</a></li>
          <li><a href="http://digg.com/users/aboynejames" rel="me">digg</a></li>
          <li><a href="http://facebook.com/aboynejames" rel="me">facebook</a></li>

          <li><a href="http://www.lastfm.es/user/aboynejames" rel="me">last.fm</a></li>
          <li><a href="http://www.aboynejames.co.uk/wordpress/feeds/" rel="alternate">rss</a></li>
          <li><a href="http://twitter.com/aboynejames" rel="me">twitter</a></li>

        </ul>
      </div><!-- /.social -->
      
          <div class="social">
        <h2>Data Apps</h2>
        <ul>

          <li><a href="#" rel="me">Fitbit.com</a></li>
          <li><a href="#" rel="me">Nike.com</a></li>
          <li><a href="#" rel="me">Mapmyrun.com</a></li>

          <li><a href="#" rel="me">Caloriecount.com</a></li>


        </ul>
      </div><!-- /.social -->
      
                <div class="social">
        <h2>Medical Record</h2>
        <ul>

          <li><a href="#" rel="me">NHS.org.uk</a></li>
          <li><a href="#" rel="me">Webmd.com</a></li>
          <li><a href="#" rel="me">Organizedwisdom.com</a></li>

          <li><a href="#" rel="me">23andme.com</a></li>


        </ul>
      </div><!-- /.social -->
      
                      <div class="social">
        <h2>Make</h2>
        <ul>

          <li><a href="#" rel="me">shwowp.com</a></li>
          <li><a href="#" rel="me">ebay.com</a></li>
          <li><a href="#" rel="me">amazon.com</a></li>

          <li><a href="#" rel="me">hilltrek.co.uk</a></li>
          <li><a href="#" rel="me">mymuseli.co.uk</a></li>
          <li><a href="#" rel="me">spreadshirt.co.uk</a></li>


        </ul>
      </div><!-- /.social -->
      
      </section><!-- /#extras -->
    
<?php
    }  // closes function


} // closes class

?>
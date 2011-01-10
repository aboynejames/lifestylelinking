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
   public function __construct()
		{
		
    $this->sections = $this->buildsections();
    
 		} 

    /**
     *
     *
     *
     */
    public function buildsections()
    {
    
    $sectionparts = $this->sectionstart();
    
    return $sectionparts;
    
    }

    public function sectionstart()
    {
?>
        <section id="llbox" class="body">

        <img src="display/images/LLlogowhite.png"><br><br>

        <form>
          <input name="ll" type="search"  >
          <input name="logic" type="hidden" value="auto" >
          <input name="intention" type="hidden" value="newstart" >
          <input name="display" type="hidden" value="blogposts" >
          <input name="time" type="hidden" value="86400" >
          <input name="make" type="hidden" value="past" >
          
          <br>
            <input type="submit" value="Start lifestylelinking">
        </form>

        </section><!-- /#content -->

<?php
    }
    
    /**
     *
     *
     *
     */
    public function sections()
    {
?>
    <section id="llbox" class="body">

    <img src="display/images/mepath.png"><br><br>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
      <input name="ll" type="search"  >
      <br>
        <input type="submit" value="Start lifestylelinking">
    </form>

    </section><!-- /#content -->



    <aside id="featured" class="body"><article>
      <figure>
        <img src="display/images/wikipedia.png" alt="swimming definition" />The aquatic sport of swimming is based on the human act of swimming ...
      </figure>
      <hgroup>
        <h2>Swimming</h2>
        <h3><a href="#">Personalized news</a></h3>
      </hgroup>
      <p>23 new posts - last 24 hrs <a href="#">Statistics</a> <a href="#"><img src="display/images/chart.png"></a></p>

    </article></aside><!-- /#featured -->


    <section id="content" class="body">

      <ol id="posts-list" class="hfeed">

        <li><article class="hentry">
          <header>
            <h2 class="entry-title"><a href="#" rel="bookmark" title="Swimming training for the day">Swim training for masters swimmers</a></h2>
          </header>

          <footer class="post-info">
            <abbr class="published" title="2010-10-10T14:07:00-07:00"><!-- YYYYMMDDThh:mm:ss+ZZZZ -->
              10th October 2010
            </abbr>

            <address class="vcard author">
              By <a class="url fn" href="#">Swim blogger</a>

            </address>
          </footer><!-- /.post-info -->

          <div class="entry-content">
            <p>As master swimming we are a committed bunch but we sometimes get into bad habbits at training.  Using tumble turns as rest, breathing in the red, using kick as a rest set! <a href="#">training blog</a> When it comes to race time all these small improvement will bring you much joy.</p>

          </div><!-- /.entry-content -->
        </article></li>

    <li><article class="hentry">
          <header>
            <h2 class="entry-title"><a href="#" rel="bookmark" title="Swimming training for the day">A blast in the morning</a></h2>
          </header>

          <footer class="post-info">
            <abbr class="published" title="2010-09-10T14:07:00-07:00"><!-- YYYYMMDDThh:mm:ss+ZZZZ -->
              10th October 2010
            </abbr>

            <address class="vcard author">
              By <a class="url fn" href="#">Fast flipper</a>

            </address>
          </footer><!-- /.post-info -->

          <div class="entry-content">
            <p>Was rocking at training this morning, coach set a tough set but  <a href="#">training blog</a> Cheers coach you are getting the best out of me.</p>

          </div><!-- /.entry-content -->
        </article></li>
        
        <li><article class="hentry">
          <header>
            <h2 class="entry-title"><a href="#" rel="bookmark" title="Swimming training for the day">F*** injury again</a></h2>
          </header>

          <footer class="post-info">
            <abbr class="published" title="2010-08-10T14:07:00-07:00"><!-- YYYYMMDDThh:mm:ss+ZZZZ -->
              10th October 2010
            </abbr>

            <address class="vcard author">
              By <a class="url fn" href="#">Tri to swim</a>

            </address>
          </footer><!-- /.post-info -->

          <div class="entry-content">
            <p>Sods law, help push a car out of the snow I have hurt my shoulder.  Its real painful swimming <a href="#">training blog</a> I guess it is rest for now.</p>

          </div><!-- /.entry-content -->
        </article></li>
      </ol><!-- /#posts-list -->

    </section><!-- /#content -->

    <section id="extras" class="body">
      <div class="blogroll">
        <h2>swimming blogroll</h2>
        <ul>

          <li><a href="#" rel="external">Swimming World</a></li>
          <li><a href="#" rel="external">Masters swimmer</a></li>
          <li><a href="#" rel="external">Triathlete times</a></li>

          <li><a href="#" rel="external">Faulty Flipper</a></li>
          <li><a href="#" rel="external">Rob Acquatics</a></li>
          <li><a href="#" rel="external">The water is always open</a></li>

          <li><a href="#" rel="external">Swim the channel</a></li>
           <li><a href="#" rel="external">Amazon to swim</a></li>
           <li><a href="#" rel="external">Tri to swim fast</a></li>

        </ul>
      </div><!-- /.blogroll -->

      
    </section><!-- /#extras -->


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
      </section><!-- /#extras -->
      

    <?php
    }  // closes function

} // closes class
        ?>
<?php 
//print_r($_SESSION);

    /**  
     *
     *  
     *
     */  
    function adminheader()
    {
    ?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8" />
        
        <title>open - lifestyle linking</title>
        <meta name="description" content="Main Page" />
        <meta name="page-topic" content="Homepage" />
        
        <meta name="robots" content="all" />
        <meta name="author" content="" />
        <meta name="author" content="" />
        <meta name="Keywords" content="" /> 	
        
        <!--Main Style Sheet-->
        <!--session selector to pick which stylesheet based on context if this header is in a php function-->
        <link href="css/admin.css" type="text/css" rel="stylesheet" id="stylesheet" />
      
    <!--[if IE]>

    <script>

    document.createElement("header");

    document.createElement("footer");

    document.createElement("nav");

    document.createElement("article");

    document.createElement("section");

    </script>

    <![endif]-->


      </head>
    <?php
    }  // closes function


    /**  
     *
     *  
     *
     */  
    function adminNavigation()
    {
    ?>  

      <header><h1>LifestyleLinking Control Panel</h1></header>

          <nav><p>Menu</p>
              <ul>
              <li><a href="index.php">HOME</a></li>
              <li><a href="dailyupdate.php">Dailyupdate</a></li>
              <li><a href="flickrdaily.php">Daily flickr photos</a></li>
              <!--<a href="/lifestylelinking/oauth/oauth-php-r50/test/firstinstantance.php">OAuth</a> -->
              <li><a href="#">Youtube done live</a></li>
              <li><a href="definitioncontrol.php">Definitions Control</a> </li>
              <!-- <a href="/lifestylelinking/crawl/rsscrawlauto.php">Crawl centre</a>  -->
              <li><a href="newdata.php">Add newdata</a>  </li>
              <li><a href="peercontrol.php">Peer group Control</a></li>
              <li><a href="themes.php">Themes</a></li>
              <li class="active"><a href="#">login</a></li>
              </ul>
          </nav>

          </nav>

<?php
    }  // closes function


    /**  
     *
     *  
     *
     */  
    function adminSection()
    {
    ?>  
      <section>

      <p>Section</p>

          <article>
          <p><h1>TIME</h1>
          <?php// dailytimes() ; ?></p>
          </article>

          <article>
          <h1>Statistics summary </h1>

          <?php// activefeeds(); ?>

          <?php //postitemsall () ?>

          <?php //lasttwofourperiod () ?> 

          <?php //No results live, previous days (split per lifestyle)  ?>

          <?php //No users registered ?>

          <?php //No users logged in ?>
          </article>
          
          <article>
          <h1>Definitions</h1>

          <?php //livelifemags (); ?>
          </article>

      </section>
      
    <?php
    }  // closes function



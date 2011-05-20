<body id="index" class="home"> 
<p></p>
<span id="box" name="
%3Csection%20id%3D%22llbox%22%20class%3D%22body%22%3E%0D%0A%0D%0A%20%20%20%20%20%20%20%20%3Cimg%20src%3D%22display%2Fimages%2FLLlogowhite.png%22%3E%3Cbr%3E%3Cbr%3E%0D%0A%0D%0A%20%20%20%20%20%20%20%20%3Cform%20name%3D%22startll%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22ll%22%20id%3D%22ll%22%20type%3D%22text%22%20value%3D%22%22%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22logic%22%20id%3D%22logic%22%20type%3D%22hidden%22%20value%3D%22single%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22intention%22%20id%3D%22intention%22%20type%3D%22hidden%22%20value%3D%22newstart%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22display%22%20id%3D%22display%22%20type%3D%22hidden%22%20value%3D%22blogposts%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22pathtime%22%20id%3D%22pathtime%22%20type%3D%22hidden%22%20value%3D%2286400%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22make%22%20id%3D%22make%22%20type%3D%22hidden%22%20value%3D%22past%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22filter%22%20id%3D%22filter%22%20type%3D%22hidden%22%20value%3D%22on%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22psource%22%20id%3D%22psource%22%20type%3D%22hidden%22%20value%3D%22%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22stream%22%20id%3D%22stream%22%20type%3D%22hidden%22%20value%3D%2210%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22pathid%22%20id%3D%22pathid%22%20type%3D%22hidden%22%20value%3D%22%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cinput%20name%3D%22resultsid%22%20id%3D%22resultsid%22%20type%3D%22hidden%22%20value%3D%22%22%20%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%0D%0A%20%20%20%20%20%20%20%20%20%20%3Cbr%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Cinput%20type%3D%22submit%22%20id%3D%22start-lifestyle-linking%22%20value%3D%22Start%20lifestylelinking%22%3E%0D%0A%20%20%20%20%20%20%20%20%3C%2Fform%3E%0D%0A%0D%0A%20%20%20%20%20%20%20%20%3C%2Fsection%3E%3C%21--%20%2F%23llbox%20--%3E%0D%0A" ></span>

<?php
navigation ()
?>

<div id="loading" class="body">
			<img src="display/images/llwords.gif" alt="Lifestyle-Linking" />
		</div>


<div id="apicall" ></div>



<?php
 /**
     *
     *
     *
     */
    function navigation ()
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


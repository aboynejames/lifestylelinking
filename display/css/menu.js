
 		$(document).ready(function(){
    
    
    // $("#apicall").text(" ")
startbox = $("#box").attr("name");
//  $("#hmt").text(startbox);	

var starthtml = unescape(startbox);
  $("#apicall").html(starthtml);	


       var loading = $("#loading");
       var apicall = $("#apicall");

      $("#start-lifestyle-linking").click(function(e){
        
        e.preventDefault(e);
        
        showLoading();

        var startll = $("input#ll").val();
         /* var formin = $(this).attr("value");  */
         /*  whatdata =   $(this).attr("href"); */
         var urlform = "api/index.php?ll=" + startll + "&intention=newstart" ;
         apicall.load(urlform, hideLoading);
         $("#hmtt").text(urlform);	

			});
   

  $("a.menu-text").click(function(e){
  
  		e.preventDefault();
    
		//show the loading bar
		//showLoading();
		//load selected section
  	linkt = $(this).attr("title");
       /*$("#hmt").text(linkt);	*/
    urlt =   $(this).attr("href");
       $("#hmtt").text(urlt);	 
       
       
       switch(linkt){
        case "signin": 
				apicall.slideUp();
				apicall.load(urlt, hideLoading);
				apicall.slideDown(); 
				break;
			case "start":
       hideLoading;
				apicall.slideUp();
				//apicall.load(urlt, hideLoading);
         $("#apicall").html(starthtml);
         apicall.slideDown();
				break;
        
        }
 
    });



	//Manage click events
	$("#apicall").click(function(e){
  
  		e.preventDefault();


        
            var $tgt = $(e.target);
        if ($tgt.is("a.lifestyle-text")) {

            link = $($tgt).attr("title");
            /*$("#hmt").text(link);	*/
            url =   $($tgt).attr("href");
            $("#hmt").text(url);	

		//show the loading bar
		showLoading();
		//load selected section

          }
 
	   switch(link){
        case "home": 
				apicall.slideUp();
           apicall.load(url, hideLoading);
				apicall.slideDown(); 
				break;
			case "news":
				apicall.slideUp();
           apicall.load(url, hideLoading);
				apicall.slideDown();
				break;
			case "interviews":
				apicall.slideUp();
           apicall.load(url, hideLoading);
        apicall.slideDown();
				break;
			case "external":
				apicall.slideUp();
           apicall.load(url, hideLoading);
        apicall.slideDown();
				break;
			default:
				//hide loading bar if there is no selected section
				hideLoading();
				break;
        
        }

    });





    
   	//show loading bar
	function showLoading(){
		loading
			.css({visibility:"visible"})
			.css({opacity:"1"})
			.css({display:"block"})
		;
	}
  
	//hide loading bar
	function hideLoading(){
		loading.fadeTo(1000, 0);
	}; 
    
    
});


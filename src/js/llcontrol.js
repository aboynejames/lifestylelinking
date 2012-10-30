/**
*  jQuery listen for clicks and interactions	
* 
*/	
$(document).ready(function(){
console.log('jquery comes to life');
	// need to identify which swimmers css markup has been clicked
	$("a").click(function(e){
			e.preventDefault(e);

			idclick = $(this).attr("id");
			idname = $(this).attr("name");	
		
		switch(idclick){

			case "delicious": 
			$(".lifelens").append('<div id="tagcloud"></div>');
			break;
			
		}
			
	});	
	
});
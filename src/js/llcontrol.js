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
			
			aboynejamestagjson = '{"Swimming": 1, "Skiing": 2, "Hill Walking": 3, "Badminton": 2, "NodeJS": 1}';
			$("#tagcloud").text(aboynejamestagjson);

			break;
			
		}
			
	});	
	
});
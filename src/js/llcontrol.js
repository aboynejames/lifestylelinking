/**
*  jQuery listen for clicks and interactions	
* 
*/	
$(document).ready(function(){
console.log('jquery comes to life');
	// need to identify which swimmers css markup has been clicked
	$("a").click(function(e){
			e.preventDefault(e);
//console.log(e);
			idclick = $(this).attr("id");
			idname = $(this).attr("name");	
//console.log('clicked' + idclick + ' name ' + idname);		
		switch(idclick){

			case "delicious": 
			$(".lifelens").append('<div id="tagcloud"></div>');
			
			aboynejamestagjson = '{"Swimming": 1, "Skiing": 2, "Hill Walking": 3, "Badminton": 2, "NodeJS": 1}';
			aboynejameshtml = '<ul id="xdef" class="tagcloudwords" >';
			aboynejameshtml += '<li value="140" title="swimming"><a href="#" >Swimming</a><li value="138" title="skiing">Skiing<li value="136" title="hillwalking">Hill Walking<li value="134" title="badminton">Badminton<li value="132" title="nodejs">Node.js</ul>	<footer id="opencloselens" title="opencloselens" ><a href="#"   id="lensonoff" name="Open" >Close</a></footer>';
			$("#tagcloud").html(aboynejameshtml);

			break;
			
			case "":
			
			break;
			
		}
			
	});	
	
	// event deligation tagcloud
	$(".lifelens").click(function (e) {
		
			e.preventDefault(e);
		
		 var $tgt = $(e.target);
			findparent = $($tgt).parent();
			llflowfor = findparent.attr("title");	
//console.log(llflowfor);		
		switch(llflowfor){

			case 'swimming':
			// start lifestylelinking
			lifeflownav = ' <header id="lifeflownav" class="body"><nav><ul class="stream-lifestyle"><li class="stream-lifestyle stream-lifestyle-skiing live" ><a class="lifestyle-text" text="Skiing lifestyle" title="Swimming" href="blogflow/swimming">Swimming</a></li><span class="clear"></span></nav></header><!-- Live intention navigation-->';
		
			$(".lifeflow").html(lifeflownav);
			$(".lifeflow").append('<div class="liveflow"></div>');
			$(".liveflow").load('view/llflow.html');
			$(".tagcloudwords").slideUp();
			var opclset = $("#lensonoff").attr("name");
			$("#lensonoff").attr('name', 'Close');
			$("#lensonoff").text(opclset);
			break;
			
			case 'opencloselens':
			
			var opclset = $("#lensonoff").attr("name");
			if(opclset == "Open") {
				$(".tagcloudwords").slideUp();
				$("#lensonoff").attr('name', 'Close');
				$("#lensonoff").text(opclset);
			}
			else {
				$(".tagcloudwords").slideDown();	
				$("#lensonoff").attr('name', 'Open');
				$("#lensonoff").text(opclset);
			}
			break;
		
		}
	});	
			
		// event deligation tagcloud
	$(".lifeflow").click(function (e) {
		
			e.preventDefault(e);
		
		 var $tgt = $(e.target);
			findparent = $($tgt).parent();
console.log(findparent.attr("title"));	
		
		
	});
				
	
	
});
	/*********************************************************************	ultilità 	*/

	function notifica(msg){
		$('body').append("<div id='notifica'>"+msg+"</div>");
		$('#notifica').css("display","auto");
		setTimeout(function() {
      		$('#notifica').css("display","none");
		}, 3000);
	}

	



	

	

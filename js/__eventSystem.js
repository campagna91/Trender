$(window).on("scroll",function() {
  var menu = $("#moduleHeader");
  var side = $("#sidebar");
  var posizione = menu.position();
  $(window).scroll(function(){
    if ($(window).scrollTop() >= '70') {
      menu.addClass("fixedHeader");
      side.addClass("fixedSidebar");
    } else {
      menu.removeClass("fixedHeader"); 
      side.removeClass("fixedSidebar");
    }
  });
});
$(document).on("click",".actionResizeLeft",function(){
	if($("#sidebar").attr('class') == 'sidebarExtended'){
		$("#sidebar").removeClass('sidebarExtended');
		$("#sidebar").css('width','23%');
		$("#mainList").removeClass('mainListContracted');
		$("#mainList").addClass('mainListNormal');
	} else {	
		$("#mainList").addClass('mainListExtended');
		$("#mainList").removeClass('mainListNormal');
		$("#sidebar").addClass("sidebarContracted");
	}
});
$(document).on("click",".actionResizeRight",function(){
		$("#mainList").addClass('mainListNormal');
		$("#mainList").removeClass('mainListExtended');
		$("#sidebar").removeClass("sidebarContracted");
});
$(document).on("click",".actionResizeFull",function(){
		if($("#sidebar").attr('class') == 'sidebarExtended')
		{
			$("#sidebar").removeClass('sidebarExtended');
			$(this).text('>>');
			$("#sidebar").css('width','23%');
			$("#mainList").removeClass('mainListContracted');
			$("#mainList").addClass('mainListNormal');
			//var margin = ($("#mainList").width() / 6 ) * 5;
		} else {
			$("#mainList").addClass("mainListContracted");
			$("#sidebar").css('width','70%');
			$("#sidebar").addClass("sidebarExtended");
			$(this).text('<<');
		}
});

$(document).on("click",".close",function(){
	if($(this).next().prop('tagName') == 'DIV')
	{
		var id = $(this).next().attr('id');
		$(this).next().show();	
		$("#sidebar div[id!='"+id+"']").each(function(){
			if($(this).attr('id') != 'menuActions') $(this).hide();
		});
	}
});
$(document).on("mouseover","#mainList tr td[class!='typeTest']",function(){
	if($(this).parent().css('background-color') == 'rgba(0, 0, 0, 0)')
		$(this).parent().css('background-color','orange');

});
$(document).on("mouseleave","#mainList tr td[class!='typeTest']",function(){
	if($(this).parent().css('background-color') == 'rgb(255, 165, 0)')
		$(this).parent().css('background-color','rgba(0,0,0,0.0)');
});
$(document).on("click","#mainList tr td[class!='typeTest']",function(){
	$("#moduleTestSystem").remove();
	$("#moduleTestValidation").remove();
	$("#moduleTestIntegration").remove();
	$(this).parent().parent().find('tr').css('background-color','rgba(0,0,0,0.0)');
	$(this).parent().css('background-color','green');
});
function notice(msg,i){
		$('body').append("<div id='notice'>"+msg+"</div>");
		if(i) $("#notice").css("background-color","rgba(255,0,0,0.4");
		else $("#notice").css("background-color","rgba(0,255,0,0.4");
		setTimeout(function() {
      		$("#notice").remove();
		}, 3000);
	}

/*
	Actor list loader
*/
function loadList() {
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleActorsList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}
/*
	Actor insertion loader
*/
function loadInsert() {
	$("#actorsInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleActorsInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$('select').material_select();
		}
	});
}
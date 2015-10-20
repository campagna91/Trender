/*
	Usecases list loader
*/
function loadList(){
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleVerbalsList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}
/*
	Usecases insertion loader
*/
function loadInsert() {
	$("#verbalInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleVerbalsInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$('select').material_select();
		}
	});
}
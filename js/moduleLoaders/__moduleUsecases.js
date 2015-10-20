/*
	Usecases list loader
*/
function loadList(){
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecasesList.php',
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
	$("#usecasesInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecasesInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$('select').material_select();
		}
	});
}
/*
	Class list loader
*/
function loadList() {
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassesList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}
/*
	Class insertion loader
*/
function loadInsert() {
	$("#classesInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassesInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$('select').material_select();
		}
	});
}
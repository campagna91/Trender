/*
	UnitTest list loader
*/
function loadList(){
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUnitTestsList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}

/*
	UnitTest list loader
*/
function loadInsert(){
	$("#unitTestsInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUnitTestsInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$("select").material_select();
			console.log('success make easy');
		}
	});
}
/*
	Glossary terms list loader
*/
function loadList() {
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleGlossaryList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}

/*
	Glossary term list loader
*/
function loadInsert(){
	// none to do
}
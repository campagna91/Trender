/*
	funzione che carica tutti i moduli
*/
function loadAll(id, hide){
	loadList();
	loadUpdate(id, hide);
}
// ___________________________________________________________________________ MAINLIST
/*
	MODULO mainlist
*/
function loadList(){
	$("#mainList").children().each(function(){
		$(this).remove();
	});
	$.ajax({
		url: 'cgi-bin/__moduleUnitTestList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$(data).appendTo("#mainList");
		}
	});
}
// ___________________________________________________________________________ SIDEBAR
/*
	MODULO inserimento nuovo requisito
*/
function loadInsert(){
	$("#moduleInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUnitTestInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
/*
	MODULO per l'aggiornamento del requisito
*/
function loadUpdate(id, hide){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUnitTestUpdate.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarUpdate").after(data);
		}
	});
}
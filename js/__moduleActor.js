/*
	funzione che inizializza tutti i moduli
*/
function loadAll(id, hide){
	loadList();
	loadUsecase(id);
	loadUpdate(id);
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
		url: 'cgi-bin/__moduleActorList.php',
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
	MODULO di inserimento nuovo attore
*/
function loadInsert(){
	$("#moduleInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleActorInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
/*
	MODULO di inserimento casi d'uso associati
*/
function loadUsecase(id, hide){
	$("#moduleUsecase").remove();
	$.ajax({
		url: 'cgi-bin/__moduleActorUsecase.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarUsecase").after(data);
			if(hide === undefined) $("#moduleUsecase").hide();
		}
	});
}
/*
	MODULO di aggiornamento attore
*/
function loadUpdate(id, hide){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleActorUpdate.php',
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
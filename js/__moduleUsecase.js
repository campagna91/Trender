/*
	funzione inizializzante tutti i moduli
*/
function loadAll(id, hide){
	loadList();
	loadChild(id, hide);
	loadActor(id, hide);
	loadUpdate(id, hide);
	loadRequirement(id, hide);
}
/*
	MODULO inserimento
*/
function loadInsert(){
	$("#moduleInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecaseInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
/*
	MODULO aggiornamento
*/
function loadUpdate(id, hide){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecaseUpdate.php',
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
/*
	MODULO figli
*/
function loadChild(id, hide){
	$("#moduleChild").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecaseChild.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarChild").after(data);
			if(hide === undefined) $("#moduleChild").hide();
		}
	});
}
/*
	MODULO requisiti
*/
function loadRequirement(id, hide){
	$("#moduleRequirement").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecaseRequirement.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarRequirement").after(data);
			if(hide === undefined) $("#moduleRequirement").hide();
		}
	});
}
/*
	MODULO attori
*/
function loadActor(id, hide){
	$("#moduleActor").remove();
	$.ajax({
		url: 'cgi-bin/__moduleUsecaseActor.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarActor").after(data);
			if(hide === undefined) $("#moduleActor").hide();
		}
	});
}
/*
	MODULO mainlist
*/
function loadList(){
	$("#mainList").children().each(function(){
		$(this).remove();
	});
	$.ajax({
		url: 'cgi-bin/__moduleUsecaseList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$(data).appendTo("#mainList");
		}
	});
}

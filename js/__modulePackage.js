/*
	funzione che inizializza tutti i moduli
*/
function loadAll(id, hide){
	loadList();
	loadChild(id);
	loadUpdate(id0);
	loadRequirement(id);
	loadInteraction(id);
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
		url: 'cgi-bin/__modulePackageList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$(data).appendTo("#mainList");
		}
	});
}
/*
	MODULO dei test di integrazione
*/
function loadTest(id, hide){
	$("#moduleTestIntegration").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackageTest.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,
		},
		success:function(data){
			// Brutta cosa a sanamento del fatto che la derivazione del package scassa a jquery, 
			//dunque ciclo e verifico il match completo tra id passato arraizzato e la classe della riga a cui appendere 
			$("#mainList tr").each(function() {
				if($(this).attr('class') == id) {
					$(this).after(data);
				}
			});
		}
	});
}
// ___________________________________________________________________________ SIDEBAR
/*
	MODULO di aggiornamento del package
*/
function loadUpdate(id, hide){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackageUpdate.php',
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
	MODULO figli package
*/
function loadChild(id, hide){
	$("#moduleChild").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackageChild.php',
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
	MODULO requisiti associati
*/
function loadRequirement(id, hide){
	$("#moduleRequirement").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackageRequirement.php',
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
	MODULO interazioni tra package
*/
function loadInteraction(id, hide){
	$("#moduleInteraction").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackageInteraction.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarInteraction").after(data);
			if(hide === undefined) $("#moduleInteraction").hide();
		}
	});
}
/*
	MODULO di inserimento nuovo package
*/
function loadInsert(){
	$("#moduleInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackageInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
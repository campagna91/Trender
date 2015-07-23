/*
	funzione che inizializza tutti i moduli
*/
function loadAll(id, hide){
	loadList();
	loadUpdate(id, hide);
	loadRelation(id, hide);
	loadInteraction(id, hide);
	loadInheritance(id, hide);
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
		url: 'cgi-bin/__moduleClassList.php',
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
	MODULEO inserimento nuova classe
*/
function loadInsert(){
	$("#moduleInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
/*
	MODULO aggiornamento classe 
*/
function loadUpdate(id, hide){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassUpdate.php',
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
	MODULO ereditarietà di classe
*/
function loadInheritance(id, hide){
	$("#moduleInheritance").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassInheritance.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarInheritance").after(data);
			if(hide === undefined) $("#moduleInheritance").hide();
		}
	});
}
/*
	MODULO relazioni con altre classi
*/
function loadRelation(id, hide){
	$("#moduleRelation").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassRelation.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarRelation").after(data);
			if(hide === undefined) $("#moduleRelation").hide();
			$.ajax({
				url: 'cgi-bin/__ajaxClassQuery.php',
				type:'post',
				cache:'false',
				dataType:'html',
				data:{
					'query': 'class relactions',
					'id':id		
				},
				success:function(data){
					$("#sidebarRelation").text("Relazioni (" + data + ")");
				}
			});
		}
	});
}
/*
	MODULO interazioni
*/
function loadInteraction(id, hide){
	$("#moduleInteraction").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassInteraction.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id		
		},
		success:function(data){
			$("#sidebarInteraction").after(data);
			if(hide === undefined) $("#moduleInteraction").hide();
		}
	});
}
/*
	MODULO attributi e methodi
*/
function loadAttributeMethod(id, hide){
	$("#moduleAttributeMethod").remove();
	$.ajax({
		url: 'cgi-bin/__moduleClassAttributeMethod.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id
		},
		success:function(data){
			$("#sidebarAttributeMethod").after(data);
			if(hide === undefined) $("#moduleAttributeMethod").hide();
		}
	});
}
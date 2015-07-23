/*
	funzione che carica tutti i moduli
*/
function loadAll(id, hide){
	loadList();
	loadChild(id, hide);
	loadVerbal(id, hide);
	loadUpdate(id, hide);
	loadUsecase(id, hide);
	loadPackage(id, hide);
	loadClass(id, hide);
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
		url: 'cgi-bin/__moduleRequirementList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$(data).appendTo("#mainList");
		}
	});
}
/*
	MODULO per l'inserimento dei test di validazione e sistema
*/
function loadTest(id, hide){
	$("#moduleTestSystem").remove();
	$("#moduleTestValidation").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementTest.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,
		},
		success:function(data){
			$("tr[class='"+id+"']").after(data);
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
		url: 'cgi-bin/__moduleRequirementInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
/*
	MODULEO per l'aggiornamento del requisito
*/
function loadUpdate(id, hide){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementUpdate.php',
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
	MODULO dei requisiti figli
*/
function loadChild(id, hide){
	$("#moduleChild").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementChild.php',
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
	MODULO casi d'uso associati
*/
function loadUsecase(id, hide){
	$("#moduleUsecase").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementUsecase.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id			
		},
		success:function(data){
			$("#sidebarUsecase").after(data);
			if(hide === undefined) $("#moduleUsecase").hide();
		}
	});
}
/*
	MODULO verbali associati
*/
function loadVerbal(id, hide){
	$("#moduleVerbal").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementVerbal.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarVerbal").after(data);
			if(hide === undefined) $("#moduleVerbal").hide();
		}
	});
}
/*
	MODULO package associati
*/
function loadPackage(id, hide) {
	$("#modulePackage").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementPackage.php',
		type: 'post',
		cache: 'false',
		dataType: 'html',
		data:{
			'id': id,		
		},
		success: function(data) {
			$("#sidebarPackage").after(data);
			if(hide === undefined) $("#modulePackage").hide();
			$.ajax({
				url: 'cgi-bin/__ajaxRequirementQuery.php',
				type:'post',
				cache:'false',
				dataType:'html',
				data:{
					query: "package required",
					id: id
				},
				success:function(data){
					$("#sidebarPackage").text("Package associati ( "+data+" )");
				}
			});
		}
	});
}
/*
	MODULO classi associate
*/
function loadClass(id, hide){
	$("#moduleClass").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementClass.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id			
		},
		success:function(data){
			$("#sidebarClass").after(data);
			if(hide === undefined) $("#moduleClass").hide();
		}
	});
}
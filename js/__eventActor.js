/*
	DIPENDENZE moduli
*/
$(document).ready(function(){
	$.ajax({
    	url: 'js/__moduleActor.js',
    	dataType: 'script',
    	success: function(){
    		loadInsert();
    	}
  	});
});
// ___________________________________________________________________________ MAINLIST
/*
	LOAD della sidebar associata all'attore
*/
$(document).on("click","#mainList tr td[class!='typeCommand']",function(){
	var id = $(this).parent().attr('class');
	$("#menuActions span").text(id);
	$("#moduleInsertion").hide();
	loadUpdate(id);
	loadUsecase(id);
});
/*
	ELIMINA un attore
*/
$(document).on("click",".mainListDelete",function(){
	var data = [
		$(this).parent().parent().attr('class')
	];
	sent('actor','delete',data);
});
// ___________________________________________________________________________ SIDEBAR
/*
	INSERIMENTO di un nuovo attore
*/
$(document).on("click","#moduleInsertionInsert",function(){
	var data = [
		$("#moduleInsertionName").val()
		];
		sent('actor','insert',data);
});
/*
	AGGIORNAMENTO di un attore
*/
$(document).on("click","#moduleUpdateUpdate",function(){
	var data = [
		$("#moduleUpdateName").val(),
		$("#moduleUpdateId").text()
		];
		sent('actor','update',data);
});
/*
	INSERIMENTO di un caso d'uso associato
*/
$(document).on("click","#moduleUsecaseInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleUsecaseAssociated").val()
		];
		sent('actor','usecaseInsert',data);
});
/*
	ELIMINAZIONE di un caso d'uso associato
*/
$(document).on("click",".moduleActorDelete",function(){
	if(confirm("sicuro di fare quel che stai per fare?!"))
	{
		var data = [
			$("#moduleUpdateId").text(),
			$(this).parent().parent().attr('class')
			];
			sent('actor','usecaseDelete',data);
	}
});
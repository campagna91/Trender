/*
	DIPENDENZE moduli
*/
$(document).ready(function(){
	$.ajax({
    	url: 'js/__moduleUsecase.js',
    	dataType: 'script',
    	success: function(){
    		loadInsert();
    	}
  	});
});
// ___________________________________________________________________________ MAINLIST
/*
	LOAD della sidebar contestuale 
*/
$(document).on("dblclick","#mainList tr td[class!='typeCommand']",function(){
	var id = $(this).parent().attr('class');
	$("#menuActions span").text(id);
	$("#moduleInsertion").hide();
	loadUpdate(id);
	loadChild(id);
	loadRequirement(id);
	loadActor(id);
});
/*
	SCEGLIE come padre il selezionato
*/
$(document).on("click", ".mainListChoose", function() {
	var id = $(this).parent().parent().attr('class');
	console.log("find for "+id);
	$("#moduleInsertionDad option").each(function(){
		if($(this).val() == id) 
			$(this).prop('selected',true);
	});
	$("#moduleInsertion").show();
	$("#sidebar div[id!='moduleInsertion']").each(function(){
		$(this).hide();
	});
});
// ___________________________________________________________________________ SIDEBAR
/*
	SWITCH estensione / inclusione nell'inserimento di un nuovo caso d'uso
*/
$(document).on("click","#moduleInsertionSwitchExtensionInclusion",function(){
	if($(this).val() == 'none')
	{
		$(this).val('inclusion');
		$(this).text('INCLUSIONE');
		$(this).removeClass('typeExtension typeNone').addClass('typeInclusion');
	} else {
		if($(this).val() == 'inclusion')
		{
			$(this).val('extension');
			$(this).text('ESTENSIONE');
			$(this).removeClass('typeInclusion typeNone').addClass('typeExtension');
		} else {
			$(this).val('none');
			$(this).text('NESSUNA RELAZIONE');
			$(this).removeClass('typeExtension typeInclusion').addClass('typeNone');
		}
	} 
});
/*
	SWITCH erede / non erede nell'inserimento di un caso d'uso
*/
$(document).on("click","#moduleInsertionSwitchEredeNonerede",function(){
	if($(this).val() == 'heir')
	{
		$(this).val('notHeir');
		$(this).text('NON EREDE');
		$(this).removeClass('typeHeir').addClass('typeNotHeir');
	} else {
		$(this).val('heir');
		$(this).text('EREDE');
		$(this).removeClass('typeNotHeir').addClass('typeHeir');
	}
});
/*
	SWITCH estensione / inclusione nell'aggiornamento di un nuovo caso d'uso
*/
$(document).on("click","#moduleUpdateSwitchExtensionInclusion",function(){
	// incl ext none
	if($(this).val() == 'none')
	{
		$(this).val('inclusion');
		$(this).text('INCLUSIONE');
		$(this).removeClass('typeExtension typeNone').addClass('typeInclusion');
	} else {
		if($(this).val() == 'inclusion')
		{
			$(this).val('extension');
			$(this).text('ESTENSIONE');
			$(this).removeClass('typeInclusion typeNone').addClass('typeExtension');
		} else {
			$(this).val('none');
			$(this).text('NESSUNA RELAZIONE');
			$(this).removeClass('typeExtension typeInclusion').addClass('typeNone');
		}
	} 
});
/*
	SWITCH erede / non erede nella aggiornamento di un caso d'uso selezionato
*/
$(document).on("click","#moduleUpdateSwitchEredeNonerede",function(){
	if($(this).val() == 'heir')
	{
		$(this).val('notHeir');
		$(this).text('NON EREDE');
		$(this).removeClass('typeHeir').addClass('typeNotHeir');
	} else {
		$(this).val('heir');
		$(this).text('EREDE');
		$(this).removeClass('typeNotHeir').addClass('typeHeir');
	}
});
/*
	ELIMINAZIONE del caso d'uso selezionato
*/
$(document).on("click",".mainListDelete",function(){
	if(confirm("sicuro di voler arare?")) 
	{
		var data = [
			$(this).parent().parent().attr('class')
		];
		sent('usecase','delete',data);
	}
});
/*
	INSERIMENTO di un nuovo caso d'uso
*/
$(document).on("click","#moduleInsertionInsert",function(){
	var data = [
		$("#moduleInsertionDad").val(),
		$("#moduleInsertionSwitchExtensionInclusion").val(),
		$("#moduleInsertionSwitchEredeNonerede").val(),
		$("#moduleInsertionTitle").val(),
		$("#moduleInsertionDescription").val(),
		$("#moduleInsertionPrecondition").val(),
		$("#moduleInsertionPostcondition").val(),
		$("#moduleInsertionDidascalia").val(),
		$("#moduleInsertionScenario").val(),
		$("#moduleInsertionAlternativeScenario").val(),
		$("#moduleInsertionPath").val()
	];
	sent('usecase','insert',data);
});
/*
	AGGIORNAMNTO di un caso d'uso
*/
$(document).on("click","#moduleUpdateUpdate",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleUpdateSwitchExtensionInclusion").val(),
		$("#moduleUpdateSwitchEredeNonerede").val(),
		$("#moduleUpdateTitle").val(),
		$("#moduleUpdateDescription").val(),
		$("#moduleUpdatePrecondition").val(),
		$("#moduleUpdatePostcondition").val(),
		$("#moduleUpdateDidascalia").val(),
		$("#moduleUpdateScenario").val(),
		$("#moduleUpdateAlternativeScenario").val(),
		$("#moduleUpdatePath").val()
	];
	sent('usecase','update',data);
});
/*
	INSERIMNETO di un attore associato
*/
$(document).on("click","#moduleActorInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleActorAssociated").val()
		];
	sent('usecase','actorInsert',data);
});
/*
	ELIMINAZIONE di un attore associato
*/
$(document).on("click",".moduleActorDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('usecase','actorDelete',data);
});
/*
	INSERIMENTO di un requisito associato
*/
$(document).on("click","#moduleRequirementInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleRequirementAssociated").val()
		];
	sent('usecase','requirementInsert',data);
});	
/*
	ELIMINAZIONE di un requisito associato
*/
$(document).on("click",".moduleRequirementDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('usecase','requirementDelete',data);
});
/*
	ELIMINAZIONE di un caso d'uso figlio
*/
$(document).on("click",".moduleChildDelete",function(){
	var data = [
		$(this).parent().parent().attr('class')
		];
	sent('usecase','childDelete',data);
});

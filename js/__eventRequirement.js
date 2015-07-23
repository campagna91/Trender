/*
	DIPENDENZE moduli
*/
$(document).ready(function(){
	$.ajax({
    	url: 'js/__moduleRequirement.js',
    	dataType: 'script',
    	success: function(){
    		loadInsert();
    	}
  	});
});
// ___________________________________________________________________________ MAINLIST
/*
	LOAD dei menu contestuali al requisito selezioanto
*/
$(document).on("click","#mainList tr td[class!='typeCommand']",function(){
	if($(this).attr('class') != 'typeTest'){
		var id = $(this).parent().attr('class');
		$("#menuActions span").text(id);
		$("#moduleInsertion").hide();
		loadUpdate(id);
		loadChild(id);
		loadUsecase(id);
		loadVerbal(id);
		loadPackage(id);
		loadClass(id);
	}
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
/*
	ELIMINAZIONE requisito selezionato
*/
$(document).on("click",".mainListDelete",function(){
	if(confirm("sicuro di voler arare?")) 
	{
		var data = [
			$(this).parent().parent().attr('class')
		];
		sent('requirement','delete',data);
	}
});
/*
	VIEW per il form di inserimento dei test di validazione / sistema 
*/
$(document).on("click",".mainListTest",function(){
	var next = $(this).parent().parent().next().attr('id');
	if(next == 'moduleTestSystem' || next == 'moduleTestValidation')
	{
		$("#moduleTestSystem").remove();
		$("#moduleTestValidation").remove();
	} else loadTest($(this).parent().parent().attr('class'));
});
$(document).on("click",".moduleTestInsert",function(){
	loadTestInsert($(this).parent().parent().attr('class'))
});
/*
	INSERIMENTO di un nuovo test di sistema 
*/
$(document).on("click","#moduleTestSystemInsert",function(){
	var data = [
		$("#moduleTestId").text(),
		$("#moduleTestSystemDescription").val(),
		$("#moduleTestSystemSwitchImplemetedNotImplemented").val()
		];
	if($(this).parent().parent().attr('class') != 'new')
		sent('requirement','testSystemUpdate',data);
	else
		sent('requirement','testSystemInsert',data);
	$("#moduleTestSystem").remove();
});
/*
	SWITCH per l'implementazione o no del test di sistema
*/
$(document).on("click","#moduleTestSystemSwitchImplemetedNotImplemented",function(){
	if($(this).val() == 'notSatisfied'){
		$(this).val('satisfied');
		$(this).text('SODDISFATTO');
		$(this).removeClass('typeNotSatisfied');
		$(this).addClass('typeSatisfied');
	} else {
		$(this).val('notSatisfied');
		$(this).text('NON IMPLEMENTATO');
		$(this).removeClass('typeSatisfied');
		$(this).addClass('typeNotSatisfied');
	}
});
/*
	INSERIMENTO di un test di validazione
*/
$(document).on("click","#moduleTestValidationInsert",function(){
	var description; 
	description = $("#moduleTestValidationDescription").val();
	description += '\\begin{enumerate}';
	$(".moduleTestValidationFit").each(function(){
		if($(this).val() != "") description += '\\item '+$(this).val();
	});
	description += '\\end{enumerate}';
	var data = [
		$("#moduleTestId").text(),
		description
		];
	if($(this).parent().parent().attr('class') == 'new') 
		sent('requirement','testValidationInsert',data);
	else 
		sent('requirement','testValidationUpdate',data);
	$("#moduleTestValidation").remove();
});
/*
	INSERIMENTO di un nuovo passo per i test di validazione 
*/
$(document).on("click",".moduleTestAddFit",function(){
	if($(this).next().attr('class').split(" ")[0] == "moduleTestDeleteFit")
		$(this).next().after($("<textarea class='moduleTestValidationFit'></textarea><button class='moduleTestAddFit actionInsert'>+</button><button class='moduleTestDeleteFit actionDelete'>-</button>"));	
	else 
		$(this).after($("<textarea class='moduleTestValidationFit'></textarea><button class='moduleTestAddFit actionInsert'>+</button><button class='moduleTestDeleteFit actionDelete'>-</button>"));	
});
/*
	ELIMINAZIONE di un passo del test di validazione 
*/
$(document).on("click",".moduleTestDeleteFit",function(){
	$(this).prev().prev().remove();
	$(this).prev().remove();
	$(this).remove();
});
// ___________________________________________________________________________ SIDEBAR
/*
	INSERIMENTO di un nuovo requisito
*/
$(document).on("click","#moduleInsertionInsert",function(){
	var data = [
		$("#moduleInsertionDad").val(),
		$("#moduleInsertionImportance").val(),
		$("#moduleInsertionType").val(),
		$("#moduleInsertionDescription").val(),
		$("#moduleInsertionSwitchInsideOutsideChapter").val()
		];
	sent('requirement','insert',data);
});
/*
	SWITCH tipo requisito capitolato / interno / esterno
*/
$(document).on("click","#moduleInsertionSwitchInsideOutsideChapter",function(){
	if($(this).val() == 'inside') 
	{
		$(this).val('outside');
		$(this).text('ESTERNO');
		$(this).removeClass('typeInside').addClass('typeOutside');
	} else if($(this).val() == 'outside')
	{
		$(this).val('chapter');
		$(this).text('CAPITOLATO');
		$(this).removeClass('typeOutside').addClass('typeChapter');
	} else {
		$(this).val('inside');
		$(this).text('INTERNO');
		$(this).removeClass('typeChapter').addClass('typeInside');
	}
});
/*
	AGGIORNAMENTO di un requisito selezionato
*/
$(document).on("click","#moduleUpdateUpdate",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleUpdateDescription").val(),
		$("#moduleUpdateSwitchInsideOutsideChapter").val(),
		$("#moduleUpdateSatisfied").val()
	];
	sent('requirement','update',data);
});
/*
	SWICTH aggiornamento tipo requisito capitolato / interno / esterno
*/
$(document).on("click","#moduleUpdateSwitchInsideOutsideChapter",function(){
	if($(this).val() == 'inside') 
	{
		$(this).val('outside');
		$(this).text('ESTERNO');
		$(this).removeClass('typeInside').addClass('typeOutside');
	} else if($(this).val() == 'outside')
	{
		$(this).val('chapter');
		$(this).text('CAPITOLATO');
		$(this).removeClass('typeOutside').addClass('typeChapter');
	} else {
		$(this).val('inside');
		$(this).text('INTERNO');
		$(this).removeClass('typeChapter').addClass('typeInside');
	}
});
/*
	SWITCH aggiornamento stato requisito soddisfatto / non-soddisfatto
*/
$(document).on("click","#moduleUpdateSatisfied",function(){
	if($(this).val() == 'satisfied') 
	{
		$(this).val('notsatisfied');
		$(this).text('NON SODDISFATTO');
		$(this).removeClass('typeSatisfied').addClass('typeNotsatisfied');
	} else {
		$(this).val('satisfied');
		$(this).text('SODDISFATTO');
		$(this).removeClass('typeNotsatisfied').addClass('typeSatisfied');
	}
});
/*
	INSERIMENTO caso d'uso associato
*/
$(document).on("click","#moduleUsecaseInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleUsecaseAssociated").val()
	];
	sent('requirement','usecaseInsert',data);
});
/*
	ELIMINAZIONE caso d'uso associato
*/
$(document).on("click",".moduleUsecaseDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('requirement','usecaseDelete',data);
});
/*
	INSERIMENTO di un verbale associato
*/
$(document).on("click","#moduleVerbalInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleVerbalName").val()
	];
	sent('requirement','verbalInsert',data);
	loadVerbal(data[0]);
});
/*
	ELIMINAZIONE di un verbale associato
*/
$(document).on("click",".moduleVerbalDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
		];
	sent('requirement','verbalDelete',data);
});
/*
	INSERIMENTO di un nuovo package associato
*/
$(document).on("click", "#modulePackageInsert", function() {
	var data = [
		$("#moduleUpdateId").text(),
		$("#modulePackageAssociated").val()
		];
	sent('requirement', 'packageInsert', data);
});
/*
	ELIMINAZIONE di un package associato
*/
$(document).on("click", ".modulePackageDelete", function() {
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
		];
	sent('requirement', 'packageDelete', data);
});
/*
	INSERIMENTO di una classe associata
*/
$(document).on("click", "#moduleClassInsert", function() {
	if($("#moduleClassName").val() != '')
	{
		var data = [
			$("#moduleUpdateId").text(),
			$("#moduleClassName").val(),
			$("#moduleClassName").find(':selected').attr('class')
		];
		sent('requirement', 'classInsert', data);
	}
});
/*
	ELIMINAZIONE di una classe associata
*/
$(document).on("click", ".moduleClassDelete", function() {
	var data = [
		$("#moduleUpdateId").text(),
		$(this).next().text(),
		$(this).next().attr('class')
	];
	sent('requirement', 'classDelete', data);
});
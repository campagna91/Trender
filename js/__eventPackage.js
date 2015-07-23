/*
	DIPENDENZE moduli
*/
$(document).ready(function(){
	$.ajax({
    	url: 'js/__modulePackage.js',
    	dataType: 'script',
    	success: function(){
    		loadInsert();
    	}
  	});
});
// ___________________________________________________________________________ MAINLIST
/*
	LOAD della sidebar associata al package
*/
$(document).on("click","#mainList tr td[class!='typeCommand']",function(){
	var id = $(this).parent().attr('class');
	$("#menuActions span").text(id);
	$("#moduleInsertion").hide();
	loadUpdate(id);
	loadChild(id);
	loadRequirement(id);
	loadInteraction(id);
});
 /*
	ELIMINA un pacakge
*/
$(document).on("click",".mainListDelete",function(){
	if(confirm("sicuro di voler arare?")) 
	{
		var data = [
			$(this).parent().parent().attr('class')
			];
		sent('package','delete',data);
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
	INSERISCE un test di integrazione
*/
$(document).on("click","#moduleTestIntegrationInsert",function(){
	var data = [
		$("#moduleTestId").text(),
		$("#moduleTestIntegrationDescription").val(),
		$("#moduleTestIntegrationSwitchImplemetedNotImplemented").val()
		];
	if($(this).parent().parent().attr('class') == 'new')
		sent('package','testIntegrationInsert',data);
	else 
		sent('package','testIntegrationUpdate',data);
});
// ___________________________________________________________________________ SIDEBAR
/*
	INSERISCE un nuovo package 
*/
$(document).on("click","#moduleInsertionInsert",function(){
	var newTitolo; 
	if($("#moduleInsertionDad").val() != 'Nessuno' )
		newTitolo = $("#moduleInsertionDad").val()+"::"+$("#moduleInsertionName").val();
	else 
		newTitolo = $("#moduleInsertionName").val();
	var data = [
		newTitolo,
		$("#moduleInsertionDad").val(),
		$("#moduleInsertionImage").val(),
		$("#moduleInsertionDescription").val()
	];
	sent('package','insert',data);
});
/*
	AGGIORNA un package selezionato
*/
$(document).on("click","#moduleUpdateUpdate",function(){
	var name = $("#moduleUpdateId").text().split("::");
	name[name.length -1] = $("#moduleUpdateName").val();
	name = name.join("::");
	var data = [
		name,
		$("#moduleUpdateId").text(),
		$("#moduleUpdatePath").val(),
		$("#moduleUpdateDescription").val()
	];
	sent('package','update',data);
});
/*
	INSERISCE un nuovo requisito associato
*/
$(document).on("click","#moduleRequirementInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleRequirementAssociated").val()
	];
	sent('package','requirementInsert',data);
});
/*
	ELIMINA un requisito associato 
*/
$(document).on("click",".moduleRequirementDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('package','requirementDelete',data);
});
/*
	INSERISCE un'interazione con un altro package
*/
$(document).on("click","#moduleInteractionInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleInteractionPackage").val(),
		$("#moduleInteractionDescription").val()
	];
	sent('package','interactionInsert',data);
});
/*
	ELIMINA un'interazione con un package
*/
$(document).on("click",".moduleInteractionDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('package','interactionDelete',data);
});
/*
	AGGIORNA un'interazione del package
*/
$(document).on("click",".moduleInteractionUpdate",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class'),
		$(this).parent().prev().children("textarea").val()
	];
	sent('package','interactionUpdate',data);
});
/*
	VIEW per il form di inserimento dei test di integrazione
*/
$(document).on("click",".mainListTest",function(){
	loadTest($(this).parent().parent().attr('class'));
});
$(document).on("click","#moduleTestIntegrationSwitchImplemetedNotImplemented",function(){
	if($(this).val() == 'satisfied'){
		$(this).val('notSatisfied');
		$(this).text('NON IMPLEMENTATO');
		$(this).removeClass('typeSatisfied');
		$(this).addClass('typeNotSatisfied');
	} else {
		$(this).val('satisfied');
		$(this).text('IMPLEMENTATO');
		$(this).removeClass('typeNotSatisfied');
		$(this).addClass('typeSatisfied');
	}
});
/*
	DIPENDENZE moduli
*/
$(document).ready(function(){
	$.ajax({
    	url: 'js/__moduleClass.js',
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
$(document).on("click","#mainList tr td[class!='typeCommand']",function(){
	var id = $(this).parent().attr('class');
	$("#menuActions span").text(id);
	$("#moduleInsertion").hide();
	loadUpdate(id);
	loadInheritance(id);
	loadRelation(id);
	loadInteraction(id);
	loadAttributeMethod(id);
});
/*
	ELIMINAZIONE di una classe
*/
$(document).on("click",".mainListDelete",function(){
	if(confirm("sicuro di voler arare?")) 
	{
		var data = [
			$(this).parent().parent().attr('class')
		];
		sent('class','delete',data);
	}
});
// ___________________________________________________________________________ SIDEBAR
/*
	SWITCH relazione entrante / uscente
*/
$(document).on("click","#moduleRelationSwitchEnteringOutgoing",function(){
	if($(this).val() == 'entering'){
		$(this).val('outgoing');
		$(this).text('USCENTE');
	} else {
		$(this).val('entering')
		$(this).text('ENTRANTE')
	}
});
/*
	SWITCH relazione associazione / associazione navigabile / aggregazione / composizione / dipendenza / generalizzazione / realizzazione
*/
$(document).on("click","#moduleRelationSwitchType",function(){
	switch($(this).val()) 
	{
		case('association'): $(this).val('navigable-association'); $(this).text('ASSOCIAZIONE NAVIGABILE'); break;
		case('navigable-association'): $(this).val('aggregation'); $(this).text('AGGREGAZIONE'); break;
		case('aggregation'): $(this).val('composition'); $(this).text('COMPOSIZIONE'); break;
		case('composition'): $(this).val('dependency'); $(this).text('DIPENDENZA'); break;
		case('dependency'): $(this).val('realization'); $(this).text('REALIZZAZIONE'); break;
		case('realization'): $(this).val('association'); $(this).text('ASSOCIAZIONE'); break;
	}
});
/*
	INSERIMENTO di una nuova classe
*/
$(document).on("click","#moduleInsertionInsert",function(){
	var data =[
		$("#moduleInsertionName").val(),
		$("#moduleInsertionDescription").val(),
		$("#moduleInsertionUse").val(),
		$("#moduleInsertionPackage").val()
	];
	sent('class','insert',data);
});
/*
	AGGIORNAMENTO della classe selezionata
*/
$(document).on("click","#moduleUpdateUpdate",function(){
	var data =[
		$("#moduleUpdateId").text(),
		$("#moduleUpdateName").val(),
		$("#moduleUpdateDescription").val(),
		$("#moduleUpdateUse").val(),
		$("#moduleUpdatePackage").val()
	];
	sent('class','update',data);
});
/*
	INSERIMENTO classe base
*/
$(document).on("click","#moduleInheritanceInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleInheritanceExtended").val()
	];
	sent('class','inheritanceInsert',data);
});
/*
	ELIMINAZIONE di una classe base
*/
$(document).on("click",".moduleInheritanceDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('class','inheritanceDelete',data);
});
/*
	INSERIMENTO di una relazione con un altra classe
*/
$(document).on("click","#moduleRelationInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleRelationAssociated").val(),
		$("#moduleRelationSwitchEnteringOutgoing").val(),
		$("#moduleRelationSwitchType").val()
		];
	sent('class','relationInsert',data);
});
/*
	SWICTH relazione entrante / uscente nella modifica di una relazione
*/
$(document).on("click",".moduleRelationSwitchEnteringOutgoing",function(){
	if($(this).val() == 'entering'){
		$(this).val('outgoing');
		$(this).text('USCENTE');
	} else {
		$(this).val('entering');
		$(this).text('ENTRANTE');
	}
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class'),
		$(this).val()
		];
	sent('class','relationUpdate',data);
});
/*
	SWITCH tipo di relazione associazion / ass. navigabile / ... 
*/
$(document).on("click",".moduleRelationSwitchType",function(){
	switch($(this).val()) 
	{
		case('navigable-association'): $(this).text('AGGREGAZIONE'); $(this).val('aggregation'); break;
		case('aggregation'): $(this).text('COMPOSIZIONE'); $(this).val('composition'); break;
		case('composition'): $(this).text('DIPENDENZA'); $(this).val('dependency'); break;
		case('dependency'): $(this).text('REALIZZAZIONE'); $(this).val('relization'); break;
		case('relization'): $(this).text('ASSOCIAZIONE'); $(this).val('association'); break;
		case('association'): $(this).text('ASSOCIAZIONE NAVIGABILE'); $(this).val('navigable-association'); break;
	}
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().prev().prev().text(),
		$(this).parent().prev().children('button').val(),
		$(this).val()
		];
	sent('class','relationUpdateType',data);
});
/*
	ELIMINAZIONE di una relazione con una classe
*/
$(document).on("click",".moduleRelationDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
		];
	sent('class','relationDelete',data);
});
/*
	INSERIMENTO di un'interazione con una classe
*/
$(document).on("click","#moduleInteractionInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleInteractionClass").val(),
		$("#moduleInteractionDescription").val()
	];
	sent('class','interactionInsert',data);
});
/*
	ELIMINAZIONE di un'interazione con una classe
*/
$(document).on("click",".moduleInteractionDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('class','interactionDelete',data);
});
/*
	AGGIORNAMENTO di un'interazione con una classe
*/
$(document).on("click",".moduleInteractionUpdate",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class'),
		$(this).parent().prev().children('.moduleInteractionDescription').val()
		];
	sent('class','interactionUpdate',data);
});
/*
	INSERIMENTO di un'attributo
*/
$(document).on("click", "#moduleAttributeMethodInsertAttribute", function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleAttributeMethodNewAttribute").val(),
		$("#moduleAttributeMethodTypeAttribute").val(),
		$("#moduleAttributeMethodDescriptionAttribute").val()
	];
	sent('class','attributeInsert', data);
});
/*
	ELIMINAZIONE di un attributo
*/
$(document).on("click", ".moduleAttributeMethodDeleteAttribute", function() {
	var data = [
		$("#moduleUpdateId").text(),
		$(this).prev().text().split(" : ")[0]
	];
	sent('class','attributeDelete', data);
});
/*
	AGGIORNAMENTO di un attributo
*/
$(document).on("click",".moduleAttributeMethodUpdateAttribute", function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).prev().prev().text().split(" : ")[0],
		$(this).next().val()
	];
	sent('class','attributeUpdate',data);
});
/*
	INSERIMENTO di un nuovo parametro
*/
$(document).on("click", "#moduleAttributeMethodAddParam", function() {
	var typeSelect = $("#moduleAttributeMethodReturnType").clone();
	typeSelect.attr('class','paramNew');
	$("#moduleAttributeMethodListNewParams").append("<input type='text' class='paramNew' placeholder='param name'/>");
	$("#moduleAttributeMethodListNewParams").append(typeSelect);
	$("#moduleAttributeMethodListNewParams").append("<textarea class='paramNew' placeholder='description of param'></textarea>");
});
/*
	INSERIMENTO di un metodo
*/
$(document).on("click","#moduleAttributeMethodInsertMethod", function() {
	var params = '';
	$("#moduleAttributeMethodListNewParams > *").each(function(){
			if($(this).prop('tagName') == 'INPUT' || $(this).prop('tagName') == 'SELECT') params += $(this).val() + ":";
			if($(this).prop('tagName') == 'TEXTAREA') params += $(this).val() + ";";
	});
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleAttributeMethodNameMethod").val(),
		$("#moduleAttributeMethodReturnType").val(),
		$("#moduleAttributeMethodDescriptionMethod").val(),
		params
	];
	sent('class','methodInsert',data);
});
/*
	ELIMINAZIONE di un metodo
*/
$(document).on("click",".moduleAttributeMethodDeleteMethod", function() {
	var data = [
		$("#moduleUpdateId").text(),
		$(this).next().next().next().text()
	];
	sent('class','methodDelete',data);
});
/*
	AGGIORNAMENTO di un metodo
*/
$(document).on("click",".moduleAttributeMethodUpdateMethod", function() {
	var params = '';
	$(this).parent().find('li').each(function(){
		params += $(this).find('input.nameParam').val() + ':' 
						+ $(this).find('select.type').val() + ':'
						+	$(this).find('input.description').val() + ';';
	});
	var data = [
		$("#moduleUpdateId").text(),
		$(this).next().next().next().val(),
		$(this).parent().find('textarea.description').val(),
		$(this).parent().attr('class'),
		params
	];
	sent('class','methodUpdate',data);
});
/*
	INSERIMENTO di un nuovo parametro
*/
$(document).on("click", ".moduleAttributeMethodAddParamToMethod", function() {
	var params = $(this).parent().find('li')[0]; 
	var newParam = $(params).clone();
	newParam.find('.description').val('').attr('placeholder','descrizione del nuovo parametro');
	newParam.find('.nameParam').val('').attr('placeholder','nome nuovo parametro');
	newParam.find('.type option').first().prop('selected',true);
	$(this).parent().find('li').last().append(newParam);
});
/*
	ELIMINAZIONE di un parametro
*/
$(document).on("click", ".moduleAttributeMethodDeleteParam", function() {
	$(this).parent().remove();
});
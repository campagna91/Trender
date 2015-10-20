// /*
// 	DIPENDENZE moduli
// */
// $(document).ready(function(){
// 	$.ajax({
//     	url: 'js/__moduleUnitTest.js',
//     	dataType: 'script',
//     	success: function(){
//     		loadInsert();
//     	}
//   	});
// });
// // ___________________________________________________________________________ MAINLIST
// /*
// 	LOAD della sidebar contestuale 
// */
// $(document).on("click","#mainList tr td[class!='typeCommand']",function(){
// 	var id = $(this).parent().attr('class');
// 	$("#menuActions span").text(id);
// 	$("#moduleInsertion").hide();
// 	loadUpdate(id);
// });
// /*
// 	SWITCH stato implementazione del test di unità
// */
// $(document).on("click", ".moduleUpdateSwitchImplementedNotImplemented", function() {
// 	if($(this).attr('class').split(" ")[1] == 'typeSatisfied') 
// 		$(this).removeClass('typeSatisfied').addClass('typeNotsatisfied');
// 	else
// 		$(this).removeClass('typeNotsatisfied').addClass('typeSatisfied');

// 	var data = [
// 		$(this).parent().parent().attr('class'),
// 		$(this).attr('class').split(" ")[1]
// 	];
// 	sent('unitTest', 'changeImplementedState', data);
// });
// /*
// 	ELIMINAZIONE di un test d'unità
// */
// $(document).on("click", ".mainListDelete", function() {
// 	var data = [
// 		$(this).parent().parent().attr('class')
// 	];
// 	sent('unitTest','delete',data);
// });
// // ___________________________________________________________________________ SIDEBAR
// /*
// 	INSERIMENTO di un nuovo test
// */
// $(document).on("click", "#moduleInsertionInsert", function() {
// 	var data = [
// 		$("#moduleInsertionDescription").val()
// 	];
// 	sent('unitTest','insert', data);
// });
// /*
// 	SELEZIONE metodo della classe
// */
// $(document).on("change", "#moduleUpdateClass", function(){
// 	$.ajax({
// 		url: 'cgi-bin/__moduleUnitTestMethodByClass.php',
// 		type:'post',
// 		cache:'false',
// 		dataType:'html',
// 		data:{
// 			'id': $("#moduleUpdateId").text(),
// 			'class': $("#moduleUpdateClass").val()
// 		},
// 		success:function(data){
// 			$("#moduleUpdateMethod").append(data);
// 		}
// 	});
// });
// /*
// 	ELIMINAZIONE di una relazione
// */
// $(document).on("click", ".moduleUpdateRaltionDelete", function() {
// 	$(this).parent().remove();
// });
// /*
// 	AGGIORNAMENTO di una relazione
// */
// $(document).on("click", "#moduleUpdateUpdate", function() {
// 	var relations = '';
// 	$("#moduleUpdate ul li").each(function(){
// 		relations += $(this).find('span').text() + ";";
// 	});
// 	var data = [
// 		$("#moduleUpdateId").text(),
// 		$("#moduleUpdateDescription").val(),
// 		relations
// 	];
// 	sent('unitTest', 'update', data);
// });
// /*
// 	INSERIMENTO 
// */
// $(document).on("click", "#moduleUpdateAddRelation", function() {
// 	if($("#moduleUpdateMethod").val() !== null)
// 	{
// 		var selected = $("#moduleUpdateMethod").val();
// 		$("#moduleUpdateList").append("<li><button class='moduleUpdateRaltionDelete actionDelete'>Elimina</button><span>"+ $("#moduleUpdateClass").val() + "." + $("#moduleUpdateMethod").val() +"</span></li>");
// 		$("#moduleUpdateMethod option").each(function(){ 
			
// 			if($(this).val() === selected) 
// 			{
// 				$(this).remove();
// 				return;
// 			}
// 		});
// 	}
// });
$(document).ready(function(){
	$.ajax({
    	url: 'js/__moduleVerbal.js',
    	dataType: 'script',
    	success: function(){
    		loadInsert();
    	}
  	});
});
$(document).on("click","#mainList tr td[class!='typeCommand']",function(){
	var id = $(this).parent().attr('class');
	$("#menuActions span").text(id);
	$("#moduleInsertion").hide();
	loadUpdate(id);
	loadUsecase(id);
	loadRequirement(id);
});
$(document).on("click","#moduleInsertionInsert",function(){
	var date = '2015'+'-'+$("#moduleInsertionMonth").val()+"-"+$("#moduleInsertionDay").val();
	var data = [
		date,
		$("#moduleInsertionText").val()
	];
	sent('verbal','insert',data);
});
$(document).on("click","#moduleUpdateUpdate",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleUpdateText").val()
	];
	sent('verbal','update',data);
});
$(document).on("click","#moduleUsecaseInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleUsecaseAssociated").val()
	];
	sent('verbal','usecaseInsert',data);
});
$(document).on("click",".moduleUsecaseDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('verbal','usecaseDelete',data);
});
$(document).on("click","#moduleRequirementInsert",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$("#moduleRequirementAssociated").val()
	];
	sent('verbal','requirementInsert',data);
});
$(document).on("click",".moduleRequirementDelete",function(){
	var data = [
		$("#moduleUpdateId").text(),
		$(this).parent().parent().attr('class')
	];
	sent('verbal','requirementDelete',data);
});
$(document).on("click",".mainListDelete",function(){
	if(confirm("sicuro di voler arare?")) 
	{
		var data = [
			$(this).parent().parent().attr('class')
		];
		sent('verbal','delete',data);
	}
});
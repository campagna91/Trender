function loadAll(id){
	loadList();
	loadUpdate(id);
	loadUsecase(id);
	loadRequirement(id);
}
function loadInsert(){
	$("#moduleInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleVerbalInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$("#sidebarInsertion").after(data);
		}
	});
}
function loadUsecase(id){
	$("#moduleUsecase").remove();
	$.ajax({
		url: 'cgi-bin/__moduleVerbalUsecase.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarUsecase").after(data);
			$("#moduleUsecase").hide();
		}
	});
}
function loadRequirement(id){
	$("#moduleRequirement").remove();
	$.ajax({
		url: 'cgi-bin/__moduleVerbalRequirement.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			'id':id,				
		},
		success:function(data){
			$("#sidebarRequirement").after(data);
			$("#moduleRequirement").hide();
		}
	});
}
function loadUpdate(id){
	$("#moduleUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleVerbalUpdate.php',
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
function loadList(){
	$("#mainList").children().each(function(){
		$(this).remove();
	});
	$.ajax({
		url: 'cgi-bin/__moduleVerbalList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			$(data).appendTo("#mainList");
		}
	});
}
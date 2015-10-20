/*
	Requirement list loader
*/
function loadList() {
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementsList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}
/*
	Requirement insertion loader
*/
function loadInsert() {
	$("#requirementInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementsInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$('select').material_select();
		}
	});
}
/*
	Requirement update loader
*/
function loadUpdate() {
	$("#requirementsUpdate").remove();
	$.ajax({
		url: 'cgi-bin/__moduleRequirementsUpdate.php',
		type:'get',
		cache:'false',
		dataType:'html',
		data: {
			id: $("#id").text()
		},
		success:function(data) {
			$("#requirementsChild").before(data);
			$('select').material_select();
		}
	});
}
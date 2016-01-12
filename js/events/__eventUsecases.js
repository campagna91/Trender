/*
	Usecase insertion
*/
$(document).on("click", "#usecaseInsert", function() {
	if(formIsValid('usecasesInsertion')) {
		var data = [
			$("#dad").val(),
			$("#type").val(),
			$("#title").val(),
			$("#description").val(),
			$("#precondition").val(),
			$("#postcondition").val(),
			$("#scene").val(),
			$("#alternativeScene").val(),
			$("#didascalia").val(),
			$("#imagePath").val()
		];
		sent('usecases', 'insert', data);
		$("#usecasesInsertion").closeModal();
	}
});
/*
	Usecase delete
*/
$(document).on("click", "#usecaseDelete", function() {
	console.log('delete request');
	var data = [$("#id").text()];
	sent('usecases', 'delete', data);
});
/*
	Usecases update
*/
$(document).on("click", "#usecaseUpdate", function() {
	if(formIsValid('usecasesUpdate')) {
		var data = [
			$("#id").text(),
			$("#type").val(),
			$("#title").val(),
			$("#description").val(),
			$("#precondition").val(),
			$("#postcondition").val(),
			$("#scene").val(),
			$("#alternativeScene").val(),
			$("#didascalia").val(),
			$("#imagePath").val()
		];
		sent('usecases', 'update', data);
	}
});
/*
	Usecases child delete
*/
$(document).on("click", ".usecaseChildDelete", function() {
	var data = [$(this).parent().parent().attr('id')];
	alert(data);
	sent('usecases', 'childDelete', data);
	$(this).parent().parent().remove();
});
/*
	Usecase actor combine
*/
$(document).on("click", "#usecaseActorCombine", function() {
	if(formIsValid('usecasesActors')) {
		var data = [
			$("#id").text(),
			$("#usecaseActorName").val()
		];
		sent('usecases', 'actorCombine', data);
		$("#usecaseActorName option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#usecaseActorList").append("<tr id='" + data[1] + "'><td><a class='waves-light btn red col s2 usecaseActorDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='actors.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Usecase actor delete
*/
$(document).on("click", ".usecaseActorDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('usecases', 'actorDelete', data);
	$(this).parent().parent().remove();
	$("#usecaseActorName").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});
/*
	Usecase requirement combine
*/
$(document).on("click", "#usecaseRequirementCombine", function() {
	if(formIsValid('usecasesRequirement')) {
		var data = [
			$("#id").text(),
			$("#usecaseRequirement").val()
		];
		sent('usecases', 'requirementCombine', data);
		$("#usecaseRequirement option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#usecaseRequirementList").append("<tr id=" + data[1] + "><td><a class='waves-light btn red col s2 usecaseRequirementDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='requirements.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Usecase requirement delete
*/
$(document).on("click", ".usecaseRequirementDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('usecases', 'requirementDelete', data);
	$(this).parent().parent().remove();
	$("#usecaseRequirement").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});
/*
	Usecase verbal combine
*/
$(document).on("click", "#usecaseVerbalCombine", function() {
	if(formIsValid('usecasesVerbal')) {
		var data = [
			$("#id").text(),
			$("#usecaseVerbal").val()
		];
		sent('usecases', 'verbalCombine', data);
		$("#usecaseVerbal option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#usecaseVerbalList").append("<tr id=" + data[1] + "><td><a class='waves-light btn red col s2 usecaseVerbalDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='verbals.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Usecase verbal delete
*/
$(document).on("click", ".usecaseVerbalDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('usecases', 'verbalDelete', data);
	$(this).parent().parent().remove();
	$("#usecaseVerbal").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});
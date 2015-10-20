/*
	Actor insertion
*/
$(document).on("click", "#actorInsert", function() {
	if(formIsValid('actorsInsertion')) {
		var data = [
			$("#actorName").val(),
			$("#actorNote").val(),
			$("#actorBase").val()
		];
		sent('actors', 'insert', data);
		$('#actorsInsertion').closeModal();
	}
});
/*
	Actor delete
*/
$(document).on("click", "#actorDelete", function() {
	var data = [$("#id").text()];
	sent('actors', 'delete', data);
});
/*
	Actor udpate
*/
$(document).on("click", "#actorUpdate", function() {
	if(formIsValid('actorsUpdate')) {
		var data = [
			$("#id").text(),
			$("#actorName").val(),
			$("#actorNote").val(),
			$("#actorBase").val()
		];
		sent('actors', 'update', data);
	}
});
/*
	Actor derivative delete
*/
$(document).on("click", ".actorDerivativeDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('actors', 'derivativeDelete', data);
	$(this).parent().parent().remove();
});
/*
	Actor usecase combine
*/
$(document).on("click", "#actorUsecaseCombine", function() {
	if(formIsValid('actorsUsecase')) {
		var data = [
			$("#id").text(),
			$("#actorUsecase").val()
		];
		sent('actors', 'usecaseCombine', data);
		$("#actorUsecase option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#actorUsecaseList").append("<tr id='" + data[1] + "'><td><a class='waves-light btn red col s2 actorUsecaseDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='usecases.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Actor usecase delete
*/
$(document).on("click", ".actorUsecaseDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('actors', 'usecaseDelete', data);
	$(this).parent().parent().remove();
	$("#actorUsecase").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});

/*
	Requirement insertion
*/
$(document).on("click", "#requirementInsert", function() {
	if(formIsValid('requirementInsertion')) {
		var data = [
			$('#dad').val(),
			$('#importance').val(),
			$('#type').val(),
			$('#source').val(),
			$('#description').val()
		];
		sent('requirements', 'insert', data);
		$('#requirementInsertion').closeModal();
	}
});
/*
	Requirement delete
*/
$(document).on("click", "#requirementDelete", function() {
	var data = [$("#id").text()];
	sent('requirements', 'delete', data);
});
/*
	Requirement update
*/
$(document).on("click", "#requirementUpdate", function() {
	if(formIsValid('requirementUpdate')) {
		var data = [
			$('#id').text(),
			$('#description').val(),
			$('#importance').val(),
			$('#type').val(),
			$("#source").val(),
			$("#satisfied").val()
		];
		sent('requirements', 'update', data);
	}
});
/*
	Requirement child delete
*/
$(document).on("click", ".requirementChildDelete", function() {
	var data = [$(this).parent().parent().attr('id')];
	sent('requirements', 'childDelete', data);
	$(this).parent().parent().remove();
});
/*
	Requirement class combine
*/
$(document).on("click", "#requirementClassCombine", function() {
	if(formIsValid('requirementClass')) {
		var data = [
			$("#id").text(),
			$("#requirementClassName").val()
		];
		sent('requirements', 'classCombine', data);
		$("#requirementClassName option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#requirementClassList").append("<tr id=" + data[1] + "><td><a class='waves-light btn red col s2 requirementClassDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='classes.php?id='" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Requirement class delete
*/
$(document).on("click", ".requirementClassDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('requirements', 'classDelete', data);
	$(this).parent().parent().remove();
	$("#requirementClassName").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});
/*
	Requirement package combine
*/
$(document).on("click", "#requirementPackageCombine", function() {
	if(formIsValid('requirementPackage')) {
		var data = [
			$("#id").text(),
			$("#requirementPackageName").val()
		];
		sent('requirements', 'packageCombine', data);
		$("#requirementPackageName option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#requirementPackageList").append("<tr id='" + data[1] + "'><td><a class='waves-light btn red col s2 requirementPackageDelete'><i class='material-icons'>delete</i></a><a class='col s7' href='packages.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Requirement package delete
*/
$(document).on("click", ".requirementPackageDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('requirements', 'packageDelete', data);
	$(this).parent().parent().remove();
	$("#requirementPackageName").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});
/*
	Requirement systemTest insert
*/
$(document).on("click", "#requirementSystemTestInsert", function() {
	if(formIsValid('requirementSystemTest')) {
		var data = [
			$("#id").text(),
			$("#systemTestDescription").val(),
			$("#systemTestImplemented").val(),
			$("#systemTestSatisfied").val()
		];
		sent('requirements', 'systemTestInsert', data);
		$("#requirementSystemTestInsert").attr('id', 'requirementSystemTestUpdate').html('UPDATE');
	}
});
/*
	Requirement systemTest udpate
*/
$(document).on("click", "#requirementSystemTestUpdate", function() {
	if(formIsValid('requirementSystemTest')) {
		var data = [
			$("#id").text(),
			$("#systemTestDescription").val(),
			$("#systemTestImplemented").val(),
			$("#systemTestSatisfied").val()
		];
		sent('requirements', 'systemTestUpdate', data);
	}
});
/*
	Requirement usecase combine
*/
$(document).on("click", "#requirementUsecaseCombine", function() {
	if(formIsValid('requirementUsecase')) {
		var data = [
			$("#id").text(),
			$("#requirementUsecaseName").val()
		];
		sent('requirements', 'usecaseCombine', data);
		$("#requirementUsecaseName option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#requirementUsecaseList").append("<tr id=" + data[1] + "><td><a class='waves-light btn red col s2 requirementUsecaseDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='usecases.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});
/*
	Requirement usecase delete
*/
$(document).on("click", ".requirementUsecaseDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('requirements', 'usecaseDelete', data);
	$(this).parent().parent().remove();
	$("#requirementUsecaseName").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});
/*
	Package insertion
*/
$(document).on("click", "#packageInsert", function() {
	if(formIsValid('packagesInsertion')) {
		var data = [
			$('#dad').val(),
			$('#package').val(),
			$('#description').val(),
			$('#imagePath').val(),
			$('#didascalia').val()
		];
		sent('packages', 'insert', data);
		$('#packagesInsertion').closeModal();
	}
});

/*
	Package delete
*/
$(document).on("click", "#packageDelete", function() {
	var data = [$("#id").text()];
	sent('packages', 'delete', data);
});

/*
	Package update
*/
$(document).on("click", "#packageUpdate", function() {
	if(formIsValid('packagesUpdate')) {
		var data = [
			$("#id").text(),
			$("#packageDad").val(),
			$("#packageName").val(),
			$("#packageDescription").val(),
			$("#packageImagePath").val(),
			$("#packageImageDidascalia").val()
		];
		sent('packages', 'update', data);
	}
});

/*
	Package requirement combine
*/
$(document).on("click", "#packageRequirementCombine", function() {
	if(formIsValid('packagesRequirement')) {
		var data = [
			$("#id").text(),
			$("#packageRequirement").val()
		];
		sent('packages', 'requirementCombine', data);
		$("#packageRequirement option[value='" + data[1] + "']").remove();
		$('select').material_select();
		$("#packageRequirementList").append("<tr id='" + data[1] + "'><td><a class='waves-light btn red col s2 packageRequirementDelete'><i class='material-icons'>delete</i></a><a class='col s10' href='requirements.php?id=" + data[1] + "'>" + data[1] + "</a></td></tr>");
	}
});

/*
	Package requirement delete
*/
$(document).on("click", ".packageRequirementDelete", function() {
	var data = [
		$("#id").text(),
		$(this).parent().parent().attr('id')
	];
	sent('packages', 'requirementDelete', data);
	$(this).parent().parent().remove();
	$("#packageRequirement").append("<option value=" + data[1] + ">" + data[1] + "</option>");
	$('select').material_select();
});

/*
	Package child delete
*/
$(document).on("click", ".packageChildDelete", function() {
	var data = [ $(this).parent().parent().attr('id') ];
	sent('packages', 'childDelete', data);
	$(this).parent().parent().remove();
});

/*
	Package integration insert
*/
$(document).on("click", "#packageIntegrationInsert", function() {
	if(formIsValid('packagesIntegration')) {
		var data = [
			$("#id").text(),
			$("#packageIntegrationDescription").val(),
			$("#packageIntegrationImplemented").val(),
			$("#packageIntegrationSatisfied").val()
		];
		sent('packages', 'integrationInsert', data);
		$("#packageIntegrationInsert").text('Update');
	}
});

/*
	Package integration update
*/
$(document).on("click", "#packageIntegrationUpdate", function() {
	if(formIsValid('packagesIntegration')) {
		var data = [
			$("#id").text(),
			$("#packageIntegrationDescription").val(),
			$("#packageIntegrationImplemented").val(),
			$("#packageIntegrationSatisfied").val()
		];
		sent('packages', 'integrationUpdate', data);
	}
});
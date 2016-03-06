/*
	Classes insertion
*/
$(document).on("click", "#glossaryInsert", function() {
	if(formIsValid('glossaryInsertion')) {
		var data = [
			$('#glossaryTermName').val(),
			$('#glossaryTermDescription').val()
		];
		sent('glossary', 'insert', data);
		$('#glossaryTermName').val('');
		$('#glossaryTermDescription').val('');
		$('#glossaryInsertion').closeModal();
	}
});

/*
	Glossary delete
*/
$(document).on("click", "#glossaryDelete", function() {
	var data = [
		$("#id").text()
	];
	sent('glossary', 'delete', data);
});

/*
	Classes update
*/
$(document).on("click", "#glossaryUpdate", function() {
	if(formIsValid('glossaryUpdate')) {
		var data = [
			$("#id").text(),
			$("#name").val(),
			$("#explanation").val()
		];
		sent('glossary', 'update', data);
	}
});
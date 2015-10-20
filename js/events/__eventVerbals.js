/*
	Verbal insertion
*/
$(document).on("click", "#verbalInsert", function() {
	if(formIsValid('verbalsInsertion')) {
		var data = [
			$("#date").val(),
			$("#text").val()
		];
		sent('verbals', 'insert', data);
		$('#verbalsInsertion').closeModal();
	}
});

/*
	Verbal delete
*/
$(document).on("click", "#verbalDelete", function() {
	var data = [$("#id").text()];
	sent('verbals', 'delete', data);
});
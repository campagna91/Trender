$(document).on("click", "#settingSuorceInsertion", function() {
	if(formIsValid('settingsSourcesInsertion')) {
		var data = [ $("#settingSourceName").val() ];
		sent('sources', 'insert', data);
		$("#settingSourceList").append("<div class='chip'><a>" + data[0] + "</a><i class='material-icons sourceDelete'>close</i></div>");
		$("#settingSourceName").val('');
	}
});

$(document).on("click", ".sourceDelete", function() {
	var data = [$(this).prev().text()];
	if(confirm('Erasing source you will delete all requirement having this source. Are you sure to delete?'))
		sent('sources', 'delete', data);
});

$(document).on("click", "#settingTypeInsertion", function() {
	if(formIsValid('settingsTypesInsertion')) {
		var data = [ 
			$("#settingTypesName").val(),
			'Default'
		];
		sent('types', 'insert', data);
		$("#settingTypesList").append("<div class='chip'><a>" + data[0] + "</a><i class='material-icons sourceDelete'>close</i></div>");
		$("#settingTypeName").val('');
	}
});

$(document).on("click", ".typeDelete", function() {
	var data = [
		$(this).prev().text(),
		'Default'
	];
	if(confirm('Erasing source you will delete all requirement having this source. Are you sure to delete?'))
		sent('types', 'delete', data);
});

$(document).on("click", "#settingPrintSave", function() {
	$("input[type='checkbox']").each(function() {
		var data = [
			$(this).attr('id'),
			$(this).prop('checked')
		];
		sent('prints', 'update', data);
	});
});

$(document).on("click", "#settingPrintRun", function() {
	$("input[type='checkbox']").each(function() {
		if($(this).prop('checked')) {
			var data = [$(this).attr('id')];
			sent('prints', data[0], 'null');
		}
	});
});

$(document).on("click", "#settingBackupDo", function() {
	var current = new Date();
	sent('backups', 'do', 'none');
});

$(document).on("click", "#settingBackupRestore", function() {
	var data;
	$("#settingBackupList p input[type='radio']").each(function() {
		if($(this).prop('checked'))
			data = $(this).attr('id');
	});
	sent('backups', 'restore', data);
});
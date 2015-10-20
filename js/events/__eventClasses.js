/*
	Classes insertion
*/
$(document).on("click", "#classInsert", function() {
	if(formIsValid('classesInsertion')) {
		var data = [
			$('#package').val(),
			$('#class').val(),
			$('#description').val(),
			$('#use').val()
		];
		sent('classes', 'insert', data);
		$('#classesInsertion').closeModal();
	}
});

/*
	Class insertion nameFix
*/
$(document).on("focusout", "#class", function() {
	$("#class").val($.trim($(this).val()).replace(/\s/g, "_"));
});

/*
	Classes delete
*/
$(document).on("click", "#classDelete", function() {
	var data = [
		$("#id").text(),
		urlParam('package')
	];
	sent('classes', 'delete', data);
});

/*
	Classes update
*/
$(document).on("click", "#classUpdate", function() {
	if(formIsValid('classesUpdate')) {
		var data = [
			$("#id").text(),
			$("#class").val(),
			$("#package").val(),
			$("#description").val(),
			$("#applications").val()
		];
		sent('classes', 'update', data);
	}
});

/*
	Classes base insert
*/
$(document).on("click", "#classBaseInsert", function() {
	var basePackage = $("#base").val().split(".")[0];
	derivativePackage = urlParam('package');

	if(formIsValid('classesBase')) {
		var data = [
			$("#id").text(),
			$("#base").val().split(".")[1],
			$("#base").val().split(".")[0],
			derivativePackage
		];
		$("#base option[value='" + data[2] + "." + data[1] + "']").remove();
		sent('classes', 'baseInsert', data);
		$("#classBaseList").append("<div class='chip'><a href='classes.php?id=" + data[1] + "&package=" + data[2] + "''>" + data[2] + "." + data[1] + "<i class='material-icons classBaseDelete'>close</i></a></div>");
		$('select').material_select();
	}
});

/*
	Classes base delete
// */
$(document).on("click", ".classBaseDelete", function() {
	var data = [
		$("#id").text(),
		$(this).prev().html().split(".")[1],
		urlParam('package'),
		$(this).prev().html().split(".")[0]
	];
	sent('classes', 'baseDelete', data);
	$(this).parent().parent().remove();
	$("#base").append("<option value=" + data[3] + "." + data[1] + ">" + data[3] + "." + data[1] + "</option>");
	$('select').material_select();	
});

/*
	Class relation choose
*/
/*
	Class relation insert
*/
$(document).on("click", "#classRelationInsert", function() {
	if(formIsValid('classesRelations')) {
		var data = [
			$("#id").text(),
			urlParam('package'),
			$("#related").val().split(".")[1],
			$("#related").val().split(".")[0],
			$("#type").val()
		];
		sent('classes', 'relationInsert', data);
		$("#type option[value='" + data[2] + "']").remove();
		$("#classRelationList").append("<div class='chip'><a href='classes.php?id=" + data[2] + "&package=" + data[3] +"'>" + data[4].substr(0, 3).toUpperCase() + "." + data[2] + "." + data[1] + "</a><i class='material-icons classRelationDelete'>close</i></div>");
	}
});

/*
	Class relation delete
*/
$(document).on("click", ".classRelationDelete", function() {
	var data = [
		$("#id").text(),
		urlParam('package'),
		$(this).prev().html().split(".")[2],
		$(this).prev().html().split(".")[1].trim(),
		getRelationType($(this).prev().html().split(".")[0])
	];
	sent('classes', 'relationDelete', data);
	$(this).parent().remove();
});

/*
	Class attribute insert
*/
$(document).on("click", "#classAttributeInsert", function() {
	if(formIsValid('classesAttributesInsert')) {
		var data = [
			$("#id").text(),
			$("#attributeName").val(),
			$("#attributeType").val(),
			$("#attributeDescription").val(),
			urlParam('package')
		];
		sent('classes', 'attributeInsert', data);
		$("#attributeName").val('');
		$("#attributeDescription").val('');
		$("#classAttributeList").append("<tr class=" + data[1] + "><td><a class='btn-floating btn-medium waves-light attributeUpdate'><i class='material-icons'>create</i></a><a class='btn-floating btn-medium waves-light attributeRemove'><i class='material-icons'>remove</i></a></td><td>" + data[1] + "</td><td>" + data[2] + "</td><td>" + data[3] + "</td></tr>");
	}
});

/*
	Classes attribute insert nameFix
*/
$(document).on("focusout", "#attributeName", function() {
	$("#attributeName").val($.trim($(this).val()).replace(/\s/g, "_"));
});

/*
	Class attribute update
*/
$(document).on("click", "#classAttributeUpdate", function() {
	if(formIsValid('classesAttributesUpdate')) {
		var data = [
			$("#id").text(), 
			urlParam('package'),
			$("#updateAttribute").text(),
			$("#updateAttributeType").val(),
			$("#updateAttributeName").val(),
			$("#updateAttributeDescription").val()
		];
		sent('classes', 'attributeUpdate', data);
		$("#classAttributeList tr").each(function() {
			if($(this).children('td').eq(1).text() == data[2]) {
				$(this).remove();
				return;
			}
		});
		$("#classAttributeList").append("<tr class='" + data[4] + "'><td><a class='btn-floating btn-medium waves-light attributeUpdate'><i class='material-icons'>create</i></a><a class='btn-floating btn-medium waves-light attributeRemove'><i class='material-icons'>remove</i></a></td><td>" + data[4] + "</td><td>" + data[3] + "</td><td>" + data[5] + "</td></tr>");
		$("#classesAttributesUpdate").closeModal();
	}
});

$(document).on("click", ".attributeUpdate", function() {
	$("#updateAttributeName").val($(this).parent().next().text());
	$("#updateAttributeDescription").val($(this).parent().next().next().next().text());
	$("#updateAttribute").text($("#updateAttributeName").val());
	$("#classesAttributesUpdate").openModal();
	var x = $(this).parent().next().next().text();
	selectCurrent('updateAttributeType', x);
	$('select').material_select();
});

/*
	Class attribute delete
*/
$(document).on("click", ".attributeRemove", function(){
	var data = [
		$("#id").text(),
		urlParam('package'),
		$(this).parent().next().text()
	];
	sent('classes', 'attributeDelete', data);
	$(this).parent().parent().remove();
});

/*
	Class method insert
*/
$(document).on("click", "#classMethodInsert", function() {
	if(formIsValid('classesMethodInsert')) {
		var data = [
			$("#id").text(),
			urlParam('package'),
			$("#methodType").val(),
			$("#methodSignature").val(),
			$("#methodDescription").val()
		];
		sent('classes', 'methodInsert', data);
		
		$("#classAttributeList").append("<tr class='" + data[1] + "'><td>" + data[1] + "</td><td>" + data[2] + "</td><td>" + data[3] + "</td></tr>");

		$("#classMethodParamList div.chip").each(function() {
			console.log('chip');
			var data = [
				$("#id").text(),
				urlParam('package'),
				$("#methodSignature").val(),
				$("#methodType").val(),
				$(this).children('a').html().split(":")[1],
				$(this).children('a').html().split(":")[0],
				$(this).children('a').attr('data-tooltip')
			];
			sent('classes', 'paramInsert', data);
		});

	}
});

/*
	Class method insert nameFix
*/
$(document).on("focusout", "#methodSignature", function() {
	$("#methodSignature").val($.trim($(this).val()).replace(/\s/g, "_"));
});

/*
	Class method delete
*/

/*
	Class method udpate
*/

/*
	Class param insert
*/
$(document).on("click", "#classMethodParamInsert", function() {
	console.log('ciao');
	if(formIsValid('classMethodParam')) {
		$("#classMethodParamList").append("<div class='chip'><a class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='" + $("#paramDescription").val() + "'>" + $("#paramType").val() + ":" + $("#paramName").val() + "</a><i class='material-icons paramDelete'>close</i></div>");
		$('.tooltipped').tooltip({delay: 50});
		$("#paramType").val('');
		$("#paramName").val('');
		$("#paramDescription").val('');
	}
});

/*
	Class param delete
*/
$(document).on("click", ".paramDelete", function() {
	$(this).parent().remove();
});

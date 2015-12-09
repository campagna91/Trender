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
		truncate('classAttributeList');
	}
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

/*
	Classes attribute update confirm
*/
$(document).on("click", ".attributeUpdate", function() {
	$("#updateAttributeName").val($(this).parent().next().text());
	$("#updateAttributeDescription").val($(this).parent().next().next().next().text());
	$("#updateAttribute").text($("#updateAttributeName").val());
	$("#classesAttributesUpdate").openModal();
	selectCurrent('updateAttributeType', $(this).parent().next().next().text());
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
		$("#classMethodList").append("<tr><td class='control'><a class='btn-floating btn-medium waves-light methodUpdate'><i class='material-icons'>create</i></a><a class='btn-floating btn-medium waves-light methodRemove'><i class='material-icons'>remove</i></a></td><td class='" + data[3] + "'>" + data[3] + "</td><td class='" + data[2] + "'>" + data[2] + "</td><td class='" + data[4] + "'>" + data[4] + "</td></tr>");
		truncate('classMethodList');

		// Params insertion
		$("#classMethodParamList div.chip").each(function() {
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
			$(this).remove();
		});
		$("#methodSignature").val('');
		$("#methodDescription").val('');
		selectCurrent('methodType', '');
		$('select').material_select();
	}
});

/*
	Class method delete
*/
$(document).on("click", ".methodRemove", function() {
	var data = [
		$("#id").text(),
		urlParam('package'),
		$(this).parent().next().attr('class'),
		$(this).parent().next().next().attr('class')
	];
	sent('classes', 'methodDelete', data);
	$(this).parent().parent().remove();
});

/*
	Class method udpate modal
*/
$(document).on("click", ".methodUpdate", function() {
	var data = [
		$("#id").text(), 
		urlParam('package'),
		$(this).parent().next().attr('class'),
		$(this).parent().next().next().attr('class')
	];
	loadMethodUpdate(data);
});

/*
	Class method update
*/
$(document).on("click","#classMethodUpdate", function() {
	if(formIsValid('classMethodsUpdate')) {
		var data = [
			urlParam('id'),
			urlParam('package'),
			$("#updateMethod").text().split(".")[1],
			$("#updateMethod").text().split(".")[0],
			$("#classMethodsUpdateSignature").val(),
			$("#classMethodsUpdateType").val(),
			$("#classMethodsUpdateDescription").val()
		];
		sent('classes', 'methodUpdate', data);
		$("#classesMethodsUpdate").closeModal();

		$("#classMethodList tbody tr").each(function(index) {
			console.log('type = ' + data[3] + ' signature = ' + data[2]);
			if($(this).children('td').eq(1).attr('class') == data[2] && $(this).children('td').eq(2).attr('class') == data[3]) {
				$(this).remove();
				return;
			}
		});

		$("#classMethodList").append("<tr><td class='control'><a class='btn-floating btn-medium waves-light methodUpdate'><i class='material-icons'>create</i></a><a class='btn-floating btn-medium waves-light methodRemove'><i class='material-icons'>remove</i></a></td><td class='" + data[4] + "'>" + data[4] + "</td><td class='" + data[5] + "'>" + data[5] + "</td><td class='" + data[6] + "'>" + data[6] + "</td></tr>");
		truncate('classMethodList');
		
		var data = [
			urlParam('id'),
			urlParam('package'),
			$("#updateMethod").text().split(".")[1],
			$("#updateMethod").text().split(".")[0]
		];
		sent('classes', 'paramDeleteAll', data);

		$("#classMethodsUpdateParamsList div.chip").each(function() {
			var data = [
				urlParam('id'),
				urlParam('package'),
				$("#updateMethod").text().split(".")[1],
				$("#updateMethod").text().split(".")[0],
				$(this).children('a').text().split(':')[1],
				$(this).children('a').text().split(':')[0],
				unescape($(this).children('a').attr('data-tooltip')),
				$("#classMethodsUpdateSignature").val()
			];
			sent('classes','paramInsert', data);
		});
	}
});

/*
	Class method update param insert
*/
$(document).on("click", "#classMethodUpdateParamInsert", function() {
	if(formIsValid('classMethodUpdateParamInsert')) {
		$("#classMethodsUpdateParamsList").append("<div class='chip'><a class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='" + escape($("#classMethodUpdateParamDescription").val()) + "'>" + $("#classMethodUpdateParamType").val() + ":" + $("#classMethodUpdateParamName").val() + "</a><i class='material-icons paramDelete'>close</i></div>");
		$('.tooltipped').tooltip({delay: 50});
		selectCurrent('classMethodUpdateParamType', '');
		$('select').material_select();
		$("#classMethodUpdateParamDescription").val('');
		$("#classMethodUpdateParamName").val('');
	}
});

/*
	Class param insert
*/
$(document).on("click", "#classMethodParamInsert", function() {
	if(formIsValid('classMethodParam')) {
		$("#classMethodParamList").append("<div class='chip'><a class='tooltipped' data-position='bottom' data-delay='50' data-tooltip=\"" + $("#paramDescription").val() + "\">" + $("#paramType").val() + ":" + $("#paramName").val() + "</a><i class='material-icons paramDelete'>close</i></div>");
		$('.tooltipped').tooltip({delay: 50});
		selectCurrent('paramType', '');
		$('select').material_select();
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

/*
	Fix name without space
*/
$(document).on("focusout", "#methodSignature, #attributeName, #class, #paramName, #classMethodsUpdateSignature, #classMethodUpdateParamName", function() {
	$(this).val($.trim($(this).val()).replace(/\s/g, "_"));
});

$(document).ready(function() {
	truncate();
});
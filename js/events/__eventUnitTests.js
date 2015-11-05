$(document).on("change", "#unitTestInsertionPackage", function() {
	if($(this).val() != "") {
		$.ajax({
			url: "cgi-bin/__moduleUnitTestsInsertionClasses.php",
			type:'post',
			dataType:'html',
			data:{
				'package':$("#unitTestInsertionPackage").val()
			},
			success:function(data) {
				$("#unitTestInsertionClasses option[value!='']").each(function() {
					$(this).remove();
				});
				$("#unitTestInsertionClasses").append(data);
				$('select').material_select();
			}
		});
	}
});

$(document).on("click", "#unitTestDelete", function() {
	var data = [$("#id").text()];
	sent("unitTests", "delete", data);
});

$(document).on("change", "#unitTestInsertionClasses", function() {
	if($(this).val() != '') {
		$.ajax({
			url: "cgi-bin/__moduleUnitTestsInsertionMethods.php",
			type:'post',
			dataType:'html',
			data:{
				'class': $("#unitTestInsertionClasses").val(),
				'package': $("#unitTestInsertionPackage").val()
			},
			success:function(data) {
				$("#unitTestInsertionMethods option[value!='']").each(function() {
					$(this).remove();
				});
				$("#unitTestInsertionMethods").append(data);
				$('select').material_select();
			}
		});
	}
});

$(document).on("click", "#unitTestInsertionMethodInsert", function() {
	if(formIsValid('unitTestInsertion')) {
		$("#unitTestInsertionMethodsList").append("<div class='chip'><a>" + $("#unitTestInsertionMethods").val().split(".")[0] + " " + $("#unitTestInsertionPackage").val() + ":" + $("#unitTestInsertionClasses").val() + "." + $("#unitTestInsertionMethods").val().split(".")[1] + "</a><i class='material-icons methodDelete'>close</i></div>");
		$("#unitTestInsertionPackage").val('');
		$("#unitTestInsertionClasses").val('');
		$("#unitTestInsertionClasses option:gt(0)").remove();
		$("#unitTestInsertionMethods").val('');
		$("#unitTestInsertionMethods option:gt(0)").remove();
		$("select").material_select();
	}
});

$(document).on("click", "#unitTestInsert", function() {
	if(formIsValid('unitTestInsertionContent')) {
		var max = 0;

		// Select last id
		if($("#mainList tbody tr").length > 0) {
			max = parseInt($("#mainList tbody tr").last().children('td').eq(0).text());
			max += 1;
		}
		var data = [
			max, 
			$("#unitTestInsertionDescription").val()
		];	

		// Check if specified at least a method
		if($("#unitTestInsertionMethodsList div.chip").length >= 1) {
			sent('unitTests', 'insert', data);

			$("#unitTestInsertionMethodsList div.chip").each(function() {
				var data = [
					max,
					$(this).children('a').text().split(" ")[1].split(":")[1].split(".")[0],
					$(this).children('a').text().split(" ")[1].split(":")[0],
					$(this).children('a').text().split(" ")[1].split(":")[1].split(".")[1],
					$(this).children('a').text().split(" ")[0]
				];
				sent('unitTests', 'insertMethod', data);
			});
			$("#unitTestsInsertion").closeModal();
		}
	}
});

$(document).on("click", ".methodDelete", function() {
	var data = [
		$("#id").text(), 
		$(this).prev().text().split(" ")[0],
		$(this).prev().text().split(" ")[1].split(":")[0],
		$(this).prev().text().split(" ")[1].split(":")[1].split(".")[0],
		$(this).prev().text().split(" ")[1].split(":")[1].split(".")[1]
	];
	sent("unitTests", "methodDelete", data);
});

$(document).on("click", "#unitTestUpdate", function() {
	if(formIsValid("unitTestsUpdate")) {
		var data = [
			$("#id").text(),
			$("#unitTestDescription").val()
		];
		sent("unitTests", "update", data);
	}
});

$(document).on("change", "#unitTestPackage", function() {
	if($(this).val() != "") {
		$.ajax({
			url: "cgi-bin/__moduleUnitTestsInsertionClasses.php",
			type:'post',
			dataType:'html',
			data:{
				'package':$("#unitTestPackage").val()
			},
			success:function(data) {
				$("#unitTestClass option[value!='']").each(function() {
					$(this).remove();
				});
				$("#unitTestClass").append(data);
				$('select').material_select();
			}
		});
	}
});

$(document).on("change", "#unitTestClass", function() {
	if($(this).val() != '') {
		$.ajax({
			url: "cgi-bin/__moduleUnitTestsInsertionMethods.php",
			type:'post',
			dataType:'html',
			data:{
				'class': $("#unitTestClass").val(),
				'package': $("#unitTestPackage").val()
			},
			success:function(data) {
				$("#unitTestMethod option[value!='']").each(function() {
					$(this).remove();
				});
				$("#unitTestMethod").append(data);
				$('select').material_select();
			}
		});
	}
});

$(document).on("click", "#unitTestMethodInsert", function() {
	if(formIsValid("unitTestMethodUpdate")) {
		var data = [
			$("#id").text(),
			$("#unitTestClass").val(),
			$("#unitTestPackage").val(),
			$("#unitTestMethod").val().split(".")[1],
			$("#unitTestMethod").val().split(".")[0]
		];
		sent("unitTests", "insertMethod", data);
		$("#unitTestMethodList").append("<div class='chip'><a class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='OPS! to see description'>" + data[4] + " " + data[2] + ":" + data[1] + "." + data[3] + "</a><i class='material-icons methodDelete'>close</i></div>")
	}
});
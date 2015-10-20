/*
	Packages list loader
*/
function loadList() {
	$("#mainList").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackagesList.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("#mainListWrapper");
		}
	});
}

/*
	Packages insertion loader
*/
function loadInsert() {
	$("#packagesInsertion").remove();
	$.ajax({
		url: 'cgi-bin/__modulePackagesInsertion.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data) {
			$(data).appendTo("body");
			$('select').material_select();
		}
	});
}
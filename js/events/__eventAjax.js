function sent(section, type, dataSent){
	var path = ""; 
	switch(section) {
		case('requirements'): 
			path = "cgi-bin/__ajaxRequirements.php"; 
			break;

		case('usecases'): 
			path = "cgi-bin/__ajaxUsecases.php"; 
			break;

		case('actors'): 
			path = "cgi-bin/__ajaxActors.php"; 
			break;

		case('verbals'): 
			path = "cgi-bin/__ajaxVerbals.php"; 
			break;

		case('classes'): 
			path = "cgi-bin/__ajaxClasses.php"; 
			break;

		case('packages'): 
			path = "cgi-bin/__ajaxPackages.php"; 
			break;

		case('unitTest'): 
			path = "cgi-bin/__ajaxUnitTest.php"; 
			break;
	}
	alert(dataSent);
	$.ajax({
		url: path,
		type:'post',
		dataType:'html',
		data:{
			'typeRequest':type,
			'data':dataSent,
		},
		success:function(data) {
			console.log(data);
			switch(type) {
				case('insert'):
					loadInsert();
					loadList();
					break;

				case('delete'):
					loadInsert();
					loadList();
					location.href="" + section + ".php";
					break;

				case('update'):
					//loadUpdate();
					break;
			}
		}
	});
}

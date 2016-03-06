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

		case('unitTests'): 
			path = "cgi-bin/__ajaxUnitTests.php"; 
			break;

		case('sources'):
			path = "cgi-bin/__ajaxSources.php";
			break;

		case('types'):
			path = "cgi-bin/__ajaxTypes.php";
			break;

		case('prints'):
			path = "cgi-bin/__ajaxPrints.php";
			break;

		case('backups'):
			path = "cgi-bin/__ajaxBackups.php";

		case('glossary'):
			path = "cgi-bin/__ajaxGlossary.php";
			break;
	}
	console.log(dataSent);
	console.log(type);
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
			if(data.substring(0, 4) == 'ERROR')
				Materialize.toast("ERRORE DURANTE L'ESECUZIONE DEL COMANDO", 2000);
			else 
				Materialize.toast("COMANDO ESEGUITO CORRETTAMENTE", 2000);
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
			}
		}
	});
}

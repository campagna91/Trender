function sent(section,type,dataSent){
	var path = ""; 
	switch(section){
		case('requirement'): path = "cgi-bin/__ajaxRequirement.php"; break;
		case('usecase'): path = "cgi-bin/__ajaxUsecase.php"; break;
		case('actor'): path = "cgi-bin/__ajaxActor.php"; break;
		case('verbal'): path = "cgi-bin/__ajaxVerbal.php"; break;
		case('class'): path = "cgi-bin/__ajaxClass.php"; break;
		case('package'): path = "cgi-bin/__ajaxPackage.php"; break;
		case('unitTest'): path = "cgi-bin/__ajaxUnitTest.php"; break;
	}
	/*
		to reload correctly module, data array must be have in position 0 
		the id of field passed for ajax request except loadList().
	*/
	$.ajax({
		url: path,
		type:'post',
		dataType:'html',
		data:{
			'typeRequest':type,
			'data':dataSent,				
		},
		success:function(data){
			if(data.substr(0,3) == 'ERR') notice(data,1);
			else notice(data,0);
			switch(type){
				case('insert'):
					loadInsert();
					loadList();
					break;
				case('delete'):
					loadAll();
					loadInsert();
					break;
				case('update'):
					loadAll(dataSent[0],1);
					break;
				case('inheritanceInsert'):
				case('inheritanceDelete'):
					loadInheritance(dataSent[0],1);
					break;
				case('relationInsert'):
				case('relationDelete'):
					loadRelation(dataSent[0],1);
				case('relationUpdate'):
					// none to do 
					break;
				case('interactionInsert'):
				case('interactionUpdate'):
				case('interactionDelete'):
					loadInteraction(dataSent[0],1);
					break;
				case('usecaseInsert'):
				case('usecaseDelete'):
					loadUsecase(dataSent[0],1);
					break;
				case('requirementInsert'):
				case('requirementDelete'):
					loadRequirement(dataSent[0],1);
					break;
				case('actorInsert'):
				case('actorDelete'):
					loadActor(dataSent[0],1);
					break;
				case('verbalInsert'):
				case('verbalDelete'):
					loadVerbal(dataSent[0],1);
					break;
				case('childDelete'):
					loadChild(dataSent[0],1);
					break;
				case('packageInsert'):
				case('packageDelete'):
					loadPackage(dataSent[0],1);
					break;
				case('attributeInsert'):
				case('attributeDelete'):
				case('attributeUpdate'):
				case('methodInsert'):
				case('methodDelete'):
				case('methodUpdate'):
					loadAttributeMethod(dataSent[0],1);
					break;
				case('classDelete'):
				case('classInsert'):
					loadClass(dataSent[0],1);
					break;
			}
		}
	});
}

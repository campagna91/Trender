$(document).on('click',"#trenderPlus", function() {
	if( $("#moduleHeader").next().attr('id') == 'actions') {
		$("#actions").remove();
	} else {
		$.ajax({
			url: 'cgi-bin/__moduleHeaderActions.php',
			type:'post',
			cache:'false',
			dataType:'html',
			success:function(data){
				$("#moduleHeader").after(data);
			}
		});
	}
});
$(document).on('click',"#backup_db", function() {
	$.ajax({
		url:'cgi-bin/__ajaxBackup.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			notice("Backup eseguito. Grazie per aver scelto Trender Plus",0);	
		}
	});
});
$(document).on('click',"#export_c_r", function() {
	$.ajax({
		url:'cgi-bin/__ajaxLatexARRequirementUsecase.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			notice("LATEX stampato con successo. Grazie per aver scelto Trender+",0);	
		}
	});
});

$(document).on('click',"#export_t", function() {
	$.ajax({
		url:'cgi-bin/__ajaxLatexPQTest.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			notice("LATEX TEST stampato con successo. Grazie per aver scelto Trender+",0);	
		}
	});
});
$(document).on('click',"#export_p", function() {
	$.ajax({
		url:'cgi-bin/__ajaxLatexSTPackageClass.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			notice("LATEX PACKAGE + CLASSI stampato con successo. Grazie per aver scelto Trender+",0);	
		}
	});
});
$(document).on('click',"#export_tracciamento_p_r", function() {
	$.ajax({
		url:'cgi-bin/__ajaxLatexSTTracPackReq.php',
		type:'post',
		cache:'false',
		dataType:'html',
		success:function(data){
			notice("LATEX PACKAGE + CLASSI stampato con successo. Grazie per aver scelto Trender+",0);	
		}
	});
});
$(document).on('click',"#metriche", function() {
	$.ajax({
		url:'cgi-bin/__ajaxScript.php',
		type:'post',
		cache:'false',
		dataType:'html',
		data:{
			file: 'sh /home/simi/script/metriche/script.sh'
		},
		success:function(data){
			notice(data);
			//notice("SCRIPT ESEGUITO CON SUCCESSO. Grazie per aver scelto Trender+");	
			$.ajax({
				url:'cgi-bin/__ajaxLatexPQTest.php',
				type:'post',
				cache:'false',
				dataType:'html',
				success:function(data){
					//notice("LATEX TEST PQ stampato con successo. Grazie per aver scelto Trender+");	
				}
			});
		}
	});
});


	

	

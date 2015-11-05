/*
	Notify last executed action
*/
function notice(msg,i) {
	$('body').append("<div id='notice'>"+msg+"</div>");
	if(i) 
		$("#notice").css("background-color","rgba(255,0,0,0.4");
	else 
		$("#notice").css("background-color","rgba(0,255,0,0.4");
	setTimeout(function() {
		$("#notice").remove();
	}, 5000);
}
/*
	Select current value in a select
*/
function selectCurrent(tagId, currentValue) {
	console.log('select request: ' + tagId + ' with ' + currentValue);
	$("#" + tagId + " > option").each(function() {
		if($(this).val() == currentValue)
			$(this).attr('selected', 'selected');
		else
			$(this).removeAttr('selected');
		console.log('score ' + $(this).val());
	});
}
/*
	Check if all validate field are setted
*/
function formIsValid(formId) {
	var valid = true;
	$("#" + formId + " .validate").each(function() {
		if($(this).prop('tagName') != 'DIV') {
			if($(this).val() == '') {
				valid = false;
				$(this).addClass('invalid');
			} else {
				$(this).removeClass('invalid');
			}
		} else console.log('div');
	});
	return valid;
}
/*
	Get value of url parameter passed as parameter
*/
function urlParam(param) {
  var sPageURL = window.location.search.substring(1);
  var sURLVariables = sPageURL.split('&');
  for (var i = 0; i < sURLVariables.length; i++) 
  {
    var sParameterName = sURLVariables[i].split('=');
    if (sParameterName[0] == param) 
    {
      return sParameterName[1];
    }
  }
 }
/*
	Translate value of relation abbrevation to full value length
*/
function getRelationType(abbrevation) {
	switch(abbrevation) {
		case('NAV'):
			return 'navigable';
		case('AGG'):
			return 'aggregation';
		case('COM'):
			return 'composition';
		case('DEP'):
			return 'dependency';
		case('REL'):
			return 'relization';
		case('ASS'):
			return 'association';
	}
}

/*
	Table content td
*/
function truncate(table) {
	if(table === undefined) {
		$("table tbody tr td:not(.control)").each(function() {
			var text = $(this).text();
			$(this).text('');
			var tableWidth = $(this).parent().parent().parent().width();
			var numCols = $(this).parent().children('td').size();
			var maxWidth = tableWidth / numCols;
			$(this).css('max-width', maxWidth);
			$(this).css('overflow','hidden');
			$(this).text(text);
		});
	} else {
		$("#" + table + " tbody tr td:not(.control)").each(function() {
			var text = $(this).text();
			$(this).text('');
			var tableWidth = $(this).parent().parent().parent().width();
			var numCols = $(this).parent().children('td').size();
			var maxWidth = tableWidth / numCols;
			$(this).css('max-width', maxWidth);
			$(this).css('overflow','hidden');
			$(this).text(text);
		});
	}
}
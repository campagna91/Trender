/*
	Permit direct link without click on link
*/
$(document).on("click","#mainList tr td.target",function(){
	switch(document.location.pathname.match(/[^\/]+$/)[0]) {
		case('requirements.php'): 
		case('usecases.php'): 
		case('actors.php'): 
		case('verbals.php'):
		case('glossary.php'):
		case('packages.php'):
		case('unitTests.php'):
			location.href = document.location.pathname.match(/[^\/]+$/)[0] + "?id=" + $(this).parent().attr('class').split(/\s+/)[0];
			break;
		case('classes.php'): 
			location.href = document.location.pathname.match(/[^\/]+$/)[0] + "?id=" + $(this).parent().attr('class').split(/\s+/)[0]+"&package=" + $(this).parent().attr('class').split(/\s+/)[1];
			console.log('ciccio');
			break;
	}
});

// Last background-color or row
var lastCSS = '';

/*
	Put row in evidence
*/
$(document).on("mouseover","#mainList tbody tr, table tbody tr",function(){
	while(lastCSS == '') {}
	var lastCSS = $(this).css('background-color');
	$(this).css('background-color', '#69f0ae');
	console.log('mouseover');
});

/*
	Remove row's evidence
*/
$(document).on("mouseleave","#mainList tbody tr, table tbody tr",function(){
	$(this).css('background-color', lastCSS);
	lastCSS = '';
});

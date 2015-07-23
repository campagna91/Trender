$.getScript('js/__eventAjax.js');
$.getScript('js/__eventSystem.js');
$.getScript('js/__eventMenu.js');
switch(document.location.pathname.match(/[^\/]+$/)[0]){
	case('requisiti.php'): $.getScript('js/__eventRequirement.js');break;
	case('casiuso.php'): $.getScript('js/__eventUsecase.js'); break;
	case('attori.php'): $.getScript('js/__eventActor.js'); break;
	case('verbali.php'): $.getScript('js/__eventVerbal.js'); break;
	case('package.php'): $.getScript('js/__eventPackage.js'); break;
	case('classi.php'): $.getScript('js/__eventClass.js'); break;
	case('unitTest.php'): $.getScript('js/__eventUnitTest.js'); break;
}
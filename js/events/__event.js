/**
 * Nome del file: __events.js
 * Percorso: /js/_events.js
 * Autore: Simone Camapgna
 * Data creazione: 2015-10-03
 * E-mail: campagna.simone.91@gmail.com
 *
 * Questo file è proprietà di Simone Campagna e viene rilasciato sotto
 * licenza GNU AGPLv3.
 *
 * Diario delle modifiche:
 */

// Import libraries
$.getScript('lib/materialize/js/materialize.min.js');

// Import system utility
$.getScript('js/__systemUtility.js');

// General script
$.getScript('js/events/__eventAjax.js');
$.getScript('js/events/__eventSystem.js');


// Scripts are imported based on the page in which they are called
switch(document.location.pathname.match(/[^\/]+$/)[0]){
	case('requirements.php'): 
		$.getScript('js/moduleLoaders/__moduleRequirements.js');
		$.getScript('js/events/__eventRequirements.js'); 
		break;

	case('usecases.php'): 
		$.getScript('js/moduleLoaders/__moduleUsecases.js');
		$.getScript('js/events/__eventUsecases.js'); 
		break;

	case('actors.php'): 
		$.getScript('js/moduleLoaders/__moduleActors.js');
		$.getScript('js/events/__eventActors.js'); 
		break;

	case('verbals.php'): 
		$.getScript('js/moduleLoaders/__moduleVerbals.js');
		$.getScript('js/events/__eventVerbals.js'); 
		break;

	case('packages.php'): 
		$.getScript('js/moduleLoaders/__modulePackages.js');
		$.getScript('js/events/__eventPackages.js'); 
		break;

	case('classes.php'): 
		$.getScript('js/moduleLoaders/__moduleClasses.js');
		$.getScript('js/events/__eventClasses.js'); 
		break;

	case('unitTests.php'):
		$.getScript('js/moduleLoaders/__moduleUnitTests.js');
		$.getScript('js/events/__eventUnitTests.js');
		break;

	case('settings.php'):
		$.getScript('js/events/__eventSettings.js');
		break;

	case('glossary.php'):
		$.getScript('js/moduleLoaders/__moduleGlossary.js');
		$.getScript('js/events/__eventGlossary.js');
		break;		
}

// Need for graphic library
$(document).ready(function(){
	$(".dropdown-button").dropdown();
	$(".button-collapse").sideNav();
	$('select').material_select();
	$('.modal-trigger').leanModal();
	$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });
});
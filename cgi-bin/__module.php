<?
require_once('cgi-bin/__system.php');
function modLogin() {	include_once('__moduleLogin.php');}
function modIndexResume() { include_once('__moduleIndexResume.php');	}
function modHeader() {	include_once('__moduleHeader.php');	}
function mainList() { ?>
	<div id="mainListWrapper" class="row"> <?
			switch(basename($_SERVER['PHP_SELF']))
			{
				case('requirements.php'): include_once('__moduleRequirementsList.php');	break; 
				case('usecases.php'):	 include_once('__moduleUsecasesList.php');	break; 
				case('actors.php'):	 include_once('__moduleActorsList.php');	break; 
				case('verbals.php'):	include_once('__moduleVerbalsList.php');	break; 
				case('packages.php'):	 include_once('__modulePackagesList.php');	break; 
				case('classes.php'):	 include_once('__moduleClassesList.php');	break; 
				case('unitTests.php'):	include_once('__moduleUnitTestsList.php'); break;
				case('glossary.php'): include_once('__moduleGlossaryList.php'); break;
			} ?>
		</div> <?
}
function modSpecs(){
	if(isset($_GET['id']) && esiste($_GET['id'])) {
		switch(basename($_SERVER['PHP_SELF']))
		{
		case('requirements.php'): include_once('__moduleRequirementsSpecs.php');	break; 
		case('usecases.php'):	 include_once('__moduleUsecasesSpecs.php');	break; 
		case('actors.php'):	 include_once('__moduleActorsSpecs.php');	break; 
		case('verbals.php'):	include_once('__moduleVerbalsSpecs.php');	break; 
		case('packages.php'):	 include_once('__modulePackagesSpecs.php');	break; 
		case('classes.php'):	 include_once('__moduleClassesSpecs.php');	break; 
		//case('unitTest.php'):	include_once('__moduleUnitTestSpecs.php'); break;
	}
	} else mainList();
}?>
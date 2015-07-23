<?
require_once('__system.php');

function modLogin(){	include_once('__moduleLogin.php');}
function modIndexResume(){ include_once('__moduleIndexResume.php');	}
function modHeader(){	include_once('__moduleHeader.php');	}
function sideBar() {?>
<div id="sidebar">
		<div id="menuActions">
			<button class="actionResizeLeft">&lt</button>
			<span>Azioni</span>
			<button class="actionResizeRight">&gt</button>
			<button class="actionResizeFull">&gt &gt</button>
		</div><?
		switch(basename($_SERVER['PHP_SELF']))
		{	
			case('requisiti.php'): 	?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Modifica</h2>
									<h2 id="sidebarChild" class="close">Figli</h2>
									<h2 id="sidebarUsecase" class="close">Casi associati</h2>
									<h2 id="sidebarVerbal" class="close">Verbali associati</h2>
									<h2 id="sidebarPackage" class="close">Package associati</h2>
									<h2 id="sidebarClass" class="close">Classi associate</h2><?
									break;

			case('casiuso.php'): 	?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Modifica</h2>
									<h2 id="sidebarChild" class="close">Figli</h2>
									<h2 id="sidebarActor" class="close">Attori associati</h2>
									<h2 id="sidebarRequirement" class="close">Requisiti associati</h2><?
									break;

			case('attori.php'):		?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Modifica</h2>
									<h2 id="sidebarUsecase" class="close">Casi associati</h2><?
									break;

			case('verbali.php'): 	?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Modifica</h2>
									<h2 id="sidebarUsecase" class="close">Casi associati</h2>
									<h2 id="sidebarRequirement" class="close">Requisiti associati</h2><?
									break;

			case('package.php'): 	?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Modifica</h2>
									<h2 id="sidebarChild" class="close">Figli</h2>
									<h2 id="sidebarRequirement" class="close">Requisiti associati</h2>
									<h2 id="sidebarInteraction" class="close">Interazioni</h2><?
									break;

			case('classi.php'): 	?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Modifica</h2>
									<h2 id="sidebarInheritance" class="close">Classi base</h2>
									<h2 id="sidebarRelation" class="close">Relazioni </h2>
									<h2 id="sidebarInteraction" class="close">Interazioni </h2>
									<h2 id="sidebarAttributeMethod" class="close">Attributi e classi </h2><?
									break;
			case('unitTest.php'): ?>
									<h2 id="sidebarInsertion" class="close">Inserisci</h2>
									<h2 id="sidebarUpdate" class="close">Correla e modifica</h2><?
		}?>	
	</div><?
}
function mainList()
{?>
	<div id="mainList" class="mainListNormal"><?
	switch(basename($_SERVER['PHP_SELF']))
	{
		case('requisiti.php'): include_once('__moduleRequirementList.php');	break; 
		case('casiuso.php'):	 include_once('__moduleUsecaseList.php');	break; 
		case('attori.php'):	 include_once('__moduleActorList.php');	break; 
		case('verbali.php'):	include_once('__moduleVerbalList.php');	break; 
		case('package.php'):	 include_once('__modulePackageList.php');	break; 
		case('classi.php'):	 include_once('__moduleClassList.php');	break; 
		case('unitTest.php'):	include_once('__moduleUnitTestList.php'); break;
	}?>
	</div><?
}?>
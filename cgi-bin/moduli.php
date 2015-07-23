<?
require_once('./cgi-bin/funzioniSistema.php');


// login bar 
function modLogin(){?>
	<form id="loginForm" action="<?$_SERVER['PHP_SELF']?>" method="POST">
		<input class="data" type="text" name="utente" value="">
		<input class="data" type="password" name="password" value="">
		<input type="submit" name="loginButton" value="Login">
	</form>		<?
}

// header ( pressoché inutile :) )
function modHead(){		?>
	<a href="index.php"><h1 id="title">Trender</h1></a><?
}

// menu di pagina 
function modMenu(){	?>
	<div id="menu">
		<a class="link1" id="requisiti" href="requisiti.php">REQUISITI</a>
		<a class="link1" id="casiuso" href="casiuso.php">CDU</a>
		<a class="link1" id="attori" href="attori.php">ATTORI</a>
		<a class="link1" id="verbali" href="verbali.php">VERBALI</a>
		<a class="link1" id="package" href="package.php">PACKAGE</a>
		<a class="link1" id="classi" href="classi.php">CLASSI</a>
		<a class="link1" id="exit" href="index.php?logout=1">EXIT</a>
		<a class="link1"><button class="link1" id="backup_db">BACKUP DB</button></a>
		<a class="link1"><button class="link1" id="export">EXPORT LATEX</button></a>
		
		<script>
			$("#backup_db").on("click",function(){
				$.ajax({
					url:'./cgi-bin/__ajaxBackup.php',
					type:'post',
					cache:'false',
					dataType:'html',
					success:function(data){
						alert(data);
						notifica("Backup eseguito");	
					}
				});
			});
		</script>
		
		<script>
			$("#export").on("click",function(){
				$.ajax({
					url:'./cgi-bin/__ajaxLatex.php',
					type:'post',
					cache:'false',
					dataType:'html',
					success:function(data){
						alert(data);
						notifica("LATEX stampato");	
					}
				});
			});
		</script>
	</div><?
}



function modIndexResume(){?>
	<div id="indexResume"><?
		$k = "select * from Requisiti ";
		$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (requisiti) ".$k);
		$numR = mysqli_num_rows($q);
		$k = "select * from Requisiti where soddisfatto = 1";
		$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (requisiti) ".$k);
		$numRS = mysqli_num_rows($q);
		$perc = round(($numR/$numRS),2);
		$k = "select * from CasiUso "; 
		$q = mysqli_query(connect(),$k) or die ("MODINDEXRESUME : (usecase) ".$k);
		$numC = mysqli_num_rows($q);
		$k = "select * from Verbali ";
		$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (verbali) ".$k);
		$numV = mysqli_num_rows($q);
		$k = "select * from Attori ";
		$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (attori) ".$k);
		$numA = mysqli_num_rows($q);
		$k = "select * from Package ";
		$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (package) ".$k);
		$numP = mysqli_num_rows($q);
		$k = "select * from Classi ";
		$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (classi) ".$k);
		$numCl = mysqli_num_rows($q);?>
		<div class="resume" id="resumeRequirement">
			<h2>REQUIREMENT</h2>
			<h4>Totali : <?echo $numR;?><h4>
			<h4>Soddisfatti : <?echo $numRS;?></h4>
			<h3><?echo $perc."% DO IT! ";?></h3>
		</div>
		<div class="resume" id="resumeUsecase">
			<h2>USECASE</h2>
			<h4>Totali <?echo $numC;?></h4>
		</div>
		<div class="resume" id="resumeActor">
			<h2>ACTOR</h2>
			<h4>Totali : <?echo $numA;?></h4>
		</div>
		<div class="resume" id="resumeVerbali">
			<h2>VERBAL</h2>
			<h4>Totali : <?echo $numV;?></h4>
		</div>
		<div class="resume" id="resumePackage">
			<h2>PACKAGE</h2>
			<h4>Totali : <?echo $numP;?></h4>
		</div>
		<div class="resume" id="resumeClass">
			<h2>CLASSI</h2>
			<h4>Totali : <?echo $numCL;?></h4>
		</div>
	</div><?


}


function modInsertion() {?>
	<div id="insertion"><?
		switch(basename($_SERVER['PHP_SELF']))
		{	
			case ('requisiti.php'):?>
				<select id="requirementNewDad" name="requirementNewDad">	
					<option value="Nessuno">Nessuno</option><?
					$k = "select idR from Requisiti order by length(idR),idR";
					$q = mysqli_query(connect(),$k) or die("INSERTION : (requisiti) ".$k);
					while($v = $q->fetch_array())
					{?>
						<option value="<?echo $v[0];?>"><?echo stampaAnnidamento($v[0]);?></option><?
					}?>
				</select>
				<select id="requirementNewImportance" name="requirementNewImportance">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
				<select id="requirementNewType" name="requirementNewType">
					<option>F</option>
					<option>P</option>
					<option>Q</option>
					<option>V</option>
				</select>
				<label for="requirementNewDescription">Descrizione del requisito</label>
		    	<textarea id="requirementNewDescription"></textarea>
		    	Di capitolato <input type="checkbox" id ="requirementNewOutside">
				Interno <input type="checkbox" id="requirementNewInside">
				<button id="requirementInsertNew">Inserisci requisito</button><?
				break;

			case('casiuso.php'):?>
       			<select id="usecaseNewDad" name="usecaseNewDad">	
          			<option value="Nessuno">Nessuno</option><?
          			$k = "select idUC from CasiUso order by length(idUC),idUC";
          			$q = mysqli_query(connect(),$k) or die("MODINSERTION : (usecase) ".$k);
			          while($v = $q->fetch_array())
			          {?>
			            <option value="<?echo $v[0];?>"><?echo stampaAnnidamento($v[0]);?></option><?
			          }?>
		      	</select>
		      	Estensione <input type="checkbox" id="usecaseNewExtension">
		      	Inclusione <input type="checkbox" id="usecaseNewInclusion">
		      	Erede <input type="checkbox" id="usecaseNewHeir">
		        <table>
		        	<tr>
		        		<th>Titolo</th>
		        		<th>Descrizione</th>
		        		<th>Precondizione</th>
		        		<th>Postcondizione</th>
		        		<th>Didascalia</th>
		        	</tr>
		        	<tr>
				        <td><textarea id="usecaseNewTitle" name="usecaseNewTitle"></textarea></td>
				        <td><textarea id="usecaseNewDescription" name="usecaseNewDescription"></textarea></td>
				        <td><textarea id="usecaseNewPrecondition" name="usecaseNewPrecondition"></textarea></td>
				       	<td><textarea id="usecaseNewPostcondition" name="usecaseNewPostcondition"></textarea></td>
				       	<td><textarea id="usecaseNewNote" name="usecaseNewNote"></textarea></td>
					</tr>
				</table>
				<table>
					<tr>
						<th>Scenario</th>
						<th>Scenario Alternativo</th>
					</tr>
					<tr>
						<td><textarea id="usecaseNewScenario"></textarea></td>
						<td><textarea id="usecaseNewScenarioAlternativo"></textarea></td>
					</tr>
					<tr>
						<th colspan="2">Path immagine</th>
					</tr>
					<tr>
						<td colspan="2"><input type="text" id="usecaseNewPath"></td>
					<tr>
				</table> 
				<button id="usecaseInsertNew">Inserisci caso</button><?
				break;
					
			case('attori.php'):?>
	            Nome attore <input id="actorNewName" type="text" name="actorNewName">
	            <button id="actorInsertNew">Inserisci attore</button><?
				break;

			case('verbali.php'):?>
				Day<select id="verbaliNewDay"><?
					$i = 1; 
					while($i<=31)
					{?>	
						<option value="<?echo $i;?>"><?echo $i;?></option><?
						$i++;
					}?>
				</select> / 
				<select id="verbaliNewMonth"><?
					$i = 1; 
					while($i<=12)
					{?>
						<option value="<?echo $i;?>" ><?echo $i;?></option><?
						$i++;
					}?>
				</select>Month
				<textarea id="verbaliNewDrawingUp"></textarea>
				<button id="verbaliInsertNew">Inserisci verbale</button><?
				break;
			case('package.php'):?>
				Padre <select id="packageNewDad">
					<option value="">Nessuno</option><?
					$k = "select * from Package order by length(titolo),titolo";
					$q = mysqli_query(connect(),$k) or die("INSERTION : (package)");
					while($v = $q->fetch_array())
					{?>
						<option value="<?echo $v[0];?>" ><?echo $v[0];?></option><?
					}?>
				</select>::
				<input type="text" id="packageNewTitle"><? echo $v[0];?></input>
				<span>Nuovo path</span>
				<input type="text" id="packageNewImage"><? echo mysqli_real_escape_string(connect(),$v[1]);?></input>
				<table>
					<tr>
						<th>Descrizione</th>
					</tr>
					<tr>
						<td><textarea id="packageNewDescription"><? echo mysqli_real_escape_string(connect(),$v[2]);?></textarea></td>
					</tr>
				</table>
				<button id="packageInsertNew">Inserisci package</button><?
				break;
			case('classi.php'):?>
				Package:
				<select id="classNewPackage"><?
					$k = "select * from Package order by length(titolo),titolo";
					$q = mysqli_query(connect(),$k) or die("INSERTION (class)");
					while($v = $q->fetch_array())
					{?>
						<option id="<?echo $v[0];?>"><?echo $v[0];?></option><?
					}?>
				</select>
				Name <input type="text" id="classNewTitle">
				<table>
					<tr>
						<th>Descrizione</th>
						<th>Utilizzo</th>
					</tr>
					<tr>
						<td><textarea id="classNewDescription"></textarea></td>
						<td><textarea id="classNewUse"></textarea></td>
					</tr>
				</table>
				<button id="classInsertNew">Inserisci classe</button><?
				break;
		}?>	
	</div><?
}


function modDetails()
{ 
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		if(esiste($id))
		{?>

			<div id="details"><?
				switch(basename($_SERVER['PHP_SELF']))
				{
					case('requisiti.php'):?>
						<div id="detailsRequirementUpdate">
							<h6 id="idToUpdate"><?echo $id;?></h6><?
							$k = "select * from Requisiti where idR = '$id'";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (requisiti) ".$k);
							$v = $q->fetch_array();?>
							<textarea id="requirementDescriptionUpToDate"><?echo $v[2];?></textarea>
							<input type="checkbox" id="requirementOutsideUpToDate" <?if($v[3]) echo "checked=check";?> >Capitolato</input>
							<input type="checkbox" id="requirementInsideUpToDate" <?if($v[5]) echo "checked=check";?> >Interno</input>
							<input type="checkbox" id="requirementSatisfiedUpToDate" <?if($v[6]) echo "checked=check";?> >Soddisfatto ?</input>
							<button id="requirementUpdate">Salva</button>
						</div>
						<table id="detailsRequirementChild">
							<tr>
								<td colspan="2">Figli</td>
							</tr><?
							$k = "select * from Requisiti where padre = '$id' order by length(idR)";
							$q = mysqli_query(connect(),$k) or die("MODUDPATE : (requisiti) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="requirementDeleteChild">-</button></td>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsRequirementUseCase">
							<tr>
								<td colspan="3">Casi associati
									<select id="requirementUsecase"><?
										$k = "select idUC from CasiUso where idUC not in ( select idUC from RequisitiCasiUso where idR = '$id') ";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (requisiti) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo stampaAnnidamento($v[0]);?></option><?
										}?>
									</select>
									<button id="requirementUsecaseAdd">+</button>
								</td>
							<tr><?
							$k = "select * from CasiUso where idUC in ( select idUC from RequisitiCasiUso where idR = '$id' ) ";
							$q = mysqli_query(connect(),$k) or die ("MODUPDATE : (requisiti) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="requirementUsecaseDelete">-</button></td>
									<td><?echo $v[0];?></td>
									<td><?echo $v[2];?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsRequirementVerbali">
							<tr>
								<td colspan="2">Verbali associati
									<select id="requirementVerbali"><?
										$k = "select data from Verbali where data not in ( select idV from RequisitiVerbali where idR = '$id' ) ";
										$q = mysqli_query(connect(),$k) or die ("MODUPDATE : (requisiti) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="requirementVerbaliAdd">+</button>
								</td>
							</tr><?
							$k = "select idV from RequisitiVerbali where idR = '$id' ";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (requisiti) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="requirementVerbaliDelete">-</button></td>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table><?
						break;

					case('casiuso.php'):?>
						<div id="detailsUsecaseUpdate">
							<h6 id="idToUpdate"><?echo $id;?></h6><?
							$k = "select * from CasiUso where idUC = '$id' ";
							$q = mysqli_query(connect(),$k) or die ("MODUPDATE : (usecase) ".$k);
							$v = $q->fetch_array();?>
							Estensione<input type="checkbox" id="usecaseExtensionUpToDate" <?if($v[4]) echo "checked=check";?> >
							Inclusione<input type="checkbox" id="usecaseInclusionUpToDate" <?if($v[5]) echo "checked=check";?> >
							Erede<input type="checkbox" id="usecaseHeirUpToDate" <?if($v[6]) echo "checked=check";?> >
							<table>
								<tr>
									<th>Titolo</th>
									<th>Descrizione</th>
									<th>Precondizioni</th>
									<th>Postcondizioni</th>
									<th>Didascalia</th>
								</tr>
								<tr>
									<td><textarea id="usecaseTitleUpToDate"><?echo $v[2];?></textarea></td>
									<td><textarea id="usecaseDescriptionUpToDate"><?echo $v[3];?></textarea></td>
									<td><textarea id="usecasePreconditionUpToDate"><?echo $v[7];?></textarea></td>
									<td><textarea id="usecasePostconditionUpToDate"><?echo $v[8];?></textarea></td>
									<td><textarea id="usecaseNoteUpToDate"><?echo $v[10];?></textarea></td>
								</tr>
							</table>
							<table>
								<tr>
									<th>Scenario</th>
									<th>Scenario Alternativo</th>
								</tr>
								<tr>
									<td><textarea id="usecaseScenarioUpToDate"><? echo $v[11];?></textarea></td>
									<td><textarea id="usecaseScenarioAlternativoUpToDate"><? echo $v[12];?></textarea></td>
								</tr>
								<tr>
									<th colspan="2">Path immagine</th>
								</tr>
								<tr>
									<td colspan="2"><input type="text" id="usecasePathUpToDate" value="<?echo $v[9];?>"></td>
								<tr>
							</table> 
							<button id="usecaseUpdate">Salva</button>
						</div>
						<table id="detailsUsecaseChild">
							<tr>
								<td colspan="2">Figli</td>
							<tr><?
							$k = "select * from CasiUso where padre = '$id' ORDER BY LENGTH(idUC)";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="usecaseDeleteChild">-</button></td>
									<td><? echo $v[0]; ?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsUsecaseActor">
							<tr>
								<td colspan="2">Attori associati
									<select id="usecaseActor"><?
										$k = "select idA from Attori where idA not in ( select idA from AttoriCasiUso where idUC = '$id' ) "; 
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									<select>
									<button id="usecaseActorAdd">+</button>
								<td>
							</tr><?
							$k = "select idA from AttoriCasiUso where idUC = '$id' ";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="usecaseActorDelete">-</button></td>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsUsecaseVerbali">
							<tr>
								<td>Verbali associati
									<select id="usecaseVerbali"><?
										$k = "select data from Verbali where data not in ( select idV from CasiUsoVerbali where idUC = '$id' ) ";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="usecaseVerbaliAdd">+</button>
								</td>
							</tr><?
							$k = "select idV from CasiUsoVerbali where idUC = '$id' ";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="usecaseVerbaliDelete">-</button>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsUsecaseRequirement">
							<tr>
								<td colspan="2">Requisiti associati
									<select id="usecaseRequirement"><?
										$k = "select * from Requisiti where idR not in ( select idR from RequisitiCasiUso where idUC = '$id' ) ";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="usecaseRequirementAdd">+</button>
								</td>
							</tr><?
							$k = "select idR from RequisitiCasiUso where idUC = '$id' ";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="usecaseRequirementDelete">-</button></td>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table><?
						break;


					case('verbali.php'):?>
						<div id="detailsVerbaliUpdate">
							<h6 id="idToUpdate"><?echo $id;?></h6><?
							$k = "select * from Verbali where data = '$id' ";
							$q = mysqli_query(connect(),$k)or die("MODUPDATE : (verbali) ".$k);
							$v = $q->fetch_array();?>
							<textarea id="verbaliDrawingUpToDate"><?echo $v[1];?></textarea>
							<button id="verbaliUpdate">Salva</button>
						</div>
						<table id="detailsVerbaliRequirement">
							<tr>
								<td colspan="2">Requisiti associati
									<select id="verbaliRequirement"><?
										$k = "select idR from Requisiti where idR not in ( select idR from RequisitiVerbali where idV = '$id') ";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (verbali) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="verbaliRequirementAdd">+</button>
								</td>
							</tr><?
							$k = "select idR from RequisitiVerbali where idV = '$id' ";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (verbali) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>	
									<td><button class="verbaliRequirementDelete">-</button></td>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsVerbaliUsecase">
							<tr>
								<td colspan="3">Casi associati
									<select id="verbaliUsecase"><?
										$k = "select idUC from CasiUso where idUC not in ( select idUC from CasiUsoVerbali where idV = '$id')";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (verbali) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="verbaliUsecaseAdd">+</button>
								</td>
							</tr><?
							$k = "select * from CasiUsoVerbali where idV = '$id' ";
							$q = mysqli_query(connect(),$k) or die ("MODUDPATE : (verbali) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="verbaliUsecaseDelete">-</button></td>
									<td><?echo $v[0];?></td>
									<td><?echo $v[1];?></td>
								</tr><?
							}?>
						</table><?
						break;

					case('attori.php'):?>
						<div id="detailsActorUpdate">
							<h6 id="idToUpdate"><?echo $id;?></h6>
							<input  id="actorIdUpToDate" type="text" value="<?echo $id;?>">
							<button id="actorUpdate">Salva</button>
						</div>
						<table id="detailsActorUsecase">
							<tr>
								<td colspan="3">Casi associati
									<select id="actorUsecase"><?
										$k = "select idUC from CasiUso where idUC not in ( select idUC from AttoriCasiUso where idA = '$id' ) "; 
										$q = mysqli_query(connect(),$k) or die("MODUDPATE : (actor) ".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="actorUsecaseAdd">+</button>
								</td>
							</tr><?
							$k = "select * from CasiUso where idUC in ( select idUC from AttoriCasiUso where idA = '$id' )";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (actor) ".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="actorUsecaseDelete">-</button></td>
									<td><?echo $v[0];?></td>
									<td><?echo $v[2];?></td>
								</tr><?
							}?>
						</table><?
						break;
					case('package.php'):?>
						<div id="detailsPackageUpdate">
							<h6 id="idToUpdate"><?echo $id;?></h6><?
							$k = "select * from Package where titolo = '$id'";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (package) ".$k);
							$v = $q->fetch_array();?>
							<input id="packageIdUpToDate" type="text" value="<?echo $id;?>">
							<span id="packageImageUpToDate">New image path</span>
							<input type="text" id="packageImageUpToDate" value="<?echo mysqli_real_escape_string(connect(),$v[1]);?>">
							<table>
								<tr>
									<th>Descrizione</th>
								</tr>	
								<tr>
									<td><textarea id="packageDescriptionUpToDate"><? echo mysqli_real_escape_string(connect(),$v[2]);?></textarea></td>
								</tr>
							</table>
							<button id="packageUpdate">Salva</button>
						</div>
						<table id="detailsPackageRequirement">
							<tr>
								<td colspan="2">
									Associa requisito
									<select id="packageRequirement"><?
										$k = "select idR from Requisiti where idR not in ( select idR from PackageRequirement where idP = '$id')";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (package)".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="packageRequirementAdd">+</button>
								</td>
							</tr><?
							$k = "select idR from PackageRequirement where idP = '$id'";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (package)".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="packageRequirementDelete">-</button>
									<td><?echo $v[0];?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsPackageInteractions">
							<tr>
								<td colspan="4">
									Interazione con 
									<select id="packageInteractions"><?
										$k = "select titolo from Package where titolo != '$id' and titolo not in ( select packageB from PackageInteractions where packageA = '$id') order by length(titolo),titolo ";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (packageInteractions)".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<p>Descrizione interazione</p>
									<textarea id="packageInteractionsInteraction"></textarea>
									<button id="packageInteractionsAdd">+</button>
								</td>
							</tr><?
							$k = "select * from PackageInteractions where packageA = '$id' ";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (packageInteractions)".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="packageInteractionsDelete">-</button></td>
									<td><?echo $v[1];?></td>
									<td><textarea class="packageInteractionsUpToDate"><?echo mysqli_real_escape_string(connect(),$v[2]);?></textarea></td>
									<td><button class="packageInteractionsUpdate">Save</button></td>
								</tr><?
							}?>
						</table><?
						break;


					case('classi.php'):?>
						<div id="detailsClassUpdate">
							<h6 id="idToUpdate"><?echo $id;?></h6>
							<input id="classIdUpToDate" type="text" value="<?echo $id;?>">
							<table>
								<tr>
									<th>Descrizione</th>
									<th>Uso</th>
								</tr>	
								<tr>
									<td><textarea id="classDescriptionUpToDate"></textarea></td>
									<td><textarea id="classUseUpToDate"></textarea></td>
								</tr>
							</table>
							<button id="classUpdate">Salva</button>
						</div>
						<table id="detailsClassRelactions">
							<tr>
								<td colspan="3">
									Relazione 
									<input id="classRelactionsIn" type="checkbox" value="entrante">IN
									<input id="classRelactionsOut" type="checkbox" value="uscente">OUT
									<select id="classRelactions"><?
									$k = "select titolo from Classi where titolo != '$id' and titolo not in ( select classB from ClassRelactions where classA = '$id') order by length(titolo),titolo";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (classRelations)(0)".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="classRelactionsAdd">+</button>
								</td>
							</tr><?
							$k = "select classB,uscente from ClassRelactions where classB in ( select classB from ClassRelactions where classA = '$id') order by length(classB),classB";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE : (classRelaction)(1)".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="classRelactionDelete">-</button></td>
									<td><?echo $v[0];?></td>
									<td><?if($v[1] == 0) echo "<button class='classRelactionChangetype'>IN</button>";
										  else echo "<button class='classRelactionChangetype'>OUT</button>";?></td>
								</tr><?
							}?>
						</table>
						<table id="detailsClassInteractions">
							<tr>
								<td colspan="4">
									Interazione con 
									<select id="classInteractionsNewClass"><?
										$k = "select * from Classi where titolo != '$id' and titolo not in (select classB from ClassInteractions where classA = '$id' ) order by length(titolo),titolo";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE : (detailsClassInteractions)".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
										}?>
									</select>
									<button id="classInteractionsAdd">+</button>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<textarea id="classInteractionsNewInteraction"></textarea>
								</td>
							</tr><?
							$k = "select classB,interazione from ClassInteractions where classA = '$id'";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE: (detailsClassInteractions)".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="classInteractionsDelete">-</button></td>
									<td><? echo $v[0];?></td>
									<td><textarea class="classInteractionsInteractionUpToDate"><? echo $v[1];?></textarea></td>
									<td><button class="classInteractionUpdate">save</button></td>
								</tr><?
							}?>
						</table>
						<table id="detailsClassInheritance">
							<tr>
								<td colspan="2">
									Estende 
									<select id="classInheritanceNewClass"><?
										$k = "select titolo from Classi where titolo not in (select super from Inheritance where sub = '$id') and titolo != '$id'";
										$q = mysqli_query(connect(),$k) or die("MODUPDATE: (detailsClassInheritance)".$k);
										while($v = $q->fetch_array())
										{?>
											<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?

										}?>
									</select>
									<button id="classInheritanceAdd">+</button>
								</td>
							</tr><?
							$k = "select * from Inheritance where sub = '$id'";
							$q = mysqli_query(connect(),$k) or die("MODUPDATE: (detailsClasInheritanceList)".$k);
							while($v = $q->fetch_array())
							{?>
								<tr>
									<td><button class="classInheritanceDelete">-</button></td>
									<td><? echo $v[0]; ?></td>
								</tr><?
							}?>
						</table><?
						break;
				}?>
			</div><?
		}
	}
}


function modListRecursive($id)
{
	switch(basename($_SERVER['PHP_SELF']))
	{
		case('requisiti.php'):
			$k = "select * from Requisiti where padre = '$id' order by length(idR),idR";
			$q = mysqli_query(connect(),$k) or die("MODLISTRECURSIVE : (requirement) ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr>
					<td><button class="deleteRequirement">-</button></td>
					<td><button class="chooseAsDad">+</button></td>
					<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?echo stampaAnnidamento($v[0]);?></a></td>
					<td><a href="<?echo 'requisiti.php?id='.$v[1];?>"><?echo stampaAnnidamento($v[1]);?></a></td>
					<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
					<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?echo $v[4];?></a></td>
					<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?if($v[3]) echo "SI"; else echo "-";?></a></td>
					<td><?if($v[5]) echo "SI"; else echo "-";?></td>
					<td><?if($v[6]) echo "SI"; else echo "-";?></td>
				</tr><?
				modListRecursive($v[0]);
			}
			break;
		case('casiuso.php'):
			$k = "select * from CasiUso where padre = '$id' order by length(idUC),idUC";
			$q = mysqli_query(connect(),$k)or die("STAMPACASO: (0) Err stampa ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr>
					<td><button class="deleteUsecase">-</button></td>
					<td><button class="chooseAsDad">+</button></td>
					<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo stampaAnnidamento($v[0]);?></a></td>
					<td><a href="<?echo 'casiuso.php?id='.$v[1];?>"><?echo stampaAnnidamento($v[1]);?></a></td>
					<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
					<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[3];?></a></td>
					<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[7];?></a></td>
					<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[8];?></a></td>
					<td><?if($v[4]) echo "SI"; else echo "-";?></td>
					<td><?if($v[5]) echo "SI"; else echo "-";?></td>
					<td><?if($v[6]) echo "SI"; else echo "-";?></td>
				</tr><?
				modListRecursive($v[0]);
			}
			break;
		case('package.php'):
			$k = "select titolo,descrizione from Package where padre = '$id' order by length(titolo),titolo";
			$q = mysqli_query(connect(),$k) or die("STAMPAPACKAGE (0) ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr>
					<td><button class="deletePackage">-</button></td>
					<td><button class="chooseAdDad">+</button></td>
					<td><a href="<?echo 'package.php?id='.$v[0];?>"><?echo $v[0];?></a></td>
					<td><a href="<?echo 'package.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
					<td><a href="<?echo 'package.php?id='.$v[0];?>"><?echo $v[3];?></a></td>
				</tr><?
				modLisRecursive($v[0]);
			}
		break;
	}
}


function modList()
{
	switch(basename($_SERVER['PHP_SELF']))
	{
		case('requisiti.php'):?>
			<table id="listRequirement">
				<th>X</th>
				<th>+</th>
				<th>REQUISITO</th>
				<th>PADRE</th>
				<th>DESCRIZIONE</th>
				<th>VERBALE</th>
				<th>CAPITOLATO</th>
				<th>INTERNO</th>
				<th>SODDISFATTO</th><?
				$k = "select * from Requisiti where padre is NULL ORDER BY substring(idR,2,1),substring(idR,3,1),length(idR),idR";
				$q = mysqli_query(connect(),$k)or die("MODLIST : (requirement) ".$k);
				while($v = $q->fetch_array())
				{?>
					<tr>
						<td><button class="deleteRequirement">-</button></td>
						<td><button class="chooseAsDad">+</button></td>
						<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?echo stampaAnnidamento($v[0]);?></a></td>
						<td><a href="<?echo 'requisiti.php?id='.$v[1];?>"><?echo stampaAnnidamento($v[1]);?></a></td>
						<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
						<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?echo $v[4];?></a></td>
						<td><a href="<?echo 'requisiti.php?id='.$v[0];?>"><?if($v[3]) echo "SI"; else echo "-";?></a></td>
						<td><?if($v[5]) echo "SI"; else echo "-";?></td>
						<td><?if($v[6]) echo "SI"; else echo "-";?></td>
					</tr><?	
					modListRecursive($v[0]);	
				}	
				break; 

		case('casiuso.php');?>
			<table id="listUsecase">
				<tr>
					<th>X</th>
					<th>+</th>
					<th>CASO</th>
					<th>PADRE</th>
					<th>TITOLO</th>
					<th>DESCRIZIONE</th>
					<th>PRECONDIZIONE</th>
					<th>POSTCONDIZIONE</th>
					<th>EST</th>
					<th>INC</th>
					<th>ERE</th>
				</tr><?
				$k = "select * from CasiUso where padre is NULL ORDER BY length(idUC),idUC";
				$q = mysqli_query(connect(), $k) or die("MODLIST : (usecase) ".$k);
				while($v = $q->fetch_array())
				{?>
					<tr>
						<td><button class="deleteUsecase">-</button></td>
						<td><button class="chooseAsDad">+</button></td>
						<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo stampaAnnidamento($v[0]);?></a></td>
						<td><a href="<?echo 'casiuso.php?id='.$v[1];?>"><?echo stampaAnnidamento($v[1]);?></a></td>
						<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
						<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[3];?></a></td>
						<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[7];?></a></td>
						<td><a href="<?echo 'casiuso.php?id='.$v[0];?>"><?echo $v[8];?></a></td>
						<td><?if($v[4]) echo "SI"; else echo "-";?></td>
						<td><?if($v[5]) echo "SI"; else echo "-";?></td>
						<td><?if($v[6]) echo "SI"; else echo "-";?></td>
					</tr><?
					modListRecursive($v[0]);
				} 

				break;
		case('attori.php'):?>
			<table id="listActor">
				<tr>
					<th>X</th>
					<th>NOME ATTORE</th>
				</tr><?
				$k = "select idA from Attori order by idA";
				$q = mysqli_query(connect(),$k) or die("MODLIST : (attori) ".$k);
				while($v = $q->fetch_array())
				{?>
					<tr>
						<td><button class="deleteActor">-</button></td>
						<td><a href="<?echo 'attori.php?id='.$v[0];?>"><?echo $v[0];?></a></td>
					<tr><?
				}
			break;
		case('verbali.php'):?>
			<table id="listVerbali">
				<tr>
					<th>X</th>
					<th>DATA</th>
					<th>STESURA</th>
				</tr><?
				$k = "select * from Verbali";
				$q = mysqli_query(connect(),$k) or die("MODLIST : (verbali) ".$k);
				while($v = $q->fetch_array())
				{?>
					<tr>
						<td><button class="deleteVerbale">-</button></td>
						<td><a href="<?echo 'verbali.php?id='.mysqli_real_escape_string(connect(),$v[0]);?>"><?echo $v[0];?></a></td>
						<td><a href="<?echo 'verbali.php?id='.mysqli_real_escape_string(connect(),$v[0]);?>"><?if(strlen($v[1])>100) echo substr($v[1],0,100); else echo $v[1];?></td>
					</tr><?
				}
				break;
		case('package.php'):?>
			<table id="listPackage">
				<tr>	
					<th>X</th>
					<th>+</th>
					<th>Title</th>
					<th>Father</th>
					<th>Description</th>
				</tr><?
				$k = "select * from Package where padre is NULL";
				$q = mysqli_query(connect(),$k) or die ("MODLIST : (package)".$k);
				while($v = $q->fetch_array())
				{?>
					<tr>
						<td><button class="deletePackage">-</button></td>
						<td><button class="chooseAdDad">+</button></td>
						<td><a href="<?echo 'package.php?id='.$v[0];?>"><?echo $v[0];?></a></td>
						<td><a href="<?echo 'package.php?id='.$v[0];?>"><?echo $v[3];?></a></td>
						<td><a href="<?echo 'package.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
					</tr><?
					modListRecursive($v[0]);
				}
				break; 
		case('classi.php'):?>	
			<table id="listClass">
				<tr>
					<th>X</th>
					<th>Title</th>
					<th>Description</th>
					<th>Use</th>
					<th>Package</th>
				</tr><?
				$k = "select * from Classi order by length(idP),idP";
				$q = mysqli_query(connect(),$k) or die("MODLIST : (class)".$k);
				while($v = $q->fetch_array())
				{?>
					<tr>
						<td><button class="deleteClass">-</button></td>
						<td><a href="<?echo 'classi.php?id='.$v[0];?>"><?echo $v[0];?></a></td>
						<td><a href="<?echo 'classi.php?id='.$v[0];?>"><?echo $v[1];?></a></td>
						<td><a href="<?echo 'classi.php?id='.$v[0];?>"><?echo $v[2];?></a></td>
						<td><a href="<?echo 'classi.php?id='.$v[0];?>"><?echo $v[3];?></a></td>
					</tr><?
				}
				break; 
	}?>
	</table><?
}?>
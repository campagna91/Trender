<? 
require_once('__system.php');
if(isset($_POST['id']))
{	
	$id = $_POST['id'];?>
	<div id="moduleAttributeMethod">

		<!-- inserimento nuovo attributo -->
		<input type="text" id="moduleAttributeMethodNewAttribute" placeholder="Nome attributo">
		<select class="type" id="moduleAttributeMethodTypeAttribute">

			<!-- tipo attributo -->
			<option value="int">int</option>
			<option value="string">string</option>
			<option value="object">object</option>
			<option value="object[]">object[]</option><?
			$qType = mysqli_query(connect(), "select titolo from Classi")or die("errore selezione classi tipo");
			while($vType = $qType->fetch_array())
			{?>
				<option value="<?echo $vType[0];?>"><?echo $vType[0];?></option>
				<option value="<?echo $vType[0].'[]';?>"><?echo $vType[0]."[]";?></option><?
			}?>
		</select>
		<textarea id="moduleAttributeMethodDescriptionAttribute" placeholder="Descrizione attributo"></textarea>
		<button id="moduleAttributeMethodInsertAttribute" class="actionInsert">Add attribute</button>

		<!-- listato attributi -->
		<ul id="moduleAttributeMethodListAttribute"><?
			$qA = mysqli_query(connect(), "select attribute, type, description from ClassAttribute where class = '$id' ")or die("error select attribute type ");
			while($vA = $qA->fetch_array())
			{?>
				<li class="attribute">
					<span><?echo $vA[0]." : ".$vA[1];?></span>
					<button class="moduleAttributeMethodDeleteAttribute actionDelete">Elimina</button>
					<button class="moduleAttributeMethodUpdateAttribute actionUpdate">Update</button>
					<textarea class="description"><?echo $vA[2];?></textarea>
				</li><?
			}?>
		</ul>


		<!-- inserimento nuovo metodo -->
		<input type="text" id="moduleAttributeMethodNameMethod" placeholder="Nome metodo">
		<select class="type" id="moduleAttributeMethodReturnType">

			<!-- valori valori di ritorno-->
			<option value="int">int</option>
			<option value="string">string</option>
			<option value="object">object</option>
			<option value="object[]">object[]</option>
			<option value="void">void</option><?
			$qType = mysqli_query(connect(), "select titolo from Classi");
			while($vType = $qType->fetch_array())
			{?>
				<option value="<?echo $vType[0];?>"><?echo $vType[0];?></option>
				<option value="<?echo $vType[0].'[]';?>"><?echo $vType[0]."[]";?></option><?
			}?>
		</select>
		<textarea id="moduleAttributeMethodDescriptionMethod" placeholder="Descrizione del metodo"></textarea>
		<button id="moduleAttributeMethodAddParam" class="actionInsert">Add param</button>
		
		<!-- lista dei nuovi parametri -->
		<ul id="moduleAttributeMethodListNewParams"></ul>

		<!-- inserimento metodo -->
		<button id="moduleAttributeMethodInsertMethod" class="actionInsert">Add Method</button>

		<!-- listato methodi -->
		<ul id="moduleAttributeMethodListMethod"><?
		$qM = mysqli_query(connect(), "select signature,returnType,params,description from ClassMethod where class = '$id' ")or die("err");
		while($vM = $qM->fetch_array())
		{?>

			<!-- stampa del metodo -->
			<ul class="<?echo $vM[0];?>">

				<!-- modificatori -->
				<button class="moduleAttributeMethodUpdateMethod actionUpdate">Aggiorna</button>
				<button class="moduleAttributeMethodDeleteMethod actionDelete">Elimina</button>
				<button class="moduleAttributeMethodAddParamToMethod actionInsert">Add param</button>

				<!-- tipo di ritorno -->
				<select class="type">

						<!-- valori valori di ritorno-->
						<option value="int" <?if('int' == $vM[1]) echo "selected='selected'";?> >int</option>
							<option value="string" <?if('string' == $vM[1]) echo "selected='selected'";?> >string</option>
							<option value="object" <?if('object' == $vM[1]) echo "selected='selected'";?> >object</option>
							<option value="object[]" <?if('object[]' == $vM[1]) echo "selected='selected'";?> >object[]</option>
							<option value="void" <?if('void' == $vM[1]) echo "selected='selected'";?> >void</option><?
						$qType = mysqli_query(connect(), "select titolo from Classi");
						while($vType = $qType->fetch_array())
						{?>
							<option value="<?echo $vType[0];?>" <?if($vType[0] == $vM[1]) echo "selected='selected'";?>><?echo $vType[0];?></option>
							<option value="<?echo $vType[0].'[]';?>" <? $array = $vType[0]."[]"; if($array == $vM[1]) echo "selected='selected'";?>><?echo $vType[0]."[]";?></option><?
						}?>
				</select>

				<!-- nome del metodo -->
				<span><?echo $vM[0];?></span>

				<!-- descrizione del metodo -->
				<textarea class="description"><? echo $vM[3];?></textarea>

				<!-- lista dei parametri del metodo --><?
				if($vM[2] != '')
				{
					$params = split(";",$vM[2]);
					$i = 0;
					while($i < count($params)-1)
					{
						$param = split(":",$params[$i]);?>
						<li class="param">

							<!-- modificatori parametro -->
							<button class="moduleAttributeMethodDeleteParam actionDelete">Elimina</button>

							<!-- tipo del parametro -->
							<select class="type">

								<!-- valori valori di ritorno-->
								<option value="int" <?if('int' == $param[1]) echo "selected='selected'";?> >int</option>
								<option value="string" <?if('string' == $param[1]) echo "selected='selected'";?> >string</option>
								<option value="object" <?if('object' == $param[1]) echo "selected='selected'";?> >object</option>
								<option value="object[]" <?if('object[]' == $param[1]) echo "selected='selected'";?> >object[]</option><?
								$qType = mysqli_query(connect(), "select titolo from Classi");
								while($vType = $qType->fetch_array())
								{?>
									<option value="<?echo $vType[0];?>" <?if($vType[0] == $param[1]) echo "selected='selected'";?> ><?echo $vType[0];?></option>
									<option value="<?echo $vType[0].'[]';?>" <? $array = $vType[0]."[]"; if($array == $params[1]) echo "selected='selected'";?> ><?echo $vType[0]."[]";?></option><?
								}?>
							</select>

							<!-- descrizione parametro -->
							<input type="text" class="description" value="<?echo $param[2];?>">
							
							<!-- nome parametro  -->
							<input type="text" class="nameParam" value="<?echo $param[0];?>">

						</li><?
						$i++;
					}
				}?>
			</ul><?	
		}?>
		</ul>
	</div><?
}
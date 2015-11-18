<?
	$kActive = "select * from Settings_prints";
?>
<h3>Prints</h3>
<p>Here you can configure prints</p>

<!-- Requirements Analysis -->
<div class="row blue-grey darken-1">
	<h5>AR</h5>

	<h6>Requirements</h6>

		<!-- Functional requirements -->
		<span>
		  <input type="checkbox" class="filled-in" id="arFunctionalRequirement"/>
		  <label for="arFunctionalRequirement">Functional</label>
		</span>

		<!-- Qualitative requirements -->
		<span>
		  <input type="checkbox" class="filled-in" id="arQualitativeRequirement"/>
		  <label for="arQualitativeRequirement">Qualitative</label>
		</span>

		<!-- Binding requirements -->
		<span>
			  <input type="checkbox" class="filled-in" id="arBindingRequirement"/>
			  <label for="arBindingRequirement">Binding</label>
		</span>


		<!-- Performance requirements -->
		<span>
		  <input type="checkbox" class="filled-in" id="arPerformanceRequirement"/>
		  <label for="arPerformanceRequirement">Performance</label>
		</span>

		<!-- Requirements resume -->
		<span>
		  <input type="checkbox" class="filled-in" id="arResume"/>
		  <label for="arResume">Resume</label>
		</span>

	<h6>Usecases</h6>

		<!-- Usecase -->
		<span>
		  <input type="checkbox" class="filled-in" id="arUsecase"/>
		  <label for="arUsecase">Usecase</label>
		</span>

	<h6>Tracking</h6>

		<div class="row blue-grey darken-2">

			<!-- Requirements - Sources -->
			<span>
				<input type="checkbox" class="filled-in" id="arTrackingRequirementSource"/>
			  	<label for="arTrackingRequirementSource">Requirements-Sources</label>
			</span>

			<!-- Sources - Requirements -->
			<span>
				<input type="checkbox" class="filled-in" id="arTrackingSourceRequirement"/>
			  	<label for="arTrackingSourceRequirement">Sources-Requirements</label>
			</span>

	<h6>Satisfied Requirements</h6>

		<!-- Obbligatory satisfaction -->
		<span>
			<input type="checkbox" class="filled-in" id="arSatisfiedObbligatory"/>
		  	<label for="arSatisfiedObbligatory">Obbligatory</label>
		</span>

		<!-- Desiderable satisfaction -->
		<span>
			<input type="checkbox" class="filled-in" id="arSatisfiedDesiderable"/>
		  	<label for="arSatisfiedDesiderable">Desiderable</label>
		</span>

		<!-- Optional satisfaction -->
		<span>
			<input type="checkbox" class="filled-in" id="arSatisfiedOptional"/>
		  	<label for="arSatisfiedOptional">Optional</label>
		</span>

	<h6>Test</h6>

		<!-- Requirement - System test - Validation test -->
		<span>
			<input type="checkbox" class="filled-in" id="arTrackingRequirementTestValidationSystem"/>
	  	<label for="arTrackingRequirementTestValidationSystem">Requirement - System test - Validation test</label>
		</span>

</div>

<!-- Qualitative Plan -->
<div class="row blue-grey darken-1">
	<h5>PQ</h5>

	<h6>Test</h6>

		<!-- Validation Test -->
		<span>
			<input type="checkbox" class="filled-in" id="pqTestValidation"/>
		  <label for="pqTestValidation">Validation test</label>
		</span>

		<!-- System Test -->
		<span>
			<input type="checkbox" class="filled-in" id="pqTestSystem"/>
	  	<label for="pqTestSystem">System test</label>
		</span>

		<!-- Integration test -->
		<span>
			<input type="checkbox" class="filled-in" id="pqTestIntegration"/>
		  <label for="pqTestIntegration">Integration test</label>
		</span>

		<!-- Unit test -->
		<span>
			<input type="checkbox" class="filled-in" id="pqTestUnit"/>
		  <label for="pqTestUnit">Unit test</label>
		</span>

	<h6>Tracking</h6>

		<!-- Component - Test -->
		<span>
			<input type="checkbox" class="filled-in" id="pqTrackingComponentTest"/>
		  <label for="pqTrackingComponentTest">Component-Test</label>
		</span>

		<!-- Test - Class methods -->
		<span>
			<input type="checkbox" class="filled-in" id="pqTrackingClassMethodTest"/>
	  	<label for="pqTrackingClassMethodTest">Test-Class methods</label>
		</span>

	<h6>Design</h6>

		<!-- Instability level -->
		<span>
			<input type="checkbox" class="filled-in" id="pqDesignInstability"/>
	  	<label for="pqDesignInstability">Instability level</label>
		</span>

	<h6>Metrics satisfiement</h6>

		<!-- Metrics satisfiement -->
		<span>
			<input type="checkbox" class="filled-in" id="pqMetricsSatisfiement"/>
		  	<label for="pqMetricsSatisfiement">Metrics satisfiement</label>
		</span>

	<h6>Code</h6>

		<!-- Code coverage -->
		<span>
			<input type="checkbox" class="filled-in" id="pqCodeCoverage"/>
	  	<label for="pqCodeCoverage">Code coverage</label>
		</span>

</div>
<div class="row blue-grey darken-1">
	<h5>ST / DP</h5>

	<h6>Tracking</h6>

		<!-- Class - Requirements -->
		<span>
			<input type="checkbox" class="filled-in" id="stTrackingClassRequirement"/>
	  	<label for="stTrackingClassRequirement">Class-Requirements</label>
		</span>

		<!-- Requirement - Class -->
		<span>
			<input type="checkbox" class="filled-in" id="stTrackingRequirementClass"/>
	  	<label for="stTrackingRequirementClass">Requirement-Class</label>
		</span>

</div>
<div class="row blue-grey darken-1">
	<h5>DP</h5>

	<h6>Document parts</h6>
	
		<!-- Package and derivated (class, methods, class-class, etc) -->
		<span>
			<input type="checkbox" class="filled-in" id="dpPackage"/>
	  	<label for="dpPackage">Package and derived</label>
		</span>

</div>

<div class="row blue-grey darken-1">
	<h5>GLOSSARY</h5>

	<h6>Voices</h6>

		<!-- Voices -->
		<span>
			<input type="checkbox" class="filled-in" id="glVoices"/>
	  	<label for="glVoices">Glossary voices</label>
		</span>

</div>

<a id="settingPrintSave" class="col s4 offset-s1 waves-effect waves-light btn-large">Save setting</a>
<a id="settingPrintRun" class="col s4 offset-s1 waves-effect waves-light btn-large">Print All!!</a>


<?
	$actives = [];
	$q = mysqli_query(connect(), $kActive) or die("ERRORE: " .$kActive);
	while($v = $q->fetch_array()) {
		array_push($actives, $v);
	}
	foreach($actives as $key => $val) { ?>
		<script>
			function select(id, value) {
				if(value == 1)
					$("#" + id).prop('checked','checked');
			}
			select(<? echo json_encode($actives[$key]['voice'])	?>, <? echo json_encode($actives[$key]['active'])	?>);
		</script>
	<? }
?>

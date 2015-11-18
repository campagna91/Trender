<div class="row">
	<div class="col s10 offset-s1 blue-grey">
		<div class="col s12" id="unitTestMethodUpdate">
			<h3>Methods</h3>

			<!-- Package -->
			<div class="input-field col s4 validate">
				<select id="unitTestPackage">
					<option value="">Select a package</option>
					<?
						$k = "select package from Packages";
						$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
						while($v = $q->fetch_array()) { ?>
							<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
						<? }
					?>
				</select>
				<label>Package</label>
			</div>

			<!-- Class -->
			<div class="input-field col s4 validate">
				<select id="unitTestClass">
					<option value="">Select a class</option>
				</select>
				<label>Class</label>
			</div>

			<!-- Method -->
			<div class="input-field col s4 validate">
				<select id="unitTestMethod">
					<option value="">Select a method</option>
				</select>
				<label>Method</label>
			</div>

			<a id="unitTestMethodInsert" class="waves-effect waves-light btn-large">ADD METHOD</a>
		</div>

		<!-- Methods already combined -->
		<div id="unitTestMethodList" class="col s12">
			<?
				$k = "select m.returnType, m.package, m.class, m.signature, m.description from UnitTestClassesMethods t join ClassMethods m on t.test = $id and t.signature = m.signature and t.package = m.package and t.returnType = m.returnType and t.class = m.class";
				$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
				while($v = $q->fetch_array()) { ?>
					<div class="chip"><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<? echo $v[4] ?>"><? echo $v[0] . " " . $v[1] . ":" . $v[2] . "." . $v[3] ?></a><i class="material-icons methodDelete">close</i></div>
				<? }
			?>
		</div>

	</div>
</div>

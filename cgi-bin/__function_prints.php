<?

	function write($string) {
		fwrite($GLOBALS['fileOutputPrints'], $string);
	}

	function toolRequirementHeadList() {
		
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2cm}!{\\VRule[1pt]}p{2cm}!{\\VRule[1pt]}p{5cm}!{\\VRule[1pt]}p{1.5cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Tipologia} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Fonti} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Tipologia} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Fonti} \\\\ \n");
	    write("\\endhead \n");
	}

	function toolRequirementSources($requirement) {
		$sources = [];

		// Verbal 
		$k = "select verbal from RequirementsVerbal where requirement = '$requirement'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array())
			array_push($sources, $v[0]);
		
		// Usecase
		$k = "select usecase from RequirementsUsecases where requirement = '$requirement'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array())
			array_push($sources, $v[0]);

		return $sources;
	}	

	function toolRequirementPriorityTranslate($requirement) {
		switch(substr($requirement, 1, 1)) {
			case('0'):
				return 'Obbligatorio';
				break;
			
			case('1'):
				return 'Desiderabile';
				break;

			case('2'):
				return 'Opzionale';
				break;
		}
	}

	function toolRequirementTypeTranslate($requirement) {
		switch(substr($requirement, 2, 1)) {
			case('F'):
				return 'Funzionale';
				break;

			case('V'):
				return 'Vincolo';
				break;
			
			case('Q'):
				return 'Qualitativo';
				break;

			case('P'):
				return 'Performance';
				break;
		}
	}

	function toolRequirementFirstLevel($type, $dad = '') {
		if($dad != '')
			$q = mysqli_query(connect(), "select * from Requirements where dad = '$dad'") or die("ERRORE");
		else
			$q = mysqli_query(connect(), "select * from Requirements where dad is NULL") or die("ERRORE");
		while($v = $q->fetch_array()) {
			if(substr($v[0], 2, 1) == $type) {
				write($v[0] . "&" . toolRequirementTypeTranslate($v[0]) . "\\newline " . toolRequirementPriorityTranslate($v[0]) . " & " . $v[2] . " & " . $v[3]);
				$sources = toolRequirementSources($v[0]);
				foreach($sources as $value)
					write(" \\newline " . $value . "\n");
				write(" \\\\\n");
			}
			toolRequirementFirstLevel($type, $v[0]);
		}
	}

	function arFunctionalRequirement() {
		toolRequirementHeadList();
		toolRequirementFirstLevel('F');
		write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti funzionali}" . "\n\\end{longtable}");
	}

	function arQualitativeRequirement() {
		toolRequirementHeadList();
		toolRequirementFirstLevel('Q');
		write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti qualitativi}" . "\n\\end{longtable}");
	}

	function arBindingRequirement() {
		toolRequirementHeadList();
		toolRequirementFirstLevel('V');
		write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti di vincolo}" . "\n\\end{longtable}");
	}

	function arPerformanceRequirement() {
		toolRequirementHeadList();
		toolRequirementFirstLevel('P');
		write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti di performance}" . "\n\\end{longtable}");
	}

	function arResume() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2.5cm}!{\\VRule[1pt]}p{2.5cm}!{\\VRule[1pt]}p{2.5cm}!{\\VRule[1pt]}p{2.5cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Tipologia} & \\color{white} \\textbf{Obbligatorio} & \\color{white} \\textbf{Desiderabile} & \\color{white} \\textbf{Opzionale} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Tipologia} & \\color{white} \\textbf{Obbligatorio} & \\color{white} \\textbf{Desiderabile} & \\color{white} \\textbf{Opzionale} \\\\ \n");
	    write("\\endhead \n");
	    $kF0 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'F' and substr(requirement, 2, 1) = '0'";
	    $kF1 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'F' and substr(requirement, 2, 1) = '1'";
	    $kF2 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'F' and substr(requirement, 2, 1) = '2'";
	    $kQ0 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'Q' and substr(requirement, 2, 1) = '0'";
	    $kQ1 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'Q' and substr(requirement, 2, 1) = '1'";
	    $kQ2 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'Q' and substr(requirement, 2, 1) = '2'";
	    $kB0 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'V' and substr(requirement, 2, 1) = '0'";
	    $kB1 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'V' and substr(requirement, 2, 1) = '1'";
	    $kB2 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'V' and substr(requirement, 2, 1) = '2'";
	    $kP0 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'P' and substr(requirement, 2, 1) = '0'";
	    $kP1 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'P' and substr(requirement, 2, 1) = '1'";
	    $kP2 = "select count(requirement) as num from Requirements where substr(requirement, 3, 1) = 'P' and substr(requirement, 2, 1) = '2'";
	    $q = mysqli_query(connect(), $kF0) or die("ERRORE: " . $kF0);	$vF0 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kF1) or die("ERRORE: " . $kF1);	$vF1 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kF2) or die("ERRORE: " . $kF2);	$vF2 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kQ0) or die("ERRORE: " . $kQ0);	$vQ0 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kQ1) or die("ERRORE: " . $kQ1);	$vQ1 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kQ2) or die("ERRORE: " . $kQ2);	$vQ2 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kB0) or die("ERRORE: " . $kB0);	$vB0 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kB1) or die("ERRORE: " . $kB1);	$vB1 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kB2) or die("ERRORE: " . $kB2);	$vB2 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kP0) or die("ERRORE: " . $kP0);	$vP0 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kP1) or die("ERRORE: " . $kP1);	$vP1 = $q->fetch_array();
	    $q = mysqli_query(connect(), $kP2) or die("ERRORE: " . $kP2);	$vP2 = $q->fetch_array();
	    write('Funzionali & ' . $vF0[0] . " & " . $vF1[0] . " & " . $vF2[0] . "\\\\");
	    write('Qualitativi & ' . $vQ0[0] . " & " . $vQ1[0] . " & " . $vQ2[0] . "\\\\");
	    write('Vincolo & ' . $vB0[0] . " & " . $vB1[0] . " & " . $vB2[0] . "\\\\");
	    write('Performance & ' . $vP0[0] . " & " . $vP1[0] . " & " . $vP2[0] . "\\\\");
	    write("\\rowcolor{white}" . "\n\\caption{Riepilogo dei requisiti}" . "\n\\end{longtable}");
	}

	function toolUsecaseActors($id) {
		$k = "select actor from ActorUsecases where usecase = '$id'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		$n = mysqli_num_rows($q);
		while($v = $q->fetch_array()) {
			write($v[0]);
			$n--;
			if($n > 0)
				write(", ");
		}
		write(".\n");
	}

	function toolUsecaseHasChild($id) {
		$k = "select usecase from Usecases where dad = '$id' ";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolUsecaseEventFlow($id) {
		$k = "select usecase, title from Usecases where dad = '$id' and type <> 'extension'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		$n = mysqli_num_rows($q);
		if($n > 0) {
			write("\\item \\textbf{Scenario principale}: ");
			write("\\begin{enumerate}");
			while($v = $q->fetch_array()) {
				write("\\item " . $v[1] . " (" . $v[0] . ")");
				$n--;
				if($n > 0)
					write(";");
			}
			write(". \n \\end{enumerate}\n");
		}
	}

	function toolUsecaseExtensions($id) {
		$k = "select usecase, title from Usecases where dad = '$id' and type = 'extension'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		$n = mysqli_num_rows($q);
		if($n > 0) {
			write("\\item \\textbf{Estensioni}:");
			write("\\begin{itemize}");
			while($v = $q->fetch_array()) {
				write("\\item " . $v[1] . " (" . $v[0] . ")");
				$n--;
				if($n > 0)
					write(";");
				else
					write(".");
			}
			write("\\end{itemize}\n");
		}
	}

	function toolUsecaseHeir($id) {
		$k = "select usecase, title from Usecases where dad = '$id' and type = 'heir'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		$n = mysqli_num_rows($q);
		if($n > 0) {
			write("\\item \\textbf{Eredi}:");
			write("\\begin{itemize}");
			while($v = $q->fetch_array()) {
				write("\\item " . $v[1] . " (" . $v[0] . ")");
			}
			write(". \n\\end{itemize}");
		}
	}

	function toolUsecasePrint($v) {
		write("\\subsubsection{" . $v[0] . " - " . $v[2] . "} \n");
		write("\\label{sssec:$v[0]} \n");
		if(strlen($v[7]) > 0) {
			write("\\begin{figure}[h!] \n" . "\\centering \n");
			if($v[0] == "UC1.2.1" || $v[0] == "UC1.3" || $v[0] == "UC1.4" || $v[0] == "UC1.5" || $v[0] == "UC1.6")
				write("\\includegraphics[scale=0.4]{" . $v[7] . "} \n");
			else if($v[0] == "UC1")
				write("\\includegraphics[scale=0.3]{" . $v[7] . "} \n");
			else
				write("\\includegraphics[scale=0.5]{" . $v[7] . "} \n");
			write("\\caption{" . $v[8] . "} \n \\end{figure} \n");
		}
		write("\\begin{itemize} \n");
		write("\\item \\textbf{Attori}: ");
		toolUsecaseActors($v[0]);
		write("\\item \\textbf{Descrizione}: " . $v[3] . ".\n");
		write("\\item \\textbf{Precondizione}: " . $v[5] . ".\n");
		write("\\item \\textbf{Postcondizione}: " . $v[6] . ".\n");
		if(toolUsecaseHasChild($v[0]))
			toolUsecaseEventFlow($v[0]);
		elseif(strlen($v[9]) > 0) {
			write("\\item \\textbf{Scenario principale}: ");
			write($v[9] . ".");
		}
		if(strlen($v[10]) > 0)
			write("\\item \\textbf{Scenari alternativi}: " . $v[10] . ".\n");
		toolUsecaseExtensions($v[0]);
		toolUsecaseHeir($v[0]);
		write("\\end{itemize} \n");
	}

	function toolUsecaseRic($id) {
		$k = "select * from Usecases where dad = '$id'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			toolUsecasePrint($v);
			toolUsecaseRic($v[0]);
		}
	}

	function arUsecase() {
		$k = "select * from Usecases where dad is NULL";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			toolUsecasePrint($v);
			toolUsecaseRic($v[0]);
		}
	}

	function arTrackingRequirementSource() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2.5cm}!{\\VRule[1pt]}p{2.5cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Fonte} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Fonte} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select requirement, source from Requirements";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	write($v[0] . " & " . $v[1]);
	    	$sources = toolRequirementSources($v[0]);
			foreach($sources as $value)
				write(" \\newline " . $value . "\n");
			write(" \\\\\n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti-fonti}" . "\n\\end{longtable}");
	}

	function arTrackingSourceRequirement() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2.5cm}!{\\VRule[1pt]}p{2.5cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Fonte} & \\color{white} \\textbf{Requisito} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Fonte} & \\color{white} \\textbf{Requisito} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select requirement, source from Requirements";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	$req = $v[0];
	    	write($v[1]);
	    	$sources = toolRequirementSources($v[0]);
			foreach($sources as $value)
				write(" \\newline " . $value . "\n");
	    	write(" & " . $req . " \\\\\n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Tracciamento fonti-requisito}" . "\n\\end{longtable}");
	}

	function toolRequirementTranslateSatisfiedField($field) {
		echo $field . "\n";
		$aux = "{\color{green} Soddisfatto}";
		if($field != "satisfied")
			$aux = "{\color{red} Non soddisfatto}";
		return $aux;
	}

	function toolRequirementHeadSatisfied() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2cm}!{\\VRule[1pt]}p{6cm}!{\\VRule[1pt]}p{2cm}!{\\VRule[1pt]}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Soddisfatto} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Soddisfatto} \\\\ \n");
	    write("\\endhead \n");
	}

	function arSatisfiedObbligatory() {
		toolRequirementHeadSatisfied();
		$k = "select requirement, description, satisfied from Requirements where substr(requirement, 2, 1) = 0";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			write($v[0] . " & " . $v[1] . " & " . toolRequirementTranslateSatisfiedField($v[2]) . "\\\\ \n");
		}
		write("\\rowcolor{white}" . "\n\\caption{Riepilogo requisiti obbligatori soddisfatti}" . "\n\\end{longtable}");
	}

	function arSatisfiedDesiderable() {
		toolRequirementHeadSatisfied();
		$k = "select requirement, description, satisfied from Requirements where substr(requirement, 2, 1) = 1";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			write($v[0] . " & " . $v[1] . " & " . toolRequirementTranslateSatisfiedField($v[2]) . "\\\\ \n");
		}
		write("\\rowcolor{white}" . "\n\\caption{Riepilogo requisiti desiderabili soddisfatti}" . "\n\\end{longtable}");
	}	

	function arSatisfiedOptional() {
		toolRequirementHeadSatisfied();
		$k = "select requirement, description, satisfied from Requirements where substr(requirement, 2, 1) = 2";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			write($v[0] . " & " . $v[1] . " & " . toolRequirementTranslateSatisfiedField($v[2]) . "\\\\ \n");
		}
		write("\\rowcolor{white}" . "\n\\caption{Riepilogo requisiti opzionali soddisfatti}" . "\n\\end{longtable}");
	}

	function arTrackingRequirementTestValidationSystem() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2cm}!{\\VRule[1pt]}p{4cm}!{\\VRule[1pt]}p{4cm}!{\\VRule[1pt]}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Test di validatzione} & \\color{white} \\textbf{Test di sistema} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Test di validatzione} & \\color{white} \\textbf{Test di sistema} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select requirement from Requirements";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	write($v[0] . " & ");
	    	$kT = "select test from ValidationTest where requirement = '$v[0]'";
	    	$qT = mysqli_query(connect(), $kT) or die("ERRORE: " . $kT);
	    	if(mysqli_num_rows($qT) > 0)
	    		write("T" . substr($v[0], 1));
	    	write(" & ");
	    	$kS = "select * from SystemTests where requirement = '$v[0]'";
	    	$qS = mysqli_query(connect(), $kS) or die("ERRORE: " . $kS);
	    	if(mysqli_num_rows($qS) > 0) {
	    		write("TS" . substr($v[0], 1));
	    	}
	    	write(" \\\\ \n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti-test di validazione-test di sistema}" . "\n\\end{longtable}");
	}

	function pqTestValidation() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{1cm}!{\\VRule[1pt]}p{4cm}!{\\VRule[1pt]}p{5cm}!{\\VRule[1pt]}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Test} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Operazioni} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Test} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Operazioni} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select test, description from ValidationTest";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	write($v[0] . " & " . $v[1]);
	    	$kStep = "select stepDescription from ValidationTestStep where test = '$v[0]' order by stepNumber";
	    	$qStep = mysqli_query(connect(), $kStep) or die("ERRORE: " . $kStep);
	    	$nStep = mysqli_num_rows($qStep);
	    	write(" & Viene richiesto di: \\begin{enumerate} \n");
	    	while($vStep = $qStep->fetch_array()) {
	    		write("\\item " . $vStep[0]);
	    		$nStep--;
	    		if($nStep > 0)
	    			write("; \n");
	    		else 
	    			write(". \n");
	    	}
	    	write("\\end{enumerate} \\\\ \n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Riepilogo test di validazione}" . "\n\\end{longtable}");
	}

	function toolTestTranslateState($state) {
		if($state == 'implemented')
			return 'I';
		else
			return 'N.I';
	}

	function pqTestSystem() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{1.5cm}!{\\VRule[1pt]}p{5cm}!{\\VRule[1pt]}p{1cm}!{\\VRule[1pt]}p{2cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Test} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Stato} & \\color{white} \\textbf{Requisito} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Test} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Stato} & \\color{white} \\textbf{Requisito} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select * from SystemTests";
	    $q = mysqli_query(connect(), $k) or die("ERROER: " . $k);
	    while($v = $q->fetch_array()) {
	    	write("TS" . substr($v[0], 1));
	    	write(" & " . $v[1] . " & " . toolTestTranslateState($v[2]) . " & " . $v[0] . " \\\\ \n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Riepilogo test di sistema}" . "\n\\end{longtable}");
	}

	function toolTestPrintPackageHierarchy($id, $hierarchy) {
		$k = "select dad from Packages where package = '$id'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);	
		if(mysqli_num_rows($q) > 0) {
			$v = $q->fetch_array();
			$hierarchy = $v[0] . "::" . $hierarchy;
			toolTestPrintPackageHierarchy($v[0], $hierarchy);
		}
		return $hierarchy;
	}

	function pqTestIntegration() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{1.5cm}!{\\VRule[1pt]}p{5cm}!{\\VRule[1pt]}p{1cm}!{\\VRule[1pt]}p{2cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Test} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Componente} & \\color{white} \\textbf{Stato} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Test} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Componente} & \\color{white} \\textbf{Stato} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select * from IntegrationTest";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	write("TI" . $v[1] . " & " . $v[2] . " & " . "");
	    }
	}

	function toolPackageNamespace($package) {
		$k = "select dad from Packages where package = '$package'";
		$q = mysqli_query(connect(), $k) or die("ecc");
		if($v = $q->fetch_array()) {
			if(strlen($v[0]) > 0)
				return toolPackageNamespace($v[0]) . "::" . $package;
			else 
				return $package;
		} else {
			return $package;
		}
	}

	function toolPackageHasClass($package) {
		$k = "select class from Classes where package = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione delle classi del package");
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolPackageClassHasAttribute($class, $package) {
		$k = "select * from ClassAttributes where class = '$class'";
		$q = mysqli_query(connect(), $k) or die("Errore nell\'accertamento della presenza di attributi");
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolPackageClassAttribute($class, $package) {
		$k = "select * from ClassAttributes where package = '$package' and class = '$class'"; 
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione degli attributi di classe");
		while($v = $q->fetch_array()) {
			write("\\begin{itemize}\n");
			write("\\item \\texttt{" . $v[1] . ": " . $v[2] . "}\\ \n\n " . $v[3] . ".\n");
			write("\\end{itemize}\n");
		}
	}

	function toolPackageClassHasMethod($class, $package) {
		$k = "select * from ClassMethods where class = '$class' and package = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione dei metodi di classe " . $k);
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolPackageClassMethodParamsList($signature, $class, $package) {
		$list = "";
		$k = "select * from ClassMethodsParams where signature = '$signature' and class = '$class' and package = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione delle lista degli argomenti");
		$n = mysqli_num_rows($q);
		while($v = $q->fetch_array()) {
			$list .= $v[4]; 
			$n--;
			if($n) 
				$list .= ", ";
		}
		return $list;
	}

	function toolPackageClassMethodParams($signature, $class, $package) {
		$k = "select * from ClassMethodsParams where signature = '$signature' and package = '$package' and class = '$class'";
		$q = mysqli_query(connect(), $k) or die("Errore durantela selezione dei metodi ");
		while($v = $q->fetch_array()) {
			write("\\item \\texttt{" . $v[4] . " : " . $v[5] . "}\\ \n\n " . $v[6] . ". \n");
		}
	}

	function toolPackageClassMethodHasParams($signature, $class, $package) {
		$k = "select * from ClassMethodsParams where signature = '$signature' and package = '$package' and class = '$class'";
		$q = mysqli_query(connect(), $k) or die("Errore nell\'accertamente dell\'esistenza dei metodi di classe");
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolPackageClassMethod($class, $package) {
		$k = "select * from ClassMethods where class = '$class' and package = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione dei metodi della classe " . $k);
		while($v = $q->fetch_array()) {
			write("\\begin{itemize}\n");
			write("\\item \\texttt{" . $v[1] . " (" . toolPackageClassMethodParamsList($v[1], $class, $package) .  ")  : " . $v[2] . "}\\ \n\n " . $v[3] . "\n");
			if(toolPackageClassMethodHasParams($v[1], $class, $package)) {
				write("\n\\item \\textbf{Argomenti}:\n");
				write("\\begin{itemize}\n");
				toolPackageClassMethodParams($v[1], $class, $package);
				write("\\end{itemize}\n");
			}
			write("\\end{itemize}\\vspace{0.5em}\n");
		}
	}

	function toolPackageClassHasRelations($class, $package) {
		$k = "select classEnd from ClassRelations where classStart = '$class' and packageStart = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione delle relazioni di classe");
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolPackageclassRelations($class, $package) {
		$k = "select classEnd, packageEnd from ClassRelations where classStart = '$class' and packageStart = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione delle classi in relazione");
		$n = mysqli_num_rows($q);
		write("\\begin{itemize}\n");
		while($v = $q->fetch_array()) {
			$k = "select description from Classes where class = '$v[0]' and package = '$v[1]'";
			$qClass = mysqli_query(connect(), $k) or die("Errore durante il reperimento delle informazioni della classe relazionata");
			$vClass = $qClass->fetch_array();
			$description = $vClass[0];
			write("\\item \\texttt{" . toolPackageNamespace($v[1]) . "::" . $v[0] . "}: " . $vClass[0]);
			$n--;
			if($n)
				write(";\n");
			else 
				write(".\n");
		}
		write("\\end{itemize}\n");
	}

	function toolPackageClass($package) {
		$k = "select * from Classes where package = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore nella selezione delle classi di package");
		while($v = $q->fetch_array()) {
			$aux = $package;
			write("\\subparagraph{\\texttt{" . toolPackageNamespace($package) . "::" . $v['class'] . "}} \n");
			write("\\begin{itemize}");
			write("\\item \\textbf{Descrizione}: " . $v[1] . "\n");
			write("\\item \\textbf{Utilizzo}: " . $v[2] . "\n");
			if(toolPackageClassHasAttribute($v[0], $package)) {
				write("\\item \\textbf{Attributi}:\n");
				toolPackageClassAttribute($v[0], $package);
			}
			if(toolPackageClassHasMethod($v[0], $package)) {
				write("\\item \\textbf{Metodi}:\n");
				toolPackageClassMethod($v[0], $package);	
			}
			if(toolPackageClassHasRelations($v[0], $package)) {
				write("\\item \\textbf{Relazioni con altre classi}:\n");
				toolPackageClassRelations($v[0], $package);
			} 
			write("\\end{itemize}");
		}	
	}

	function toolPackageContainsPackage($package) {
		$k = "select package from Packages where dad = '$package'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione dei package figlio");
		$n = mysqli_num_rows($q);
		return $n > 0;
	}

	function toolPackageContainedPackages($dad) {
		$k = "select package, description from Packages where dad = '$dad'";
		$q = mysqli_query(connect(), $k) or die("Errore di stampa dei figli del package");
		write("\\begin{itemize}");
		while($v = $q->fetch_array()) {
			write("\\item " . toolPackageNamespace($v[0]) . ": " . $v[1] . "\n");
		}
		write("\\end{itemize}");
	}

	function toolPackagePrint($dad) {
		if($dad == '')
			$k = "select * from Packages where dad is NULL and package != 'Default'";
		else 
			$k = "select * from Packages where dad = '$dad'";
		$q = mysqli_query(connect(), $k) or die("Errore selezione informazione package");
		while($v = $q->fetch_array()) {
			$aux = $v[0];
			write("\\subsubsection{Componente \\texttt{" . toolPackageNamespace($v[0]) . "}}");
			write("\\myparagraph{Informazioni sul package}");
			if(strlen($v[3]) > 0) {
				write("\\begin{figure}[h!] \n" . "\\centering \n");
				if($v[0] == 'matrix' || $v[0] == 'totp')
					write("\\includegraphics[scale=0.25]{" . $v[3] . "} \n");
				else
					write("\\includegraphics[scale=0.4]{" . $v[3] . "} \n");
				write("\\caption{" . $v[4] . "} \n \\end{figure} \n");
			}
			write("\\begin{itemize}");
			write("\\item \\textbf{Descrizione}: " . $v[2]);
			if(strlen($v[1]) > 0)
				write("\\item \\textbf{Padre}: " . $v[1]);
			//write("\\item \\textbf{Interazione con altri package}:\n");
			if(toolPackageContainsPackage($v[0])) {
				write("\\item \\textbf{Package contenuti}:\n");
				toolPackageContainedPackages($v[0]);
			}
			if(toolPackageHasClass($v[0])) {
				write("\\myparagraph{Classi}\n");
				toolPackageClass($v[0]);
			}
			write("\\end{itemize}\n");
			toolPackagePrint($v[0]);
		}
	}

	function dpPackage() {
		toolPackagePrint('');
	}

	

	function toolRequirementClassCombined($requirement) {
		$aux = [];
		$k = "select package, class from RequirementsClasses where requirement = '$requirement'";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione delle classi associate");
		while($v = $q->fetch_array()) {
			$cl = toolPackageNamespace($v[0]);
			$cl .= "::" . $v[1];
			array_push($aux, $cl);
		}
		return $aux;
	}

	function toolClassRequirementCombined($class, $package) {
		$aux = [];
		$k = "select requirement from RequirementsClasses where package = '$package' and class = '$class' ";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione dei requisiti associati alla classe");
		while($v = $q->fetch_array()) {
			array_push($aux, $v[0]);
		}
		return $aux;
	}



	function stTrackingRequirementClass() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{2.5cm}!{\\VRule[1pt]}p{8.5cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Classi} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Classi} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select requirement from Requirements order by SUBSTR(requirement, 1, 1), SUBSTR(requirement, 3, LENGTH(requirement))";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	write($v[0] . " & ");
	    	$classes = toolRequirementClassCombined($v[0]);
			foreach($classes as $key => $value) {
				write("\\texttt{" . $value . "}");
				if($key < count($classes) - 1)
					write(" \\newline \n");
			}
			write(" \\\\\n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Tracciamento requisiti-classi}" . "\n\\end{longtable}");
	}

	function stTrackingClassRequirement() {
		write("\\def\arraystretch{1.5}\n");
	    write("\\rowcolors{2}{D}{P}\n");
	    write("\\begin{longtable}{p{8.5cm}!{\\VRule[1pt]}p{2.5cm}}\n");
	    write("\\rowcolor{I}\n");
	    write("\\color{white} \\textbf{Classe} & \\color{white} \\textbf{Requisiti} \\\\ \n");
	    write("\\endfirsthead \n");
	    write("\\rowcolor{I} \n");
	    write("\\color{white} \\textbf{Classe} & \\color{white} \\textbf{Requisiti} \\\\ \n");
	    write("\\endhead \n");
	    $k = "select class, package from Classes order by package";
	    $q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
	    while($v = $q->fetch_array()) {
	    	$cl = toolPackageNamespace($v[1]);
	    	$cl .= "::" . $v[0];
	    	write("\\texttt{" . $cl . "} & ");
	    	$requirements = toolClassRequirementCombined($v[0], $v[1]);
			foreach($requirements as $key => $value) {
				write($value);
				if($key < count($requirements) - 1)
					write(" \\newline \n");
			}

			write(" \\\\\n");
	    }
	    write("\\rowcolor{white}" . "\n\\caption{Tracciamento classi-requisiti}" . "\n\\end{longtable}");
	}

	function glVoices() {
		$letters = array();
		$k = "select * from Glossary";
		$q = mysqli_query(connect(), $k) or die("Errore durante la selezione delle voci di glossario");
		while($v = $q->fetch_array()) {
			if(!in_array(substr($v[0], 0, 1), $letters)) {
				array_push($letters, strtoupper(substr($v[0], 0, 1)));
				write("\\vspace{1cm}");
				write("\\hfill \\textbf{\Huge " . strtoupper(substr($v[0], 0, 1)) . " } \n ");
			}
			write("\\subsection*{" . $v[0] . "} \n ");
			write($v[1] . ".\\\\ \n ");
		}
	}


?>
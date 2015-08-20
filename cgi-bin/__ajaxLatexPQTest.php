<?
require_once('./__system.php');
/* ______________________________________


	  TEST DI VALIDAZIONE

________________________________________ */

global $test; 
$test = fopen('../latex/test.tex', 'w+') or die("file test not foud");
fwrite($GLOBALS['test'], "\setcounter{secnumdepth}{0}");
fwrite($GLOBALS['test'], "\setcounter{tocdepth}{0}");

function standardId($id) {	
  $newId = "";
  if(substr($id,1,1)==0) $newId = 'R'.'O'.substr($id,2,strlen($id));
  else if(substr($id,1,1)==1) $newId = 'R'.'Z'.substr($id,2,strlen($id));
  else $newId = 'R'.'D'.substr($id,2,strlen($id));
  return $newId; 	
}
	
function stampaTestValidazioneRic($idR) {
    $k = "select idR from Requisiti where padre='$idR' order by length(idR),substr(idR,3)";
    $q = mysqli_query(connect(), $k) or die("errore ciclico");
    while($v = $q->fetch_array())
    {
    $kTest = "select * from RequirementTest where object = '$v[0]' and type = 'validation'";
    $qTest = mysqli_query(connect(), $kTest) or die("errore stampa validazione");
    while($vTest = $qTest->fetch_array())
    {
      fwrite($GLOBALS['test'], "TV".substr($vTest[1],2,strlen($vTest[1]))." & \n");
      $temp = "All";
      $arg = explode($temp,$vTest[2]);
      $dim = count($arg);
      fwrite($GLOBALS['test'], $arg[0]." & \n All");
      for($i=1;$i<$dim;$i++)   
        fwrite($GLOBALS['test'], $arg[$i]);
      fwrite($GLOBALS['test'], "\\\\");
    }
    stampaTestValidazioneRic($v[0]);
  }
}

	
function stampaTestValidazione($type) {
  $k = "select idR from Requisiti where padre is NULL and substr(idR,3,1)='$type' order by length(idR),substr(idR,3)";
  $q = mysqli_query(connect(), $k) or die("errore ciclico");
  while($v = $q->fetch_array())
  {
    $kTest = "select * from RequirementTest where object = '$v[0]' and type = 'validation'";
    $qTest = mysqli_query(connect(), $kTest) or die("errore stampa validazione");
    while($vTest = $qTest->fetch_array())
    {
      fwrite($GLOBALS['test'], "TV".substr($vTest[1],2,strlen($vTest[1]))." & \n");
      $temp = "All";
      $arg = explode($temp,$vTest[2]);
      $dim = count($arg);
      fwrite($GLOBALS['test'], $arg[0]." & \n All");
      for($i=1;$i<$dim;$i++)
        fwrite($GLOBALS['test'], $arg[$i]);
      fwrite($GLOBALS['test'], "\\\\");
    }
    stampaTestValidazioneRic($v[0]);
  }
}

fwrite($GLOBALS['test'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['test'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['test'],"\\begin{longtable}{p{1.5cm}!{\VRule[1pt]}p{4cm}!{\VRule[1pt]}p{8cm}} \n");
fwrite($GLOBALS['test'],"\\rowcolor{I} \n");
fwrite($GLOBALS['test'],"\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Operazioni} \\\\ \n");
fwrite($GLOBALS['test'],"\\endfirsthead \n");
fwrite($GLOBALS['test'],"\\rowcolor{I} \n");
fwrite($GLOBALS['test'],"\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Operazioni} \\\\ \n");
fwrite($GLOBALS['test'],"\\endhead \n");

stampaTestValidazione("F");
stampaTestValidazione("Q");
stampaTestValidazione("V");

fwrite($GLOBALS['test'],"\\rowcolor{white} \n");
fwrite($GLOBALS['test'],"\\caption{Test di validazione} \n");
fwrite($GLOBALS['test'],"\\end{longtable} \n \n");

/* ______________________________________


        TEST DI SISTEMA

________________________________________ */

function testSistemaByType($type) {
  $k = "select * from RequirementTest where type = 'system' and substr(object,3,1)='$type' order by length(object),substr(object,3)";
  $q = mysqli_query(connect(), $k) or die("err test sistema");
  while($v = $q->fetch_array())
  {
    fwrite($GLOBALS['test'], "TS".substr($v[1],2,strlen($v[1]))." & ". $v[2]. ". & ");
    if($v[3]) fwrite($GLOBALS['test'], "IMPL. & ");
    else fwrite($GLOBALS['test'], "N.I. & ");
    fwrite($GLOBALS['test'], standardId($v[1])."\\\\ \n");
  }
}

fwrite($GLOBALS['test'], "\\newpage \n");
fwrite($GLOBALS['test'], "\\setcounter{secnumdepth}{5}");
fwrite($GLOBALS['test'], "\\setcounter{tocdepth}{5}");
fwrite($GLOBALS['test'], "\\subsection{ Test di sistema }"." I test di sistema servono per accertarsi che il comportamento dinamico del sistema rispetti i requisiti software individuati e descritti nel documento \\ARdoc.");
fwrite($GLOBALS['test'], "\\subsubsection{Descrizione dei test di sistema} \n");
fwrite($GLOBALS['test'], "\\vspace*{0.1em} \n");
fwrite($GLOBALS['test'], "\\def\arraystretch{1.5}");
fwrite($GLOBALS['test'], "\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['test'], "\\begin{longtable}{p{2cm}!{\VRule[1pt]}p{6.5cm}!{\VRule[1pt]}p{1.5cm}!{\VRule[1pt]}p{2.5cm}} \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Stato} & \color{white} \\textbf{Requisito}\\\\ \n");
fwrite($GLOBALS['test'], "\\endfirsthead \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Stato} & \color{white} \\textbf{Requisito}\\\\ \n");
fwrite($GLOBALS['test'], "\\endhead \n");
testSistemaByType("F");
testSistemaByType("Q");
testSistemaByType("V");
fwrite($GLOBALS['test'], "\\rowcolor{white} \n");
fwrite($GLOBALS['test'], "\\caption{Tracciamento test di sistema-requisiti} \n");
fwrite($GLOBALS['test'], "\\end{longtable} \n \n");

/* ______________________________________


    TEST DI INTEGRAZIONE

________________________________________ */

function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};

function after_last ($this, $inthat)
{
    if (!is_bool(strrevpos($inthat, $this)))
    return substr($inthat, strrevpos($inthat, $this)+strlen($this));
};

fwrite($GLOBALS['test'],"\subsection{ Test di integrazione }"." I test di integrazione vengono utilizzati per verificare che tutti i componenti del sistema comunichino correttamente tra loro e che all'interno del software vi siano i dati attesi. Si utilizzaerà una strategia di integrazione incrementale per poter sviluppare e verificare più componenti in parallelo. Questo metodo da priorità ai test relativi alle componenti che vengono ritenute più importanti, permettendo così partire dalle componenti che soddisfano i requisiti obbligatori fino ad integrarli con le componenti che soddisfano i requisiti opzionali. Aiuta anche a restringere la ricerca dell’errore in caso di test fallito, in quanto sarà molto probabile che l’errore risulti dal nuovo componente o dalle sue interazioni con il sistema corrente.");

fwrite($GLOBALS['test'], "\\subsubsection{Descrizione dei test di integrazione} \n");
fwrite($GLOBALS['test'], "\\vspace*{0.1em} \n");
fwrite($GLOBALS['test'], "\\def\arraystretch{1.5}");
fwrite($GLOBALS['test'], "\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['test'], "\\begin{longtable}{p{2.5cm}!{\VRule[1pt]}p{6cm}!{\VRule[1pt]}p{3cm}!{\VRule[1pt]}p{1.5cm}} \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Componente} & \color{white} \\textbf{Stato}\\\\ \n");
fwrite($GLOBALS['test'], "\\endfirsthead \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Componente} & \color{white} \\textbf{Stato}\\\\ \n");
fwrite($GLOBALS['test'], "\\endhead \n");
$k = "select * from PackageTest where type = 'integration'";
$q = mysqli_query(connect(), $k) or die("err test integrazione");
while($v = $q->fetch_array())
{
    $id = after_last (':',$v[1]);
    if(!$id)
      $id = "premi";
    fwrite($GLOBALS['test'], "TI".$id." & ".$v[2]." & \pkg{\seqsplit{".$v[1]."}} & ");
    if($v[3]) fwrite($GLOBALS['test'], "IMPL. \\\\ \n");
    else fwrite($GLOBALS['test'], "N.I. \\\\ \n");
}
fwrite($GLOBALS['test'], "\\rowcolor{white} \n");
fwrite($GLOBALS['test'], "\\caption{Tracciamento test di integrazione-componenti} \n");
fwrite($GLOBALS['test'], "\\end{longtable} \n \n");

/* ______________________________________
      
      TRACCIAMENTO COMPONENTI-TEST DI INTEGRAZIONE
//   ________________________________________ */
  
fwrite($GLOBALS['test'], "\\subsection{Tracciamento componenti-test di integrazione} \n");
fwrite($GLOBALS['test'], "\\vspace*{0.1em} \n");
fwrite($GLOBALS['test'], "\\def\arraystretch{1.5}");
fwrite($GLOBALS['test'], "\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['test'], "\\begin{longtable}{p{9cm}!{\VRule[1pt]}p{3cm}!{\VRule[1pt]}} \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Componente} & \color{white} \\textbf{Test} \\\\ \n");
fwrite($GLOBALS['test'], "\\endfirsthead \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Componente} & \color{white} \\textbf{Test} \\\\ \n");
fwrite($GLOBALS['test'], "\\endhead \n");
$k = "select * from PackageTest where type = 'integration'";
$q = mysqli_query(connect(), $k) or die("err test integrazione");
while($v = $q->fetch_array())
{
  $id = after_last (':',$v[1]);
  if(!$id)
    $id = "premi";
  fwrite($GLOBALS['test'], "\pkg{\seqsplit{".$v[1]."}} & TI".$id." \\\\ \n");
  }
fwrite($GLOBALS['test'], "\\rowcolor{white} \n");
fwrite($GLOBALS['test'], "\\caption{Tracciamento componenti-test di integrazione} \n");
fwrite($GLOBALS['test'], "\\end{longtable} \n \n");


/* ______________________________________
      
      TEST UNITA'
//   ________________________________________ */

fwrite($GLOBALS['test'],"\\subsection{Test di unità}");

fwrite($GLOBALS['test'], "\\subsubsection{Descrizione dei test di unità} \n");
fwrite($GLOBALS['test'], "\\vspace*{0.1em} \n");
fwrite($GLOBALS['test'], "\\def\arraystretch{1.5}");
fwrite($GLOBALS['test'], "\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['test'], "\\begin{longtable}{p{2cm}!{\VRule[1pt]}p{7cm}!{\VRule[1pt]}p{2cm}} \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['test'], "\\endfirsthead \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['test'], "\\endhead \n");
$kUnit = "select * from UnitTest";
$qUnit = mysqli_query(connect(), $kUnit) or die("err test integrazione");
while($vUnit = $qUnit->fetch_array())
{
    fwrite($GLOBALS['test'], "TU".$vUnit[0]." & ".$vUnit[1]." & ");
    if($vUnit[3]) 
        fwrite($GLOBALS['test'], "IMPL. \\\\ \n");
    else 
        fwrite($GLOBALS['test'], "N.I. \\\\ \n");
}
fwrite($GLOBALS['test'], "\\rowcolor{white} \n");
fwrite($GLOBALS['test'], "\\caption{Tracciamento test di unità} \n");
fwrite($GLOBALS['test'], "\\end{longtable} \n \n");

/* ______________________________________
      
      TEST UNITA'
//   ________________________________________ */

fwrite($GLOBALS['test'], "\\subsubsection{Tracciamento test di unità - classi.metodo} \n");
fwrite($GLOBALS['test'], "\\vspace*{0.1em} \n");
fwrite($GLOBALS['test'], "\\def\arraystretch{1.5}");
fwrite($GLOBALS['test'], "\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['test'], "\\begin{longtable}{p{2cm}!{\VRule[1pt]}p{8cm}} \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Classe.Metodo}\\\\ \n");
fwrite($GLOBALS['test'], "\\endfirsthead \n");
fwrite($GLOBALS['test'], "\\rowcolor{I} \n");
fwrite($GLOBALS['test'], "\\color{white} \\textbf{Test} & \color{white} \\textbf{Classe.Metodo}\\\\ \n");
fwrite($GLOBALS['test'], "\\endhead \n");
$kUnit = "select * from UnitTest order by idUT";
$qUnit = mysqli_query(connect(), $kUnit) or die("err test integrazione");
while($vUnit = $qUnit->fetch_array())
{
    fwrite($GLOBALS['test'], "TU".$vUnit[0]." & ");
    $arg = explode(";",$vUnit[2]);
    $dim = count($arg);
    if($dim==1)
        fwrite($GLOBALS['test'], $arg[0]." \\\\ \n");
    else
    {
        for($i=0;$i<$dim-1;$i++)
        {
            if($i!=($dim-2))
                fwrite($GLOBALS['test'], "\cls{".$arg[$i]."} \n \n");
            else
                fwrite($GLOBALS['test'], "\cls{".$arg[$i]."}");
        }
        fwrite($GLOBALS['test'], " \\\\ \n");
    }
}
fwrite($GLOBALS['test'], "\\rowcolor{white} \n");
fwrite($GLOBALS['test'], "\\caption{Tracciamento test di unità - classi.metodo} \n");
fwrite($GLOBALS['test'], "\\end{longtable} \n \n");


echo "Funzia";
?>
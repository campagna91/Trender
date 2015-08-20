<?
require_once('./__system.php');
function connectD(){
    $link2 = mysqli_connect('localhost','root','tr3ntas3i','CommentsDensity','3306') or die("Error " .mysql_error()); 
    return $link2; 
};

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

function EF($idP) {
    $kEF = "select classA, classB from ClassRelactions where classA in ( select titolo from Classi where idP = '$idP') and classB not in ( select titolo from Classi where idP = '$idP')";
    $qEF = mysqli_query(connect(), $kEF) or die("errore selezine classi esterne al package");
    $numEF = mysqli_num_rows($qEF);
    return $numEF;
}

function AF($idP) {
    $kAF = "select classA, classB from ClassRelactions where classA not in (select titolo from  Classi where idP = '$idP') and classB in (select titolo from Classi where idP = '$idP')";
    $qAF = mysqli_query(connect(), $kAF) or die("errore selezione classi AF ". $kAF);
    $numAF = mysqli_num_rows($qAF);
    return $numAF;
}

global $densita;
$densita = fopen('../latex/densita.tex', 'w+')or die("file not found");

function modListRecursive($child = 0,$id = 'none'){
    if(!$child)
        $k = "select titolo,padre,descrizione from Package where padre is NULL order by length(titolo),titolo";
    else 
        $k = "select titolo,padre,descrizione from Package where padre = '$id' order by length(titolo),titolo";
    $q = mysqli_query(connect(),$k)or die("Err");
    $ef = $af = $i = 0;
    while($v = $q->fetch_array())
    { 
        $ef = EF($v[0]); $af = AF($v[0]); 
        if($ef != 0)
            $inst = $af / ( $ef + $af);
        else $inst = 0;
        fwrite($GLOBALS['densita'], "\\pkg{\seqsplit{".$v[0]."}} & ".$inst." & ");
        if($inst<0.8)
            fwrite($GLOBALS['densita'], "{\color{ForestGreen}Soddisfatto} \\\\ \n");
        else
            fwrite($GLOBALS['densita'], "{\color{red}Non soddisfatto} \\\\ \n");
        modListRecursive(1,$v[0]);
    }
}


fwrite($GLOBALS['densita'],"\\subsection{Progettazione} \n");
fwrite($GLOBALS['densita']," Viene riportata di seguito una tabella riassuntiva che espone gli indici di instabilità per i componenti rilevati durante la progettazione.");
fwrite($GLOBALS['densita'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['densita'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['densita'],"\\begin{longtable}{p{7cm}!{\VRule[1pt]}p{3cm}!{\VRule[1pt]}p{3cm}} \n");
fwrite($GLOBALS['densita'],"\\rowcolor{I} \n");
fwrite($GLOBALS['densita'],"\\color{white} \\textbf{Componente} & \color{white} \\textbf{Indice instabilità} & \color{white} \\textbf{Esito}\\\\ \n");
fwrite($GLOBALS['densita'],"\\endfirsthead \n");
fwrite($GLOBALS['densita'],"\\rowcolor{I} \n");
fwrite($GLOBALS['densita'],"\\color{white} \\textbf{Componente} & \color{white} \\textbf{Indice instabilità} & \color{white} \\textbf{Esito}\\\\ \n");
fwrite($GLOBALS['densita'],"\\endhead \n");

modListRecursive();

fwrite($GLOBALS['densita'],"\\rowcolor{white} \n");
fwrite($GLOBALS['densita'],"\\caption{Esiti indici instabilità} \n");
fwrite($GLOBALS['densita'],"\\end{longtable} \n \n");

/*-------------------------------------------------------

            SODDISFACIMENTO METRICHE CLASSI
          
-------------------------------------------------------*/

fwrite($GLOBALS['densita'],"\\subsection{Soddisfacimento metriche} \label{app:Metriche}
Questa sezione traccia tutti i risultati delle metriche per il codice indicati nella sezione 2.3. Nella tabella viene riportata la percentuale di Coverage del codice in relazione alle componenti Client e Server.");
fwrite($GLOBALS['densita'],"\\subsubsection{Soddisfacimento metriche: classi} \n");
fwrite($GLOBALS['densita'],"\\vspace*{0.1em} \n");
fwrite($GLOBALS['densita'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['densita'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['densita'],"\\begin{longtable}{p{7cm}!{\VRule[1pt]}p{1.5cm}!{\VRule[1pt]}p{2cm}!{\VRule[1pt]}p{2.5cm}} \n");
fwrite($GLOBALS['densita'],"\\rowcolor{I} \n");
fwrite($GLOBALS['densita'],"\\color{white} \\textbf{Classe} & \color{white} \\textbf{Densità} & \color{white} \\textbf{Attributi} & \color{white} \\textbf{Soddisdatto}\\\\ \n");
fwrite($GLOBALS['densita'],"\\endfirsthead \n");
fwrite($GLOBALS['densita'],"\\rowcolor{I} \n");
fwrite($GLOBALS['densita'],"\\color{white} \\textbf{Classe} & \color{white} \\textbf{Densità} & \color{white} \\textbf{Attributi} & \color{white} \\textbf{Soddisdatto}\\\\ \n");
fwrite($GLOBALS['densita'],"\\endhead \n");
$k = "select * from t order by File";
$q = mysqli_query(connectD(), $k) or die("err fetch densita");
while($v = $q->fetch_array())
{
    $id = after_last ('/',$v[2]);
    $arg = explode(".",$id);
    $arg[0] = ucfirst($arg[0]);
    $arg[2] = ucfirst($arg[2]);
    $idfinal = $arg[0] . $arg[2];
    $density = intval(($v[4]*100)/$v[5]);
    fwrite($GLOBALS['densita'], "\pkg{\seqsplit{".$idfinal."}} & ".$density." & ");
    $kAttr = "select * from ClassAttribute where class = '$idfinal'";
    $qAttr = mysqli_query(connect(), $kAttr) or die("err fetch Attributi");
    fwrite($GLOBALS['densita'], mysqli_num_rows($qAttr)." & ");
    if($density>25 && mysqli_num_rows($qAttr)<16)
        fwrite($GLOBALS['densita'], "{\color{ForestGreen}Soddisfatto} \\\\ \n");
    else
        fwrite($GLOBALS['densita'], "{\color{red}Non soddisfatto} \\\\ \n");
}
fwrite($GLOBALS['densita'],"\\rowcolor{white} \n");
fwrite($GLOBALS['densita'],"\\caption{Soddisfacimento metriche: classi} \n");
fwrite($GLOBALS['densita'],"\\end{longtable} \n \n");

/*-------------------------------------------------------

          SODDISFACIMENTO METRICHE METODI 
          
-------------------------------------------------------*/

// fwrite($GLOBALS['densita'],"\\subsubsection{Soddisfacimento metriche: metodi} \n");
// fwrite($GLOBALS['densita'],"Per una rappresentazione più compatta della tabella, si descrive una legenda per
// indicare le voci rappresentate nelle colonne: \n
// \\begin{itemize} \n
// \\item textbf{P}: tale sigla verrà utilizzata per indicare il numero di parametri formali contenuti nella dichiarazione di un metodo; \n
// \\item textbf{C}: tale sigla verrà utilizzata per indicare l’indice di complessità ciclomatica di un metodo; \n
// \\item textbf{A}: tale sigla verrà utilizzata per indicare l’indice di annidamento di un metodo; \n
// \\item textbf{I}: tale sigla verrà utilizzata per indicare il numero di chiamate innestate di un metodo. \n \n");
// fwrite($GLOBALS['requisiti'],"\\setcounter{secnumdepth}{0} \n");
// fwrite($GLOBALS['requisiti'],"\\setcounter{tocdepth}{0} \n");
// 
// fwrite($GLOBALS['densita'],"\\vspace*{0.1em} \n");
// fwrite($GLOBALS['densita'],"\\def\arraystretch{1.5}");
// fwrite($GLOBALS['densita'],"\\rowcolors{2}{D}{P} \n");
// fwrite($GLOBALS['densita'],"\\begin{longtable}{p{4cm}!{\VRule[1pt]}p{1.5cm}!{\VRule[1pt]}p{1.5cm}!{\VRule[1pt]}p{1.5cm}!{\VRule[1pt]}p{1.5cm}!{\VRule[1pt]}p{2.5cm}} \n");
// fwrite($GLOBALS['densita'],"\\rowcolor{I} \n");
// fwrite($GLOBALS['densita'],"\\color{white} \\textbf{Metodo} & \color{white} \\textbf{P} & \color{white} \\textbf{C} & \color{white} \\textbf{A} & \color{white} \\textbf{I} & \color{white} \\textbf{Esito}\\\\ \n");
// fwrite($GLOBALS['densita'],"\\endfirsthead \n");
// fwrite($GLOBALS['densita'],"\\rowcolor{I} \n");
// fwrite($GLOBALS['densita'],"\\color{white} \\textbf{Metodo} & \color{white} \\textbf{P} & \color{white} \\textbf{C} & \color{white} \\textbf{A} & \color{white} \\textbf{I} & \color{white} \\textbf{Esito}\\\\ \n");
// fwrite($GLOBALS['densita'],"\\endhead \n");
// 
// 
// $kClass = "select * from Classi order by titolo";
// $qClass = mysqli_query(connect(), $kClass) or die("errore recupero classi");
// while($vClass = $qClass->fetch_array())
// {
//     if(substr($vClass[0],0,1) == "_")
//         $vTitoloCheckUnder = substr($vClass[0],1);
//     else
//         $vTitoloCheckUnder = $vClass[0];
//     fwrite($GLOBALS['package'], "\\myparcls{Classe \pkg{".$vClass[3]."::".$vTitoloCheckUnder."}}{\cls{".$vTitoloCheckUnder."}}\n");
//     $kMetodo = "select * from ClassMethod where class = '$vClass[0]'";
//     $qMetodo = mysqli_query(connect(), $kMetodo) or die("errore recupero metodi");
//     while($vMetodo = $qMetodo->fetch_array())
//     {
//         fwrite($GLOBALS['package'], $vMetodo[1]." & ");
//         
//     }
// }   
// 
// fwrite($GLOBALS['densita'],"\\rowcolor{white} \n");
// fwrite($GLOBALS['densita'],"\\caption{Soddisfacimento metriche: classi} \n");
// fwrite($GLOBALS['densita'],"\\end{longtable} \n \n");


echo "Funzia";
?>
<?
require_once('./__system.php');
/* ______________________________________
        

        CASI USO

________________________________________ */
global $casi;
$casi = fopen('../latex/casi.tex', 'w+')or die("file not found casi");

function standardVerbale($idVer){
    if($idVer == '2015-02-27') $newId = 'V20150227';
    else if($idVer == '2015-03-10') $newId = 'V20150310';
    else $newId = 'V20150413';
    return $newId;
}

function standardId($id){	
    $newId = "";
    if(substr($id,1,1)==0) $newId = 'R'.'O'.substr($id,2,strlen($id));
    else if(substr($id,1,1)==1) $newId = 'R'.'Z'.substr($id,2,strlen($id));
    else $newId = 'R'.'D'.substr($id,2,strlen($id));
    return $newId; 	
}

function stampaEstensioni($id){ //
    $k = "select * from CasiUso where padre = '$id' and estensione=1 order by length(idUC),idUC";
    $q = mysqli_query(connect(),$k) or die ("sfampa flussi err fava ");
    $conta = mysqli_num_rows($q);
    $i = 1;
    while($v = $q->fetch_array())
    {
        fwrite($GLOBALS['casi'],"\\item ".$v[2]." (".$v[0].")");
        if($i == $conta)
            fwrite($GLOBALS['casi'],".\n");
        else
            fwrite($GLOBALS['casi'],";\n");
        $i++;
    } 
}

function stampaFlussiEventi($id){
    $k = "select * from CasiUso where padre = '$id' and estensione=0 order by length(idUC),idUC";
    $q = mysqli_query(connect(),$k) or die ("sfampa flussi err fava ");
    $conta = mysqli_num_rows($q);
    $i = 1;
    while($v = $q->fetch_array())
    {
        fwrite($GLOBALS['casi'],"\\item ".$v[2]." (".$v[0].")");
        if($i == $conta)
            fwrite($GLOBALS['casi'],".\n");
        else
            fwrite($GLOBALS['casi'],";\n");
        $i++;
    }
}

function casiRic($id)
{
    $k = "select * from CasiUso where padre = '$id' order by length(idUC),idUC";
    $q = mysqli_query(connect(),$k)or die("err stampa figlio ".$k);
    while($v = $q->fetch_array())
    {
        fwrite($GLOBALS['casi'],"\\subsection{".$v[0]." ".$v['titolo']."}\n");
        if(!(is_null($v[9])) && $v[9]!="")
        {
            fwrite($GLOBALS['casi'],"\\begin{figure}[h!]\n");
            fwrite($GLOBALS['casi'],"\\centering \n");
            if($v[0]=='UC2' || $v[0]=='UC1' || $v[0]=='UC2.6' || $v[0]=='UC2.6.2' || $v[0]=='UC2.6.5.2.2')
                fwrite($GLOBALS['casi'],"\\includegraphics[width=1\\textwidth]{".$v[9]."}\n");
            else
                fwrite($GLOBALS['casi'],"\\includegraphics[scale=0.4]{".$v[9]."}\n");
            fwrite($GLOBALS['casi'],"\\caption{".$v[10]."}\n");
            fwrite($GLOBALS['casi'],"\\end{figure}\n");
        }
        fwrite($GLOBALS['casi'],"\\begin{itemize}\n");
        fwrite($GLOBALS['casi'],"\\item \\textbf{Attori}:");
        $k1 = "select idA from AttoriCasiUso where idUC = '$v[0]'";
        $q1 = mysqli_query(connect(),$k1)or die("errore stampa attori per caso".$k1);
        $count = mysqli_num_rows($q1);
        while($v1 = $q1->fetch_array())
        {
            fwrite($GLOBALS['casi']," ".$v1[0]);
            if($count > 1)
                fwrite($GLOBALS['casi'],", ");
            $count--;
        }
        fwrite($GLOBALS['casi'],".");
        fwrite($GLOBALS['casi'],"\n");
        $check = "select * from CasiUso where padre = '$v[0]'"; 
        $check_q = mysqli_query(connect(),$check) or die("errr controllo se ha figli");
        if($check_q && mysqli_num_rows($check_q)>0)
        {
            fwrite($GLOBALS['casi'],"\\item \\textbf{Scenario principale}:\n");
            fwrite($GLOBALS['casi'],"\\begin{enumerate}\n");
            stampaFlussiEventi($v[0]);
            fwrite($GLOBALS['casi'],"\\end{enumerate}\n");
        }
        if(!(is_null($v[11])) && $v[11]!="")
        fwrite($GLOBALS['casi'],"\\item \\textbf{Scenario principale}: ".$v[11]."\n");
        
        //SCENARI ALTERNATIVI
        if(!(is_null($v[12])) && $v[12]!="")
        {
            fwrite($GLOBALS['casi'],"\\item \\textbf{Scenari alternativi}:\n");
            fwrite($GLOBALS['casi'],"\\begin{itemize}\n");
            fwrite($GLOBALS['casi'],"\\item ".$v[12]);
            fwrite($GLOBALS['casi'],"\\end{itemize}\n");
        }
        $check = "select * from CasiUso where padre = '$v[0]' and estensione=1 "; 
        $check_q = mysqli_query(connect(),$check) or die("errr controllo se ha figli");
        if($check_q && mysqli_num_rows($check_q)>0)
        {
            fwrite($GLOBALS['casi'],"\\item \\textbf{Estensioni}:\n");
            fwrite($GLOBALS['casi'],"\\begin{itemize}\n");
            stampaEstensioni($v[0]);
            fwrite($GLOBALS['casi'],"\\end{itemize}\n");
        }
        fwrite($GLOBALS['casi'],"\\item \\textbf{Descrizione}: $v[3]\n");
        fwrite($GLOBALS['casi'],"\\item \\textbf{Precondizione}: $v[7]\n");
        fwrite($GLOBALS['casi'],"\\item \\textbf{Postcondizione}: $v[8]\n");
        fwrite($GLOBALS['casi'],"\\end{itemize}\n\n");
        casiRic($v[0]);
    }
}

$k = "select * from CasiUso where padre is NULL order by length(idUC),idUC";
$q = mysqli_query(connect(),$k)or die("errore latex ric ".$k);
while($v = $q->fetch_array())
{
    fwrite($GLOBALS['casi'],"\\subsection{".$v['idUC']." ".$v['titolo']."}\n");
    if(!(is_null($v[9])) && $v[9]!="")
    {
        fwrite($GLOBALS['casi'],"\\begin{figure}[h!]\n");
        fwrite($GLOBALS['casi'],"\\centering \n");
        if($v[0]=='UC2' || $v[0]=='UC1' || $v[0]=='UC2.6' || $v[0]=='UC2.6.2' || $v[0]=='UC2.6.5.2.2')
            fwrite($GLOBALS['casi'],"\\includegraphics[width=1\\textwidth]{".$v[9]."}\n");
        else
            fwrite($GLOBALS['casi'],"\\includegraphics[scale=0.3]{".$v[9]."}\n");
        fwrite($GLOBALS['casi'],"\\caption{".$v[10]."}\n");
        fwrite($GLOBALS['casi'],"\\end{figure}\n");
    }
    fwrite($GLOBALS['casi'],"\\begin{itemize}\n");
    fwrite($GLOBALS['casi'],"\\item \\textbf{Attori}:");
    $k1 = "select idA from AttoriCasiUso where idUC = '$v[0]'";
    $q1 = mysqli_query(connect(),$k1)or die("errore stampa attori per caso ( dad )".$k1);
    $count = mysqli_num_rows($q1);
        while($v1 = $q1->fetch_array())
        {
            fwrite($GLOBALS['casi']," ".$v1[0]);
            if($count > 1)
                fwrite($GLOBALS['casi'],", ");
            $count--;
        }
    fwrite($GLOBALS['casi'],".");
    fwrite($GLOBALS['casi'],"\n");
    $check = "select * from CasiUso where padre = '$v[0]'"; 
    $check_q = mysqli_query(connect(),$check) or die("errr controllo se ha figli");
    if($check_q && mysqli_num_rows($check_q)>0)
    {
        fwrite($GLOBALS['casi'],"\\item \\textbf{Scenario principale}:\n");
        fwrite($GLOBALS['casi'],"\\begin{enumerate}\n");
        stampaFlussiEventi($v[0]);
        fwrite($GLOBALS['casi'],"\\end{enumerate}\n");
    }
    if(!(is_null($v[11])) && $v[11]!="")
        fwrite($GLOBALS['casi'],"\\item \\textbf{Scenario principale}: ".$v[11]."\n");
        
    //SCENARI ALTERNATIVI
    if(!(is_null($v[12])) && $v[12]!="")
    {
        fwrite($GLOBALS['casi'],"\\item \\textbf{Scenari alternativi}:\n");
        fwrite($GLOBALS['casi'],"\\begin{itemize}\n");
        fwrite($GLOBALS['casi'],"\\item ".$v[12]);
        fwrite($GLOBALS['casi'],"\\end{itemize}\n");
    }
    $check = "select * from CasiUso where padre = '$v[0]' and estensione=1 order by length(idUC),idUC"; 
    $check_q = mysqli_query(connect(),$check) or die("errr controllo se ha figli");
    if($check_q && mysqli_num_rows($check_q)>0)
    {
        fwrite($GLOBALS['casi'],"\\item \\textbf{Estensioni}:\n");
        fwrite($GLOBALS['casi'],"\\begin{itemize}\n");
        stampaEstensioni($v[0]);
        fwrite($GLOBALS['casi'],"\\end{itemize}\n");
    }
    fwrite($GLOBALS['casi'],"\\item \\textbf{Descrizione}: $v[3]\n");
    fwrite($GLOBALS['casi'],"\\item \\textbf{Precondizione}: $v[7]\n");
    fwrite($GLOBALS['casi'],"\\item \\textbf{Postcondizione}: $v[8]\n");
    fwrite($GLOBALS['casi'],"\\end{itemize}\n\n");
    casiRic($v[0]);
}
fclose($casi);

/* ______________________________________
        

        REQUISITI

________________________________________ */


global $requisiti;
$requisiti = fopen('../latex/requisiti.tex', 'w+')or die("file not found requisi");
function requisitiRic($id,$type)
{
    $kRequisito = "select * from Requisiti where substr(idR,3,1)='$type' and padre = '$id' order by length(idR),substr(idR,3)";
    $qRequisito = mysqli_query(connect(),$kRequisito) or die ("err req F");
    while($vRequisito = $qRequisito->fetch_array())
    {
        // _________________________________________________________________________________TRASCRITTURA TIPOLOGIA REQUISITO
        if($type=='F') $tipo = 'Funzionale';
        else if($type=='P') $tipo = 'Prestazionale';
        else if($type=='Q') $tipo = 'Qualitativo';
        else $tipo = 'Vincolante';
        // _________________________________________________________________________________TRASCRIZIONE TIPOLOGIA 
        if(substr($vRequisito[0],1,1)==0) $imp = 'Obbligatorio';
        else if(substr($vRequisito[0],1,1)==1) $imp = 'Opzionale';
        else $imp = 'Desiderabile';
        // _________________________________________________________________________________SOSTITUZIONE 0 1 2 
        $idAggiornato; 
        if(substr($vRequisito[0],1,1)==0) $idAggiornato = 'R'.'O'.substr($vRequisito[0],2,strlen($vRequisito[0]));
        else if(substr($vRequisito[0],1,1)==1) $idAggiornato = 'R'.'Z'.substr($vRequisito[0],2,strlen($vRequisito[0]));
        else $idAggiornato = 'R'.'D'.substr($vRequisito[0],2,strlen($vRequisito[0]));
        fwrite($GLOBALS['requisiti'],$idAggiornato." & ".$tipo." ".$imp." & ".$vRequisito[2]." & ");
        $kCasi = "select idUC from RequisitiCasiUso where idR = '$vRequisito[0]'  order by length(idUC),idUC";
        $qCasi = mysqli_query(connect(),$kCasi) or die ("errore recupero casi associati ".$kCasi);
        while($vCasi = $qCasi->fetch_array())
        {
            fwrite($GLOBALS['requisiti'],$vCasi[0]." ");
        }
        while($vCasi = $qCasi->fetch_array())
        {
            fwrite($GLOBALS['requisiti'],$vCasi[0]." ");
        }
        $ei = 0;
        if($vRequisito[3]==1)
        {
                if(mysqli_num_rows($qCasi)>0)
                fwrite($GLOBALS['requisiti'],"\\newline Capitolato");
                else
                fwrite($GLOBALS['requisiti'],"Capitolato");
                $ei++;
        }
    
        //_________________________________________________________________________________INTERNO
        if($vRequisito[5]==1)
        {
                if(mysqli_num_rows($qCasi)>0)
                fwrite($GLOBALS['requisiti'],"\\newline Interna");
                else
                fwrite($GLOBALS['requisiti'],"Interna");
                $ei++;
        }
        
        // _________________________________________________________________________________VERBALE
        
        $primo = 0;
        $kVer = "select idV from Verbali as v, RequisitiVerbali as rv where v.data=rv.idV and rv.idR='$vRequisito[0]'"; 
        $qVer = mysqli_query(connect(),$kVer) or die ("errore recupero casi associati ".$kVer);
        if(mysqli_num_rows($qVer)>0)
        {
            while($vVer = $qVer->fetch_array())
            {
                if(mysqli_num_rows($qCasi)>0 || $ei>0)
                        fwrite($GLOBALS['requisiti'],"\\newline ".standardVerbale($vVer[0]));
                else
                {
                    if($primo=0)
                    {
                        fwrite($GLOBALS['requisiti'],standardVerbale($vVer[0]));
                        $primo++;
                    }
                    else
                        fwrite($GLOBALS['requisiti'],"\\newline ".standardVerbale($vVer[0]));
                }
            }
        }
        fwrite($GLOBALS['requisiti'],"\\\\ \n");
        
        requisitiRic($vRequisito[0],$type);
    }
}

function stampaRequisiti($type) {
    fwrite($GLOBALS['requisiti'],"\\setcounter{secnumdepth}{5} \n");
    fwrite($GLOBALS['requisiti'],"\\setcounter{tocdepth}{5} \n");
    if($type=='F') $tipoT = 'funzionali';
    else if($type=='P') $tipoT = 'prestazionali';
    else if($type=='Q') $tipoT = 'di qualità';
    else $tipoT = 'di vincolo';
    fwrite($GLOBALS['requisiti'],"\\vspace*{0.1em} \n");
    fwrite($GLOBALS['requisiti'],"\\section{Requisiti ".$tipoT."}\n");
    fwrite($GLOBALS['requisiti'],"\\def\arraystretch{1.5}\n");
    fwrite($GLOBALS['requisiti'],"\\rowcolors{2}{D}{P}\n");
    fwrite($GLOBALS['requisiti'],"\\begin{longtable}{p{2cm}!{\\VRule[1pt]}p{2cm}!{\\VRule[1pt]}p{6cm}!{\\VRule[1pt]}p{2.5cm}}\n");
    fwrite($GLOBALS['requisiti'],"\\rowcolor{I}\n");
    fwrite($GLOBALS['requisiti'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Tipologia} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Fonti} \\\\ \n");
    fwrite($GLOBALS['requisiti'],"\\endfirsthead \n");
    fwrite($GLOBALS['requisiti'],"\\rowcolor{I} \n");
    fwrite($GLOBALS['requisiti'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Tipologia} & \\color{white} \\textbf{Descrizione} & \\color{white} \\textbf{Fonti} \\\\ \n");
    fwrite($GLOBALS['requisiti'],"\\endhead \n");
    
    $kRequisito = "select * from Requisiti where substr(idR,3,1)='$type' and padre is NULL  order by length(idR),substr(idR,3)";
    $qRequisito = mysqli_query(connect(),$kRequisito) or die ("err req F");
    while($vRequisito = $qRequisito->fetch_array())
    {
        // _________________________________________________________________________________TRASCRITTURA TIPOLOGIA REQUISITO
        if($type=='F') $tipo = 'Funzionale';
        else if($type=='P') $tipo = 'Prestazionale';
        else if($type=='Q') $tipo = 'Qualitativo';
        else $tipo = 'Vincolante';
        // _________________________________________________________________________________TRASCRIZIONE TIPOLOGIA
        if(substr($vRequisito[0],1,1)==0) $imp = 'Obbligatorio';
        else if(substr($vRequisito[0],1,1)==1) $imp = 'Opzionale';
        else $imp = 'Desiderabile';
        // _________________________________________________________________________________SOSTITUZIONE 0 1 2 
        $idAggiornato; 
        if(substr($vRequisito[0],1,1)==0) $idAggiornato = 'R'.'O'.substr($vRequisito[0],2,strlen($vRequisito[0]));
        else if(substr($vRequisito[0],1,1)==1) $idAggiornato = 'R'.'Z'.substr($vRequisito[0],2,strlen($vRequisito[0]));
        else $idAggiornato = 'R'.'D'.substr($vRequisito[0],2,strlen($vRequisito[0]));
        fwrite($GLOBALS['requisiti'],$idAggiornato." & ".$tipo." ".$imp." & ".$vRequisito[2]." & ");
        $kCasi = "select idUC from RequisitiCasiUso where idR = '$vRequisito[0]'";
        $qCasi = mysqli_query(connect(),$kCasi) or die ("errore recupero casi associati ".$kCasi);
        while($vCasi = $qCasi->fetch_array())
            fwrite($GLOBALS['requisiti'],$vCasi[0]." ");
        
        $ei = 0;
        if($vRequisito[3]==1)
        {
                if(mysqli_num_rows($qCasi)>0)
                fwrite($GLOBALS['requisiti'],"\\newline Capitolato");
                else
                fwrite($GLOBALS['requisiti'],"Capitolato");
                $ei++;
        }
    
        // _________________________________________________________________________________INTERNO
        if($vRequisito[5]==1)
        {
                if(mysqli_num_rows($qCasi)>0)
                fwrite($GLOBALS['requisiti'],"\\newline Interna");
                else
                fwrite($GLOBALS['requisiti'],"Interna");
                $ei++;
        }
        
        // _________________________________________________________________________________VERBALE
        
        $kVer = "select idV from Verbali as v, RequisitiVerbali as rv where v.data=rv.idV and rv.idR='$vRequisito[0]'"; 
        $qVer = mysqli_query(connect(),$kVer) or die ("errore recupero casi associati ".$kVer);
        $primo = 0;
        if(mysqli_num_rows($qVer)>0)
        {
            while($vVer = $qVer->fetch_array())
            {
                if(mysqli_num_rows($qCasi)>0 || $ei>0)
                        fwrite($GLOBALS['requisiti'],"\\newline ".standardVerbale($vVer[0]));
                else
                {
                    if($primo=0)
                    {
                        fwrite($GLOBALS['requisiti'],standardVerbale($vVer[0]));
                        $primo++;
                    }
                    else
                        fwrite($GLOBALS['requisiti'],"\\newline ".standardVerbale($vVer[0]));
                }
            }
        }
        fwrite($GLOBALS['requisiti'],"\\\\ \n");      
        requisitiRic($vRequisito[0],$type);
    }
    fwrite($GLOBALS['requisiti'],"\\rowcolor{white} \n");
    fwrite($GLOBALS['requisiti'],"\\caption{Requisiti ".$tipoT."} \n");
    fwrite($GLOBALS['requisiti'],"\\end{longtable}\n\n\n");
}
stampaRequisiti('F');
stampaRequisiti('Q');
stampaRequisiti('V');
fclose($requisiti);

//TABELLA RIEPILOGO


global $requisitiFonte;
$requisitiFonte = fopen('../latex/requisitiFonte.tex', 'w+')or die("file not found requisiti Fonte");

$fO = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'F' and substr(idR,2,1) = 0 ";
$fD = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'F' and substr(idR,2,1) = 2 ";
$fZ = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'F' and substr(idR,2,1) = 1 ";

$pO = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'P' and substr(idR,2,1) = 0 ";
$pD = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'P' and substr(idR,2,1) = 2 ";
$pZ = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'P' and substr(idR,2,1) = 1 ";

$vO = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'V' and substr(idR,2,1) = 0 ";
$vD = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'V' and substr(idR,2,1) = 2 ";
$vZ = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'V' and substr(idR,2,1) = 1 ";

$qO = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'Q' and substr(idR,2,1) = 0 ";
$qD = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'Q' and substr(idR,2,1) = 2 ";
$qZ = "select count(idR) as totali from Requisiti where substr(idR,3,1) = 'Q' and substr(idR,2,1) = 1 ";

$qf0 = mysqli_query(connect(),$fO) or die("errore ".$fO);
$qf1 = mysqli_query(connect(),$fD) or die("errore ".$fD);
$qf2 = mysqli_query(connect(),$fZ) or die("errore ".$fZ);

$qp0 = mysqli_query(connect(),$pO) or die("errore ".$pO);
$qp1 = mysqli_query(connect(),$pD) or die("errore ".$pD);
$qp2 = mysqli_query(connect(),$pZ) or die("errore ".$pZ);

$qv0 = mysqli_query(connect(),$vO) or die("errore ".$vO);
$qv1 = mysqli_query(connect(),$vD) or die("errore ".$vD);
$qv2 = mysqli_query(connect(),$vZ) or die("errore ".$vZ);

$qq0 = mysqli_query(connect(),$qO) or die("errore ".$qO);
$qq1 = mysqli_query(connect(),$qD) or die("errore ".$qD);
$qq2 = mysqli_query(connect(),$qZ) or die("errore ".$qZ);

$vf0 = $qf0->fetch_array();
$vf1 = $qf1->fetch_array();
$vf2 = $qf2->fetch_array();

$vp0 = $qp0->fetch_array();
$vp1 = $qp1->fetch_array();
$vp2 = $qp2->fetch_array();

$vv0 = $qv0->fetch_array();
$vv1 = $qv1->fetch_array();
$vv2 = $qv2->fetch_array();

$vq0 = $qq0->fetch_array();
$vq1 = $qq1->fetch_array();
$vq2 = $qq2->fetch_array();

fwrite($GLOBALS['requisitiFonte'],"\\newpage \n");
fwrite($GLOBALS['requisitiFonte'],"\\section{Riepilogo} \n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{table}[h!] \n");
fwrite($GLOBALS['requisitiFonte'],"\\centering \n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5} \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{P}{D}\n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{tabular}{p{2cm}!{\VRule}p{2.5cm}!{\VRule}p{2.5cm}!{\VRule}p{2.5cm}!{\VRule}} \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Categoria} & \\color{white} \\textbf{Obbligatorio} & \\color{white} \\textbf{Desiderabile} & \\color{white} \\textbf{Opzionale}\\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"Funzionale & ".$vf0['totali']." & ".$vf1['totali']." & ".$vf2['totali']." \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"Prestazionale & ".$vp0['totali']." & ".$vp1['totali']." & ".$vp2['totali']." \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"Qualitativo & ".$vq0['totali']." & ".$vq1['totali']." & ".$vq2['totali']." \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"Vincolo & ".$vv0['totali']." & ".$vv1['totali']." & ".$vv2['totali']." \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{tabular} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Riepilogo dei requisiti}  \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{table} \n");

/* ______________________________________
        

        REQUISITI FONTE

________________________________________ */

function requisitiFonteRic($idReq)
{
    $kReqFonte = "select * from Requisiti where padre = '$idReq' order by length(idR),substr(idR,3)";
    $qReqFonte = mysqli_query(connect(),$kReqFonte)or die("err Reqqfonte figlio".$kReqFonte);
    while($vReqFonte = $qReqFonte->fetch_array())
    {
        fwrite($GLOBALS['requisitiFonte'],standardId($vReqFonte[0])." & ");
        $kCasi = "select idUC from RequisitiCasiUso where idR = '$vReqFonte[0]' order by length(idUC),idUC";
        $qCasi = mysqli_query(connect(),$kCasi) or die ("errore recupero casi associati ".$kCasi);
        while($vCasi = $qCasi->fetch_array())
            fwrite($GLOBALS['requisitiFonte'],$vCasi[0]." ");
        $kCap = "select * from Requisiti where idR = '$vReqFonte[0]'";
        $qCap = mysqli_query(connect(),$kCap) or die ("errore recupero capitolato ".$kCap);
        while($vCap = $qCap->fetch_array())
        {
            // ___________________________CAPITOLATO
            if($vCap[3]==1)
            {
                    if(mysqli_num_rows($qCasi)>0)
                    fwrite($GLOBALS['requisitiFonte'],"\\newline Capitolato");
                    else
                    fwrite($GLOBALS['requisitiFonte'],"Capitolato");
            }
        
            // ___________________________INTERNO
            if($vCap[5]==1)
            {
                    if(mysqli_num_rows($qCasi)>0)
                    fwrite($GLOBALS['requisitiFonte'],"\\newline Interna");
                    else
                    fwrite($GLOBALS['requisitiFonte'],"Interna");
            }
            
            // ___________________________VERBALE
            $kVer = "select idV from Verbali as v, RequisitiVerbali as rv where v.data=rv.idV and rv.idR='$vReqFonte[0]'"; 
            $qVer = mysqli_query(connect(),$kVer) or die ("errore recupero casi associati ".$kVer);
            $primo = 0;
            if(mysqli_num_rows($qVer)>0)
            {
                while($vVer = $qVer->fetch_array())
                {
                    if(mysqli_num_rows($qCasi)>0 || $ei>0)
                            fwrite($GLOBALS['requisitiFonte'],"\\newline ".standardVerbale($vVer[0]));
                    else
                    {
                        if($primo=0)
                        {
                            fwrite($GLOBALS['requisitiFonte'],standardVerbale($vVer[0]));
                            $primo++;
                        }
                        else
                            fwrite($GLOBALS['requisitiFonte'],"\\newline ".standardVerbale($vVer[0]));
                    }
                }
            }
            fwrite($GLOBALS['requisitiFonte'],"\\\\ \n");
        }
        requisitiFonteRic($vReqFonte[0]);
    }
}

function stampaRequisitiFonte($type)
{
    $kReqFonte = "select * from Requisiti where padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
    $qReqFonte = mysqli_query(connect(),$kReqFonte)or die("err Reqqfonte ".$kReqFonte);
    while($vReqFonte = $qReqFonte->fetch_array())
    {
        fwrite($GLOBALS['requisitiFonte'],standardId($vReqFonte[0])." & ");
        $kCasi = "select idUC from RequisitiCasiUso where idR = '$vReqFonte[0]' order by length(idUC),idUC";
        $qCasi = mysqli_query(connect(),$kCasi) or die ("errore recupero casi associati ".$kCasi);
        while($vCasi = $qCasi->fetch_array())
            fwrite($GLOBALS['requisitiFonte'],$vCasi[0]." ");
        $kCap = "select * from Requisiti where idR = '$vReqFonte[0]'";
        $qCap = mysqli_query(connect(),$kCap) or die ("errore recupero capitolato ".$kCap);
        while($vCap = $qCap->fetch_array())
        {
            // ___________________________CAPITOLATO
            if($vCap[3]==1)
            {
                    if(mysqli_num_rows($qCasi)>0)
                    fwrite($GLOBALS['requisitiFonte'],"\\newline Capitolato");
                    else
                    fwrite($GLOBALS['requisitiFonte'],"Capitolato");
            }
        
            // ___________________________INTERNO
            if($vCap[5]==1)
            {
                    if(mysqli_num_rows($qCasi)>0)
                    fwrite($GLOBALS['requisitiFonte'],"\\newline Interna");
                    else
                    fwrite($GLOBALS['requisitiFonte'],"Interna");
            }
            
            // ___________________________VERBALE
            $kVer = "select idV from Verbali as v, RequisitiVerbali as rv where v.data=rv.idV and rv.idR='$vReqFonte[0]'"; 
            $qVer = mysqli_query(connect(),$kVer) or die ("errore recupero casi associati ".$kVer);
            $primo = 0;
            if(mysqli_num_rows($qVer)>0)
            {
                while($vVer = $qVer->fetch_array())
                {
                    if(mysqli_num_rows($qCasi)>0 || $ei>0)
                            fwrite($GLOBALS['requisitiFonte'],"\\newline ".standardVerbale($vVer[0]));
                    else
                    {
                        if($primo=0)
                        {
                            fwrite($GLOBALS['requisitiFonte'],standardVerbale($vVer[0]));
                            $primo++;
                        }
                        else
                            fwrite($GLOBALS['requisitiFonte'],"\\newline ".standardVerbale($vVer[0]));
                    }
                }
            }
            fwrite($GLOBALS['requisitiFonte'],"\\\\ \n");
        }
        requisitiFonteRic($vReqFonte[0]);
    }
}

fwrite($GLOBALS['requisitiFonte'],"\\newpage \n");
fwrite($GLOBALS['requisitiFonte'],"\\section{Traccimento}\n");
fwrite($GLOBALS['requisitiFonte'],"\\subsection{Tracciamento requisiti-fonte} \n");
fwrite($GLOBALS['requisitiFonte'],"\\vspace*{0.1em} \n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{longtable}{p{4cm}!{\VRule[1pt]}p{4cm}!{\VRule[1pt]}} \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \color{white} \\textbf{Fonti} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endfirsthead \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \color{white} \\textbf{Fonti} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endhead \n");
stampaRequisitiFonte('F');
stampaRequisitiFonte('P');
stampaRequisitiFonte('Q');
stampaRequisitiFonte('V');
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{white} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Tracciamento requisiti-fonte} \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{longtable} \n \n");

/* ______________________________________
        

        FONTE REQUISITI

________________________________________ */

function fonteRequisitiCapitolatoRic($idReq,&$conta)
{
    $kCapReq = "select idR from Requisiti where capitolato = 1 and padre = '$idReq' order by length(idR),substr(idR,3)";
    $qCapReq = mysqli_query(connect(),$kCapReq)or die("err CapitolatoRequisiti ".$kCapReq);
    while($vCapReq = $qCapReq->fetch_array())
    {
        if($conta==0)
                fwrite($GLOBALS['requisitiFonte'],standardId($vCapReq[0]));
        else
                fwrite($GLOBALS['requisitiFonte']," \\newline \n".standardId($vCapReq[0]));
        $conta++;
    }
}

function fonteRequisitiCapitolato($type,&$conta)
{
    $kCapReq = "select idR from Requisiti where capitolato = 1 and padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
    $qCapReq = mysqli_query(connect(),$kCapReq)or die("err CapitolatoRequisiti ".$kCapReq);
    while($vCapReq = $qCapReq->fetch_array())
    {
        if($conta==0)
                fwrite($GLOBALS['requisitiFonte'],standardId($vCapReq[0]));
        else
                fwrite($GLOBALS['requisitiFonte']," \\newline \n".standardId($vCapReq[0]));
        $conta++;
        fonteRequisitiCapitolatoRic($vCapReq[0],$conta);
    }
}

function fonteRequisitiInternoRic($idReq,&$conta)
{
    $kIntReq = "select idR from Requisiti where interno = 1 and padre = '$idReq' order by length(idR),substr(idR,3)";
    $qIntReq = mysqli_query(connect(),$kIntReq)or die("err InternoRequisiti ".$kIntReq);
    while($vIntReq = $qIntReq->fetch_array())
    {
        if($conta==48)
        {
                fwrite($GLOBALS['requisitiFonte']," \\\\ \n \\rowcolor{white} & \\\\ \n Interna & ");
                $conta = 0;
        }
        if($conta==0)
        {
            fwrite($GLOBALS['requisitiFonte'],standardId($vIntReq[0]));
            $primo = false;
        }
        else
            fwrite($GLOBALS['requisitiFonte']," \\newline \n".standardId($vIntReq[0]));
        $conta++;
        fonteRequisitiInternoRic($vIntReq[0],$conta);
    }
}

function fonteRequisitiInterno($type,&$conta,&$primo)
{
    $kIntReq = "select idR from Requisiti where interno = 1 and padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
    $qIntReq = mysqli_query(connect(),$kIntReq)or die("err InternoRequisiti ".$kIntReq);

    while($vIntReq = $qIntReq->fetch_array())
    {
        if($conta==48)
        {
                fwrite($GLOBALS['requisitiFonte']," \\\\ \n \\rowcolor{white} & \\\\ \n Interna & ");
                $conta = 0;
        }
        if($primo || $conta==0)
        {
            fwrite($GLOBALS['requisitiFonte'],standardId($vIntReq[0]));
            $primo = false;
        }
        else
            fwrite($GLOBALS['requisitiFonte']," \\newline \n".standardId($vIntReq[0]));
        $conta++;
        fonteRequisitiInternoRic($vIntReq[0],$conta);
    }
}

function fonteRequisitiVerbaleRic($idReq,$data)
{
    
    $kVerReq = "select r.idR from Requisiti as r, RequisitiVerbali as rv where r.idR=rv.idR and rv.idV = '$data' and r.padre = '$idReq' order by length(r.idR),substr(r.idR,3)";
    $qVerReq = mysqli_query(connect(),$kVerReq)or die("err RequisitiVerbale ric ".$kVerReq);
    
    while($vVerReq = $qVerReq->fetch_array())
    {	
            fwrite($GLOBALS['requisitiFonte']," \\newline \n".standardId($vVerReq[0]));
        fonteRequisitiVerbaleRic($vVerReq[0],$data);
    }
        
}

function fonteRequisitiVerbale($data,&$primo)
{
    $kVerReq = "select r.idR from Requisiti as r, RequisitiVerbali as rv where r.idR=rv.idR and rv.idV = '$data' and r.padre is null order by length(r.idR),substr(r.idR,3)";
    $qVerReq = mysqli_query(connect(),$kVerReq)or die("err RequisitiVerbale ".$kVerReq);
    if(mysqli_num_rows($qVerReq)>0)
    {
        fwrite($GLOBALS['requisitiFonte'],standardVerbale($data)." & ");
        while($vVerReq = $qVerReq->fetch_array())
        {	
            if($primo)
            {
                fwrite($GLOBALS['requisitiFonte'],standardId($vVerReq[0]));
                $primo=false;
            }
            else
                fwrite($GLOBALS['requisitiFonte']," \\newline \n".standardId($vVerReq[0]));
            fonteRequisitiVerbaleRic($vVerReq[0],$data);
        }
        fwrite($GLOBALS['requisitiFonte']," \\\\ \n");
    }
}

fwrite($GLOBALS['requisitiFonte'],"\\newpage \n");
fwrite($GLOBALS['requisitiFonte'],"\\subsection{Tracciamento fonte-requisiti} \n");
fwrite($GLOBALS['requisitiFonte'],"\\vspace*{0.1em} \n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{longtable}{p{4cm}!{\VRule[1pt]}p{4cm}!{\VRule[1pt]}} \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Fonte} & \color{white} \\textbf{Requisiti} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endfirsthead \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Fonte} & \color{white} \\textbf{Requisiti} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endhead \n");

$conta = 0;
// ____________________________________________________________________________________________________________CASO CAPITOLATO
fwrite($GLOBALS['requisitiFonte'],"Capitolato & ");
fonteRequisitiCapitolato('F',$conta);
fonteRequisitiCapitolato('P',$conta);
fonteRequisitiCapitolato('Q',$conta);
fonteRequisitiCapitolato('V',$conta);
fwrite($GLOBALS['requisitiFonte']," \\\\ \n");
// ____________________________________________________________________________________________________________CASO INTERNO

$primo = true;
fwrite($GLOBALS['requisitiFonte'],"Interna & ");
fonteRequisitiInterno('F',$conta,$primo);
fonteRequisitiInterno('P',$conta,$primo);
fonteRequisitiInterno('Q',$conta,$primo);
fonteRequisitiInterno('V',$conta,$primo);
fwrite($GLOBALS['requisitiFonte']," \\\\ \n");

// ____________________________________________________________________________________________________________CASO VERBALE
$primo = true;
$kVerbale = "select data from Verbali";
$qVerbale = mysqli_query(connect(),$kVerbale)or die("err Recupero data verbale ".$kVerbale);
while($vVerbale = $qVerbale->fetch_array())
    fonteRequisitiVerbale($vVerbale[0],$primo);

// ____________________________________________________________________________________________________________CASO CASI D'USO

function fonteCasiRequisiti($idCaso)
{
    $kCasi = "select idUC from CasiUso where padre = '$idCaso' order by length(idUC),idUC";
    $qCasi = mysqli_query(connect(),$kCasi)or die("err recupero casi d'uso ".$kCasi);
    while($vCasi = $qCasi->fetch_array())
    {
        $kCasiReq = "select idR from RequisitiCasiUso where idUC = '$vCasi[0]' order by length(idR),idR";
        $qCasiReq = mysqli_query(connect(),$kCasiReq) or die ("errore recupero casi associati ".$kCasiReq);
        if(mysqli_num_rows($qCasiReq)>0)
        {
            fwrite($GLOBALS['requisitiFonte'],$vCasi[0]." & ");
            $primo = true;
            while($vCasiReq = $qCasiReq->fetch_array())
            {
                if(mysqli_num_rows($qCasiReq)>1)
                {
                        if($primo)
                        {
                        fwrite($GLOBALS['requisitiFonte'],standardId($vCasiReq[0]));
                        $primo = false;
                        }
                        else
                        fwrite($GLOBALS['requisitiFonte']," \\newline \n ".standardId($vCasiReq[0]));
                }
                else
                        fwrite($GLOBALS['requisitiFonte'],standardId($vCasiReq[0]));
            }
            fwrite($GLOBALS['requisitiFonte'],"\\\\ \n");
        }
        fonteCasiRequisiti($vCasi[0]);
    }
}

$kCasi = "select idUC from CasiUso where padre is null order by length(idUC),idUC";
$qCasi = mysqli_query(connect(),$kCasi)or die("err recupero casi d'uso ".$kCasi);
while($vCasi = $qCasi->fetch_array())
{
    $kCasiReq = "select idR from RequisitiCasiUso where idUC = '$vCasi[0]' order by length(idR),idR";
    $qCasiReq = mysqli_query(connect(),$kCasiReq) or die ("errore recupero casi associati ".$kCasiReq);
    if(mysqli_num_rows($qCasiReq)>0)
    {
        fwrite($GLOBALS['requisitiFonte'],$vCasi[0]." & ");
        $primo = true;
        while($vCasiReq = $qCasiReq->fetch_array())
        {
            if(mysqli_num_rows($qCasiReq)>1)
            {
                    if($primo)
                    {
                    fwrite($GLOBALS['requisitiFonte'],standardId($vCasiReq[0]));
                    $primo = false;
                    }
                    else
                    fwrite($GLOBALS['requisitiFonte']," \\newline \n ".standardId($vCasiReq[0]));
            }
            else
                    fwrite($GLOBALS['requisitiFonte'],standardId($vCasiReq[0]));
        }
        fwrite($GLOBALS['requisitiFonte'],"\\\\ \n");
    }
    fonteCasiRequisiti($vCasi[0]);
    
}
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{white} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Tracciamento fonte-requisiti} \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{longtable} \n");


// Tracciamento requisiti accettati

function requisitiAccettatiRic($id,$type,$priority){
    $kRequisito = "select * from Requisiti where substr(idR,3,1)='$type' and padre = '$id' order by length(idR),substr(idR,3)";
    $qRequisito = mysqli_query(connect(),$kRequisito) or die ("err req F");
    while($vRequisito = $qRequisito->fetch_array())
    {
        if(substr($vRequisito[0],1,1)==$priority)
        {
            fwrite($GLOBALS['requisitiFonte'], standardId($vRequisito[0])." & ".$vRequisito[2]." & ");
            if($vRequisito[6]==0)
                fwrite($GLOBALS['requisitiFonte'], "{\color{red}Non soddisfatto} \\\\ \n");
            else
                fwrite($GLOBALS['requisitiFonte'], "{\color{ForestGreen}Soddisfatto} \\\\ \n");  
        }   
        requisitiAccettatiRic($vRequisito[0],$type,$priority);
    }
}

function requisitiAccettati($type,$priority){ 
    $kRequisito = "select * from Requisiti where substr(idR,3,1)='$type' and padre is NULL  order by length(idR),substr(idR,3)";
    $qRequisito = mysqli_query(connect(),$kRequisito) or die ("err req requisiti accettati");
    while($vRequisito = $qRequisito->fetch_array())
    {
        if(substr($vRequisito[0],1,1)==$priority)
        {
            fwrite($GLOBALS['requisitiFonte'], standardId($vRequisito[0])." & ".$vRequisito[2]." & ");
            if($vRequisito[6]==0)
                fwrite($GLOBALS['requisitiFonte'], "{\color{red}Non soddisfatto} \\\\ \n");
            else
                fwrite($GLOBALS['requisitiFonte'], "{\color{ForestGreen}Soddisfatto} \\\\ \n");  
        }   
        requisitiAccettatiRic($vRequisito[0],$type,$priority);
    }
}

fwrite($GLOBALS['requisitiFonte'],"\\newpage \n");
fwrite($GLOBALS['requisitiFonte'],"\\subsection{Requisiti accettati}\n");

//-----------------------OBBLIGATORI---------------------

fwrite($GLOBALS['requisitiFonte'],"\\subsubsection{Requisiti obbligatori}\n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{D}{P}\n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{longtable}{p{3cm}!{\\VRule[1pt]}p{7cm}!{\\VRule[1pt]}p{3cm}!{\\VRule[1pt]}}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I}\n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descizione} & \\color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endfirsthead \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descizione} & \\color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endhead \n");
requisitiAccettati('F',0);
requisitiAccettati('P',0);
requisitiAccettati('Q',0);
requisitiAccettati('V',0);
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{white} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Requisiti obbligatori accettati} \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{longtable} \n");

//--------------DESIDERABILI-------------------

fwrite($GLOBALS['requisitiFonte'],"\\subsubsection{Requisiti desiderabili}\n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{D}{P}\n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{longtable}{p{3cm}!{\\VRule[1pt]}p{7cm}!{\\VRule[1pt]}p{3cm}!{\\VRule[1pt]}}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I}\n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descizione} & \\color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endfirsthead \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descizione} & \\color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endhead \n");
requisitiAccettati('F',2);
requisitiAccettati('P',2);
requisitiAccettati('Q',2);
requisitiAccettati('V',2);
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{white} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Requisiti desiderabili accettati} \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{longtable} \n");

//-------------------OPZIONIALI--------------------

fwrite($GLOBALS['requisitiFonte'],"\\subsubsection{Requisiti opzionali}\n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{D}{P}\n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{longtable}{p{3cm}!{\\VRule[1pt]}p{7cm}!{\\VRule[1pt]}p{3cm}!{\\VRule[1pt]}}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I}\n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descizione} & \\color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endfirsthead \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Descizione} & \\color{white} \\textbf{Esito} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endhead \n");
requisitiAccettati('F',1);
requisitiAccettati('P',1);
requisitiAccettati('Q',1);
requisitiAccettati('V',1);
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{white} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Requisiti opzionali accettati} \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{longtable} \n");



//-----------------------------TRACCIAMENTO REQUISITI-TEST----------------------------

function requisitiTestRic($id,$type){
    $kRequisito = "select * from Requisiti where substr(idR,3,1)='$type' and padre = '$id' order by length(idR),substr(idR,3)";
    $qRequisito = mysqli_query(connect(),$kRequisito) or die ("err recuper Requisiti");
    while($vRequisito = $qRequisito->fetch_array())
    {
        $kTestVal = "select * from RequirementTest where object = '$vRequisito[0]' and type = 'validation'";
        $qTestVal = mysqli_query(connect(), $kTestVal) or die("errore stampa validazione");
        
        $kTestSist = "select * from RequirementTest where object = '$vRequisito[0]' and type = 'system'";
        $qTestSist = mysqli_query(connect(), $kTestSist) or die("err test sistema");
        
        if(mysqli_num_rows($qTestVal)>0 || mysqli_num_rows($qTestSist)>0)
        {
            fwrite($GLOBALS['requisitiFonte'], standardId($vRequisito[0])." & ");
            if(mysqli_num_rows($qTestVal)>0)
            {
                while($vTestVal = $qTestVal->fetch_array())
                    fwrite($GLOBALS['requisitiFonte'], "TV".substr($vTestVal[1],2,strlen($vTestVal[1]))." & ");
            }
            else
                fwrite($GLOBALS['requisitiFonte'], " & ");
            
            if(mysqli_num_rows($qTestSist)>0)
            {    
                while($vTestSist = $qTestSist->fetch_array())
                    fwrite($GLOBALS['requisitiFonte'], "TS".substr($vTestSist[1],2,strlen($vTestSist[1]))." \\\\ \n ");
            }
            else
                fwrite($GLOBALS['requisitiFonte'], " \\\\ \n");
        }
        requisitiTestRic($vRequisito[0],$type);
    }
}

function requisitiTest($type){ 
    $kRequisito = "select * from Requisiti where substr(idR,3,1)='$type' and padre is NULL  order by length(idR),substr(idR,3)";
    $qRequisito = mysqli_query(connect(),$kRequisito) or die ("err req requisiti accettati");
    while($vRequisito = $qRequisito->fetch_array())
    {
        $kTestVal = "select * from RequirementTest where object = '$vRequisito[0]' and type = 'validation'";
        $qTestVal = mysqli_query(connect(), $kTestVal) or die("errore stampa validazione");
        
        $kTestSist = "select * from RequirementTest where object = '$vRequisito[0]' and type = 'system'";
        $qTestSist = mysqli_query(connect(), $kTestSist) or die("err test sistema");
        
        if(mysqli_num_rows($qTestVal)>0 || mysqli_num_rows($qTestSist)>0)
        {
            fwrite($GLOBALS['requisitiFonte'], standardId($vRequisito[0])." & ");
            if(mysqli_num_rows($qTestVal)>0)
            {
                while($vTestVal = $qTestVal->fetch_array())
                    fwrite($GLOBALS['requisitiFonte'], "TV".substr($vTestVal[1],2,strlen($vTestVal[1]))." & ");
            }
            else
                fwrite($GLOBALS['requisitiFonte'], " & ");
            
            if(mysqli_num_rows($qTestSist)>0)
            {    
                while($vTestSist = $qTestSist->fetch_array())
                    fwrite($GLOBALS['requisitiFonte'], "TS".substr($vTestSist[1],2,strlen($vTestSist[1]))." \\\\ \n ");
            }
            else
                fwrite($GLOBALS['requisitiFonte'], " \\\\ \n");
        }
        requisitiTestRic($vRequisito[0],$type);
    }
}

fwrite($GLOBALS['requisitiFonte'],"\\newpage \n");
fwrite($GLOBALS['requisitiFonte'],"\\subsection{Traccimento requisiti-test}\n");
fwrite($GLOBALS['requisitiFonte'],"In questa sezione vengono riportati test di sistema e test di validazione relativi ad ogni requisito. I requisiti di qualità non sono tracciati in quanto sono verificati costantemente durante tutto lo sviluppo del progetto. La descrizione dei singoli test è riportata nel \\PQdoc. \n");
fwrite($GLOBALS['requisitiFonte'],"\\def\arraystretch{1.5}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolors{2}{D}{P}\n");
fwrite($GLOBALS['requisitiFonte'],"\\begin{longtable}{p{3cm}!{\\VRule[1pt]}p{3cm}!{\\VRule[1pt]}p{3cm}!{\\VRule[1pt]}}\n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I}\n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Test validazione} & \\color{white} \\textbf{Test Sistema} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endfirsthead \n");
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{I} \n");
fwrite($GLOBALS['requisitiFonte'],"\\color{white} \\textbf{Requisito} & \\color{white} \\textbf{Test validazione} & \\color{white} \\textbf{Test Sistema} \\\\ \n");
fwrite($GLOBALS['requisitiFonte'],"\\endhead \n");
requisitiTest('F');
requisitiTest('V');
fwrite($GLOBALS['requisitiFonte'],"\\rowcolor{white} \n");
fwrite($GLOBALS['requisitiFonte'],"\\caption{Tracciamento requisiti-test} \n");
fwrite($GLOBALS['requisitiFonte'],"\\end{longtable} \n");

echo "Funzia";

fclose($requisitiFonte);
// RIUNIONE MASSIMA-------------------------------------------------------
$analisi='../latex/analisi.tex';
file_put_contents($analisi,'');
$casi='../latex/casi.tex';
$requisiti='../latex/requisiti.tex';
$requisitiFonte='../latex/requisitiFonte.tex';
$read_casi = file_get_contents($casi);
$read_requisiti = file_get_contents($requisiti);
$read_requisitiFonte = file_get_contents($requisitiFonte);
file_put_contents($analisi,$read_casi, FILE_APPEND);
file_put_contents($analisi,$read_requisiti,FILE_APPEND);
file_put_contents($analisi,$read_requisitiFonte,FILE_APPEND);

?>
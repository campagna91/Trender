<?
require_once('./__system.php');
/*_______________________________________

	PACKAGE

_______________________________________*/
global $package; 
$package = fopen('../latex/package.tex', 'w+') or die("file test not foud");
fwrite($GLOBALS['package'], "\\section{Componenti e classi}\n");

function stampaPackage($dad) {
    $k = "select * from Package where padre = '$dad'";
    $q = mysqli_query(connect(), $k) or die("err 1");
    while($v = $q->fetch_array())
    {
        fwrite($GLOBALS['package'], "\\subsection{Componente \\pkg{".$v[0]."}}\n");
        fwrite($GLOBALS['package'], "\\subsubsection{Informazioni sul package}\n");
        if(!preg_match("/(socket)|(fabric)|(impress)$/", $v[0]))
        {
            fwrite($GLOBALS['package'], "\\begin{figure}[h!] \n"); 
            fwrite($GLOBALS['package'], "\\centering\n"); 
            
            if($v[0] == "premi::client::editor::button" || $v[0] == "premi::client::core::home" || $v[0] == "premi::client::editor::container" || $v[0] == "premi::client::editor::menu" || $v[0] =="premi::client::editor::nav" || $v[0] =="premi::server::model")
                fwrite($GLOBALS['package'], "\\includegraphics[width=1\\textwidth]{");
            else
                fwrite($GLOBALS['package'], "\\includegraphics[scale=0.4]{");
            fwrite($GLOBALS['package'], "img/premi/"); 
            $arg = explode("::",$v[0]);
            $dim = count($arg);
            for($i=0;$i<$dim;$i++)
            {
                if($i<$dim-1)
                    fwrite($GLOBALS['package'], $arg[$i]."__");
                else
                    fwrite($GLOBALS['package'], $arg[$i]);
            }
            fwrite($GLOBALS['package'], "}\n");
            fwrite($GLOBALS['package'], "\\caption{Diagramma della componente \pkg{".$v[0]."}}\n"); 
            fwrite($GLOBALS['package'], "\\end{figure}\n");
        }
        fwrite($GLOBALS['package'], "\\begin{itemize}\n");
        fwrite($GLOBALS['package'], "\\item \\textbf{Descrizione}: ".$v[2].".\n");
        fwrite($GLOBALS['package'], "\\item \\textbf{Padre}: \\pkg{".$v[3]."}.\n");


//------------------ INTERAZIONE CON ALTRI COMPONENTI---------------------------------

        $kInteraction = "select * from PackageInteractions where packageA = '$v[0]'";
        $qInteraction = mysqli_query(connect(), $kInteraction)or die("err mvc2");
        $contaInteraction = mysqli_num_rows($qInteraction);
        if($contaInteraction) 
        {
            fwrite($GLOBALS['package'], "\\item\\textbf{Interazione con altri package}:\n");
            fwrite($GLOBALS['package'], "\\begin{itemize}\n");
        }
        $i = $contaInteraction; 
        while($vInteraction = $qInteraction->fetch_array())
        {
            $kSpero = "select descrizione from Package where titolo = '$vInteraction[1]'";
            $qSpero = mysqli_query(connect(), $kSpero) or die("err sper ".$kSpero);
            $vSpero = $qSpero->fetch_array();
            fwrite($GLOBALS['package'], "\\item \\pkg{".$vInteraction[1]."}: ".$vSpero[0]);
            $i--;
            if(!$i) 
                fwrite($GLOBALS['package'], ".\n");
            else 
                fwrite($GLOBALS['package'], ";\n");
        }
        if($contaInteraction) fwrite($GLOBALS['package'], "\\end{itemize}\n");


//----------------------- PACKAGE CONTENUTI--------------------------------------

        $kInherit = "select * from Package where padre = '$v[0]'";
        $qInherit = mysqli_query(connect(), $kInherit) or die("err 3");
        $contaInherit = mysqli_num_rows($qInherit);
        $i = $contaInherit;
        if($contaInherit > 0) 
        {
            fwrite($GLOBALS['package'], "\\item \\textbf{Package contenuti}:\n");
            fwrite($GLOBALS['package'], "\\begin{itemize}\n");
        }
        while($vInherit = $qInherit->fetch_array())
        {
            fwrite($GLOBALS['package'], "\\item \\pkg{".$vInherit[0]."}: ".$vInherit[2]);
            $i--;
            if($i) 
                fwrite($GLOBALS['package'], ";\n");
            else 
                fwrite($GLOBALS['package'], ".\n"); 
        }
        if($contaInherit) fwrite($GLOBALS['package'], "\\end{itemize}\n");
            fwrite($GLOBALS['package'], "\\end{itemize}\n");	// CHIUSURA ITEMIZE PACKAGE


//---------------------------- CLASSI-------------------------------------------------

        $kCheckClass = "select * from Classi where idP = '$v[0]'";
        $qCheckClass = mysqli_query(connect(), $kCheckClass) or die("err 4");
        if(mysqli_num_rows($qCheckClass))
        {
            fwrite($GLOBALS['package'], "\\subsubsection{Classi}\n");
            while($vCheckClass = $qCheckClass->fetch_array())
            {
                if(substr($vCheckClass[0],0,1) == "_")
                    $vTitoloCheckUnder = substr($vCheckClass[0],1);
                else
                    $vTitoloCheckUnder = $vCheckClass[0];
                fwrite($GLOBALS['package'], "\\myparcls{\pkg{".$v[0]."::".$vTitoloCheckUnder."}}{\cls{".$vTitoloCheckUnder."}}\n");
                fwrite($GLOBALS['package'], "\\begin{itemize}\n");
                fwrite($GLOBALS['package'], "\\item \\textbf{Descrizione}: ".$vCheckClass[1].".\n");
                fwrite($GLOBALS['package'], "\\item \\textbf{Utilizzo}: ".$vCheckClass[2].".\n");
                
                $kCheckEstende = "select * from Inheritance where sub = '$vCheckClass[0]'";
                $qCheckEstende = mysqli_query(connect(), $kCheckEstende) or die("err 4.5");
                if(mysqli_num_rows($qCheckEstende))
                {
                    fwrite($GLOBALS['package'], "\\item \\textbf{Estende}: \n");
                    fwrite($GLOBALS['package'], "\\begin{itemize}\n");
                    $contaEstende = mysqli_num_rows($qCheckEstende);
                    while($vCheckEstende = $qCheckEstende->fetch_array())
                    {
                    fwrite($GLOBALS['package'], "\\item \cls{".$vCheckEstende[0]."}");
                    $contaEstende--;
                    if($contaEstende==0)
                        fwrite($GLOBALS['package'],".\n");
                    else
                        fwrite($GLOBALS['package'],";\n"); 
                    }
                    fwrite($GLOBALS['package'], "\\end{itemize}\n"); 
                }

    //---------------------------- SOTTOCLASSI------------------------------------------------

                $kClassInherit = "select * from Inheritance where super = '$vCheckClass[0]'";
                $qClassInherit = mysqli_query(connect(), $kClassInherit)or die("err 5");
                $contaClassInherit = mysqli_num_rows($qClassInherit);
                if($contaClassInherit)
                {
                    fwrite($GLOBALS['package'], "\\item \\textbf{Sottoclassi}:\n");
                    fwrite($GLOBALS['package'], "\\begin{itemize}\n");
                    $contaSottoclassi = mysqli_num_rows($qClassInherit);
                    while($vClassInherit = $qClassInherit->fetch_array())
                    {
                        fwrite($GLOBALS['package'], "\\item \\cls{".$vClassInherit[1]."}");
                        $contaSottoclassi--;
                        if($contaSottoclassi==0)
                            fwrite($GLOBALS['package'],".\n");
                        else
                            fwrite($GLOBALS['package'],";\n");
                    }
                    fwrite($GLOBALS['package'], "\\end{itemize}\n");
                }

                $kRelaction = "select * from ClassRelactions where classA = '$vCheckClass[0]'";
                $qRelaction = mysqli_query(connect(), $kRelaction) or die("err 6");
                $contaRelaction = mysqli_num_rows($qRelaction);
                if($contaRelaction)
                {
                    fwrite($GLOBALS['package'], "\\item \\textbf{Relazioni con altre classi}:\n");	
                    fwrite($GLOBALS['package'], "\\begin{itemize}\n");
                    while($vRelaction = $qRelaction->fetch_array())
                    {
                        $checkUnder = substr($vRelaction[1],0,1);
                        if($checkUnder == "_")
                            $vRelactionCheckUnder = substr($vRelaction[1],1);
                        else
                            $vRelactionCheckUnder = $vRelaction[1];
                        $qRelazione = mysqli_query(connect(), "select descrizione from Classi where titolo = '$vRelactionCheckUnder'")or die("err 7");
                        $vRelazione = $qRelazione->fetch_array();
                        if($vRelaction[2]) 
                            fwrite($GLOBALS['package'], "\\item $\\rightarrow$ \\cls{".$vRelactionCheckUnder."}: ".$vRelazione[0]);
                        else 
                            fwrite($GLOBALS['package'], "\\item $\\leftarrow$ \\cls{".$vRelactionCheckUnder."}: ".$vRelazione[0]);
                        $contaRelaction--;
                        if($contaRelaction==0)
                            fwrite($GLOBALS['package'], ".");
                        else
                            fwrite($GLOBALS['package'], ";");
                //AGGIUNGERE CLASSI BASE (SU php classInheritance che contengono le le freccie inheritance).

                    }
                    fwrite($GLOBALS['package'], "\\end{itemize}\n");
                }
            fwrite($GLOBALS['package'], "\\end{itemize}\n\n");
            }
        }
        stampaPackage($v[0]);
    }
}

$kDad = "select * from Package where padre is NULL";
$qDad = mysqli_query(connect(), $kDad) or die("err 8");
while($vDad = $qDad->fetch_array())
    stampaPackage($vDad[0]);

<?
require_once('./__system.php');
/*_______________________________________

  PACKAGE

_______________________________________*/
global $definizione; 
$definizione = fopen('../latex/dpPackage.tex', 'w+') or die("file test not foud");
fwrite($GLOBALS['definizione'], "\\section{Specifica dei componenti}\n");

function stampaPackage($dad) {
  $k = "select * from Package where padre = '$dad'";
  $q = mysqli_query(connect(), $k) or die("err 1");
  while($v = $q->fetch_array())
  {
    fwrite($GLOBALS['definizione'], "\\subsection{Componente \\pkg{".$v[0]."}}\n");
    fwrite($GLOBALS['definizione'], "\\subsubsection{Informazioni sul Package}\n");
//     if(!preg_match("/(socket)|(fabric)|(impress)$/", $v[0]))
//     {
//     fwrite($GLOBALS['definizione'], "\\begin{figure}[h!] \n"); 
//     fwrite($GLOBALS['definizione'], "\\centering\n"); 

//     if($v[0] == "premi::client::editor::button" || $v[0] == "premi::client::core::home" || $v[0] == "premi::client::editor::container" || $v[0] == "premi::client::editor::menu" || $v[0] =="premi::client::editor::nav" || $v[0] =="premi::server::model")
//       fwrite($GLOBALS['definizione'], "\\includegraphics[width=1\\textwidth]{");
//     else
//     fwrite($GLOBALS['definizione'], "\\includegraphics[scale=0.4]{");
//       fwrite($GLOBALS['definizione'], "img/premi/"); 
//       $arg = explode("::",$v[0]);
//       $dim = count($arg);
//       for($i=0;$i<$dim;$i++)
//       {
//         if($i<$dim-1)
//           fwrite($GLOBALS['definizione'], $arg[$i]."__");
//         else
//           fwrite($GLOBALS['definizione'], $arg[$i]);
//       }
//       fwrite($GLOBALS['definizione'], "}\n");
//       fwrite($GLOBALS['definizione'], "\\caption{Diagramma della componente \pkg{".$v[0]."}}\n"); 
//       fwrite($GLOBALS['definizione'], "\\end{figure}\n");
//     }
    fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
    fwrite($GLOBALS['definizione'], "\\item \\textbf{Descrizione}: ".$v[2].".\n");
    fwrite($GLOBALS['definizione'], "\\item \\textbf{Padre}: \\pkg{".$v[3]."}.\n");


    // INTERAZIONE CON ALTRI COMPONENTI
    $kInteraction = "select * from PackageInteractions where packageA = '$v[0]'";
    $qInteraction = mysqli_query(connect(), $kInteraction) or die("err mvc2");
    $contaInteraction = mysqli_num_rows($qInteraction);
    if($contaInteraction) {
      fwrite($GLOBALS['definizione'], "\\item\\textbf{Interazione con altri package}:\n");
      fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
    }
    $i = $contaInteraction; 
    while($vInteraction = $qInteraction->fetch_array())
    {
      $kSpero = "select descrizione from Package where titolo = '$vInteraction[1]'";
      $qSpero = mysqli_query(connect(), $kSpero) or die("err sper ".$kSpero);
      $vSpero = $qSpero->fetch_array();
      fwrite($GLOBALS['definizione'], "\\item \\pkg{".$vInteraction[1]."}: ".$vSpero[0]);
      $i--;
      if(!$i) fwrite($GLOBALS['definizione'], ".\n");
      else fwrite($GLOBALS['definizione'], ";\n");
    }
    if($contaInteraction) fwrite($GLOBALS['definizione'], "\\end{itemize}\n");


    // PACKAGE CONTENUTI
    $kInherit = "select * from Package where padre = '$v[0]'";
    $qInherit = mysqli_query(connect(), $kInherit) or die("err 3");
    $contaInherit = mysqli_num_rows($qInherit);
    $i = $contaInherit;
    if($contaInherit > 0) {
      fwrite($GLOBALS['definizione'], "\\item \\textbf{Package contenuti}:\n");
      fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
    }
    while($vInherit = $qInherit->fetch_array())
    {
      fwrite($GLOBALS['definizione'], "\\item \\pkg{".$vInherit[0]."}: ".$vInherit[2]);
      $i--;
      if($i) fwrite($GLOBALS['definizione'], ";\n");
      else fwrite($GLOBALS['definizione'], ".\n"); 
    }
    if($contaInherit) fwrite($GLOBALS['definizione'], "\\end{itemize}\n");

    fwrite($GLOBALS['definizione'], "\\end{itemize}\n");  // CHIUSURA ITEMIZE PACKAGE


    // CLASSI
    $kCheckClass = "select * from Classi where idP = '$v[0]'";
    $qCheckClass = mysqli_query(connect(), $kCheckClass) or die("err 4");
    if(mysqli_num_rows($qCheckClass))
    {
      fwrite($GLOBALS['definizione'], "\\subsubsection{Classi}\n");
      while($vCheckClass = $qCheckClass->fetch_array())
      {
        if(substr($vCheckClass[0],0,1) == "_")
          $vTitoloCheckUnder = substr($vCheckClass[0],1);
        else
            $vTitoloCheckUnder = $vCheckClass[0];
        fwrite($GLOBALS['definizione'], "\\myparcls{\pkg{".$v[0]."::".$vTitoloCheckUnder."}}{\cls{".$vTitoloCheckUnder."}}\n");
        fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
        fwrite($GLOBALS['definizione'], "\\item \\textbf{Descrizione}: ".$vCheckClass[1].".\n");
        fwrite($GLOBALS['definizione'], "\\item \\textbf{Utilizzo}: ".$vCheckClass[2].".\n");
        
        //ATTRIBUTI
        $kAttribute = "select * from ClassAttribute where class = '$vCheckClass[0]'";
        $qAttribute = mysqli_query(connect(), $kAttribute) or die("err attributo");
        if(mysqli_num_rows($qAttribute))
        {
          fwrite($GLOBALS['definizione'], "\\subsubsection{Attributi}\n");
          fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
          while($vAttribute = $qAttribute->fetch_array())
          {
            fwrite($GLOBALS['definizione'], "\\item -\\attribute{".$vAttribute[1]."} : \\type{".$vAttribute[2]."}\n\n ".$vAttribute[3].".\n");
          }
          fwrite($GLOBALS['definizione'], "\\end{itemize}\n");
        }
        
        //METODI
        $kMethod = "select * from ClassMethod where class = '$vCheckClass[0]'";
        $qMethod = mysqli_query(connect(), $kMethod) or die("err metodi");
        if(mysqli_num_rows($qMethod))
        {
          fwrite($GLOBALS['definizione'], "\\subsubsection{Metodi}\n");
          fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
          while($vMethod = $qMethod->fetch_array())
          {
            fwrite($GLOBALS['definizione'], "\\item \\method{".$vMethod[1]."}(");
            if($vMethod[2]!="")
            {
              $arg = explode(";",$vMethod[2]);
              $dim = count($arg);
              for($i=0;$i<$dim-1;$i++)
              {
                $expl = explode(":",$arg[$i]);
                fwrite($GLOBALS['definizione'], "\\argument{".$expl[0]." : ".$expl[1]."}");
                if(($dim-$i-1)!=1)
                  fwrite($GLOBALS['definizione'], ", ");
              }
            }
            fwrite($GLOBALS['definizione'], ") : ".$vMethod[3]."\n\n".$vMethod[4]);
            if($vMethod[2]!="")
            {
              fwrite($GLOBALS['definizione'], "\n\n \\textbf{Argomenti}:");
              fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
              $arg = explode(";",$vMethod[2]);
              $dim = count($arg);
              for($i=0;$i<$dim-1;$i++)
              {
                $expl = explode(":",$arg[$i]);
                fwrite($GLOBALS['definizione'], "\\item \\argument{".$expl[0]."} : ".$expl[2].".");
              }
              fwrite($GLOBALS['definizione'], "\\end{itemize}\n");
            }
          }
          fwrite($GLOBALS['definizione'], "\\end{itemize}\n");
        }

        // SOTTOCLASSI
        $kClassInherit = "select * from Inheritance where super = '$vCheckClass[0]'";
        $qClassInherit = mysqli_query(connect(), $kClassInherit)or die("err 5");
        $contaClassInherit = mysqli_num_rows($qClassInherit);
        if($contaClassInherit)
        {
          fwrite($GLOBALS['definizione'], "\\item \\textbf{Sottoclassi}:\n");
          fwrite($GLOBALS['definizione'], "\\begin{itemize}\n");
          $contaSottoclassi = mysqli_num_rows($qClassInherit);
          while($vClassInherit = $qClassInherit->fetch_array())
          {
            fwrite($GLOBALS['definizione'], "\\item \\cls{".$vClassInherit[1]."}");
            $contaSottoclassi--;
            if($contaSottoclassi==0)
              fwrite($GLOBALS['definizione'],".\n");
            else
              fwrite($GLOBALS['definizione'],";\n");
          }
          fwrite($GLOBALS['definizione'], "\\end{itemize}\n");
        }
      fwrite($GLOBALS['definizione'], "\\end{itemize}\n\n");
      }     
    }
    stampaPackage($v[0]);
  }
}

$kDad = "select * from Package where padre is NULL";
$qDad = mysqli_query(connect(), $kDad) or die("err 8");
while($vDad = $qDad->fetch_array())
{
  stampaPackage($vDad[0]);
  echo "funzia";
}

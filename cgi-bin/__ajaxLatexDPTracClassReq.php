<?
require_once('./__system.php');
global $package; 
$package = fopen('../latex/DPtracciamento.tex', 'w+') or die("file test not foud");

function standardId($id){ 
  $newId = "";
  if(substr($id,1,1)==0) $newId = 'R'.'O'.substr($id,2,strlen($id));
  else if(substr($id,1,1)==1) $newId = 'R'.'Z'.substr($id,2,strlen($id));
  else $newId = 'R'.'D'.substr($id,2,strlen($id));
  return $newId;  
}
$conta = 0;
$primo;

function fetchRequisitiRic($package,$class,$req,$vTitoloCheckUnder){
  global $primo;
  global $conta;
  $kRequisiti = "select idR from Requisiti where padre = '$req' order by length(idR),substr(idR,3)";
  $qRequisiti = mysqli_query(connect(),$kRequisiti) or die ("errore recupero requisiti");
  while($vRequisiti = $qRequisiti->fetch_array())
  {
    $kClassReq = "select idR from RequirementClass where idC = '$class' and idR = '$vRequisiti[0]'";
    $qClassReq = mysqli_query(connect(),$kClassReq) or die ("errore recupero requisiti associati ric ".$class);
    if(mysqli_num_rows($qClassReq)>0)
    {
      while($vClassReq = $qClassReq->fetch_array())
      {
          if($conta==48)
          {
            fwrite($GLOBALS['package']," \\\\ \n \\rowcolor{white} & \\\\ \\newpage \n \pkg{\seqsplit{".$package."::".$vTitoloCheckUnder."}} & ");
            $conta = 0;
          }
          
          if($primo || $conta==0)
          {
            fwrite($GLOBALS['package'],standardId($vClassReq[0]));
            $primo = false;
          }
          else
            fwrite($GLOBALS['package']," \\newline \n ".standardId($vClassReq[0]));
          $conta++;
      }
    }
    fetchRequisitiRic($package,$class,$vRequisiti[0],$vTitoloCheckUnder);
  }
}

function fetchRequisiti($type,$package,$class,$vTitoloCheckUnder){
  global $primo;
  global $conta;
  $kRequisiti = "select * from Requisiti where padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
  $qRequisiti = mysqli_query(connect(),$kRequisiti) or die ("errore recupero requisiti");
  while($vRequisiti = $qRequisiti->fetch_array())
  {   
    $kClassReq = "select idR from RequirementClass where idC = '$class' and idR = '$vRequisiti[0]'";
    $qClassReq = mysqli_query(connect(),$kClassReq) or die ("errore recupero requisiti associati ".$class);
    if(mysqli_num_rows($qClassReq)>0)
    {
      while($vClassReq = $qClassReq->fetch_array())
      {
          if($conta==48)
          {
            fwrite($GLOBALS['package']," \\\\ \n \\rowcolor{white} & \\\\ \\newpage \n \pkg{\seqsplit{".$package."::".$vTitoloCheckUnder."}} & ");
            $conta = 0;
          }
          
          if($primo || $conta==0){
            fwrite($GLOBALS['package'],standardId($vClassReq[0]));
            $primo = false;
          }
          else
            fwrite($GLOBALS['package']," \\newline \n ".standardId($vClassReq[0]));
          $conta++;
      }
    }
    fetchRequisitiRic($package,$class,$vRequisiti[0],$vTitoloCheckUnder);
  }
}

//classi - requisiti
  fwrite($GLOBALS['package'],"\\subsection{Tracciamento componenti-requisiti} \n");
  fwrite($GLOBALS['package'],"\\vspace*{0.1em} \n");
  fwrite($GLOBALS['package'],"\\def\arraystretch{1.5}");
  fwrite($GLOBALS['package'],"\\rowcolors{2}{D}{P} \n");
  fwrite($GLOBALS['package'],"\\begin{longtable}{p{10cm}!{\VRule[1pt]}p{3cm}!{\VRule[1pt]}} \n");
  fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
  fwrite($GLOBALS['package'],"\\color{white} \\textbf{Classi} & \color{white} \\textbf{Requisiti} \\\\ \n");
  fwrite($GLOBALS['package'],"\\endfirsthead \n");
  fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
  fwrite($GLOBALS['package'],"\\color{white} \\textbf{Classi} & \color{white} \\textbf{Requisiti} \\\\ \n");
  fwrite($GLOBALS['package'],"\\endhead \n");
    
  $kClass = "select distinct idC from RequirementClass order by idP ";
  $qClass = mysqli_query(connect(),$kClass)or die("err recupero classe ".$kClass);
  while($vClass = $qClass->fetch_array())
  {
    if(substr($vClass[0],0,1) == "_")
      $vTitoloCheckUnder = substr($vClass[0],1);
    else
        $vTitoloCheckUnder = $vClass[0];
    $kPackage = "select distinct idP from RequirementClass where idC = '$vClass[0]'";
    $qPackage = mysqli_query(connect(),$kPackage)or die("err recupero classe ".$kPackage);
    while($vPackage = $qPackage->fetch_array())
    {
      $primo = true;
      fwrite($GLOBALS['package'],"\pkg{\seqsplit{".$vPackage[0]."::".$vTitoloCheckUnder."}} & ");
      fetchRequisiti('F',$vPackage[0],$vClass[0],$vTitoloCheckUnder);
      fetchRequisiti('P',$vPackage[0],$vClass[0],$vTitoloCheckUnder);
      fetchRequisiti('Q',$vPackage[0],$vClass[0],$vTitoloCheckUnder);
      fetchRequisiti('V',$vPackage[0],$vClass[0],$vTitoloCheckUnder);
      fwrite($GLOBALS['package'],"\\\\ \n");
    }
  }

  echo "funzia";
  fwrite($GLOBALS['package'],"\\rowcolor{white} \n");
  fwrite($GLOBALS['package'],"\\caption{Tracciamento classi-requisiti} \n");
  fwrite($GLOBALS['package'],"\\end{longtable} \n \n \n");

//requisiti classi-----------------------------------------------------------------------


  function RequisitiClassiRic($idReq)
  {
    $kReq = "select * from Requisiti where padre = '$idReq' order by length(idR),substr(idR,3)";
    $qReq = mysqli_query(connect(),$kReq)or die("err Reqqfonte figlio".$kReq);
    while($vReq = $qReq->fetch_array())
    {
      fwrite($GLOBALS['package'],standardId($vReq[0])." & ");
      $kReqClass = "select idC from RequirementClass where idR = '$vReq[0]' order by length(idP),idP";
      $qReqClass = mysqli_query(connect(),$kReqClass) or die ("errore recupero package associati ".$kReqClass);
      while($vReqClass = $qReqClass->fetch_array())
      {
        if(substr($vReqClass[0],0,1) == "_")
        $vTitoloCheckUnder = substr($vReqClass[0],1);
        else
            $vTitoloCheckUnder = $vReqClass[0];
        $kPackage = "select distinct idP from RequirementClass where idC = '$vReqClass[0]'";
        $qPackage = mysqli_query(connect(),$kPackage)or die("err recupero classe ".$kPackage);
        while($vPackage = $qPackage->fetch_array())
          fwrite($GLOBALS['package'],"\pkg{\seqsplit{".$vPackage[0]."::".$vTitoloCheckUnder."}} \\newline \n");
      }
      fwrite($GLOBALS['package'],$vReqPack[0]."\\\\ \n");
      RequisitiClassiRic($vReq[0]);
    }
  }
  
  function RequisitiClassi($type)
  {
    $kReq = "select * from Requisiti where padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
    $qReq = mysqli_query(connect(),$kReq)or die("err Reqqfonte ".$kReq);
    while($vReq = $qReq->fetch_array())
    {
      fwrite($GLOBALS['package'],standardId($vReq[0])." & ");
      $kReqClass = "select idC from RequirementClass where idR = '$vReq[0]' order by length(idP),idP";
      $qReqClass = mysqli_query(connect(),$kReqClass) or die ("errore recupero classi associate ".$kReqClass);
      while($vReqClass = $qReqClass->fetch_array())
      {
        if(substr($vReqClass[0],0,1) == "_")
        $vTitoloCheckUnder = substr($vReqClass[0],1);
        else
            $vTitoloCheckUnder = $vReqClass[0];
        $kPackage = "select distinct idP from RequirementClass where idC = '$vReqClass[0]'";
        $qPackage = mysqli_query(connect(),$kPackage)or die("err recupero classe ".$kPackage);
        while($vPackage = $qPackage->fetch_array())
          fwrite($GLOBALS['package'],"\pkg{\seqsplit{".$vPackage[0]."::".$vTitoloCheckUnder."}} \\newline \n");
      }
      fwrite($GLOBALS['package'],$vReqClass[0]."\\\\ \n");
      RequisitiClassiRic($vReq[0]);
    }
  }
  
fwrite($GLOBALS['package'],"\\newpage \n");
fwrite($GLOBALS['package'],"\\newpage \n");
fwrite($GLOBALS['package'],"\\subsection{Tracciamento requisiti-classi} \n");
fwrite($GLOBALS['package'],"\\vspace*{0.1em} \n");
fwrite($GLOBALS['package'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['package'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['package'],"\\begin{longtable}{p{2.5cm}!{\VRule[1pt]}p{10cm}!{\VRule[1pt]}} \n");
fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
fwrite($GLOBALS['package'],"\\color{white} \\textbf{Requisiti} & \color{white} \\textbf{Classi} \\\\ \n");
fwrite($GLOBALS['package'],"\\endfirsthead \n");
fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
fwrite($GLOBALS['package'],"\\color{white} \\textbf{Requisiti} & \color{white} \\textbf{Classi} \\\\ \n");
fwrite($GLOBALS['package'],"\\endhead \n");
RequisitiClassi('F');
RequisitiClassi('P');
RequisitiClassi('Q');
//RequisitiClassi('V');
fwrite($GLOBALS['package'],"\\rowcolor{white} \n");
fwrite($GLOBALS['package'],"\\caption{Tracciamento requisiti-classi} \n");
fwrite($GLOBALS['package'],"\\end{longtable} \n \n");

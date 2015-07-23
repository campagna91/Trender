<?
require_once('./__system.php');
global $package; 
$package = fopen('../latex/tracciamento.tex', 'w+') or die("file test not foud");

function standardId($id){ 
  $newId = "";
  if(substr($id,1,1)==0) $newId = 'R'.'O'.substr($id,2,strlen($id));
  else if(substr($id,1,1)==1) $newId = 'R'.'Z'.substr($id,2,strlen($id));
  else $newId = 'R'.'D'.substr($id,2,strlen($id));
  return $newId;  
}
$conta = 0;
$primo;

function fetchRequisitiRic($package,$req){
  global $primo;
  global $conta;
  $kRequisiti = "select idR from Requisiti where padre = '$req' order by length(idR),substr(idR,3)";
  $qRequisiti = mysqli_query(connect(),$kRequisiti) or die ("errore recupero requisiti");
  while($vRequisiti = $qRequisiti->fetch_array())
  {
    $kPackReq = "select idR from PackageRequirement where idP = '$package' and idR = '$vRequisiti[0]'";
    $qPackReq = mysqli_query(connect(),$kPackReq) or die ("errore recupero casi associati ".$package);
    if(mysqli_num_rows($qPackReq)>0)
    {
      while($vPackReq = $qPackReq->fetch_array())
      {
          if($conta==48)
          {
            fwrite($GLOBALS['package']," \\\\ \n \\rowcolor{white} & \\\\ \\newpage \n \pkg{\seqsplit{".$package."}} & ");
            $conta = 0;
          }
          
          if($primo || $conta==0)
          {
            fwrite($GLOBALS['package'],standardId($vPackReq[0]));
            $primo = false;
          }
          else
            fwrite($GLOBALS['package']," \\newline \n ".standardId($vPackReq[0]));
          $conta++;
      }
    }
    fetchRequisitiRic($package,$vRequisiti[0]);
  }
}

function fetchRequisiti($type,$package){
  global $primo;
  global $conta;
  $kRequisiti = "select * from Requisiti where padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
  $qRequisiti = mysqli_query(connect(),$kRequisiti) or die ("errore recupero requisiti");
  while($vRequisiti = $qRequisiti->fetch_array())
  {   
    $kPackReq = "select idR from PackageRequirement where idP = '$package' and idR = '$vRequisiti[0]'";
    $qPackReq = mysqli_query(connect(),$kPackReq) or die ("errore recupero casi associati ".$package);
    if(mysqli_num_rows($qPackReq)>0)
    {
      while($vPackReq = $qPackReq->fetch_array())
      {
          if($conta==48)
          {
            fwrite($GLOBALS['package']," \\\\ \n \\rowcolor{white} & \\\\ \\newpage \n \pkg{\seqsplit{".$package."}} & ");
            $conta = 0;
          }
          
          if($primo || $conta==0)
          {
            fwrite($GLOBALS['package'],standardId($vPackReq[0]));
            $primo = false;
          }
          else
            fwrite($GLOBALS['package']," \\newline \n ".standardId($vPackReq[0]));
          $conta++;
      }
    }
    fetchRequisitiRic($package,$vRequisiti[0]);
  }
}

//componenti - requisiti
  fwrite($GLOBALS['package'],"\\newpage \n");
  fwrite($GLOBALS['package'],"\\subsection{Tracciamento componenti-requisiti} \n");
  fwrite($GLOBALS['package'],"\\vspace*{0.1em} \n");
  fwrite($GLOBALS['package'],"\\def\arraystretch{1.5}");
  fwrite($GLOBALS['package'],"\\rowcolors{2}{D}{P} \n");
  fwrite($GLOBALS['package'],"\\begin{longtable}{p{5cm}!{\VRule[1pt]}p{5cm}!{\VRule[1pt]}} \n");
  fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
  fwrite($GLOBALS['package'],"\\color{white} \\textbf{Componenti} & \color{white} \\textbf{Requisiti} \\\\ \n");
  fwrite($GLOBALS['package'],"\\endfirsthead \n");
  fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
  fwrite($GLOBALS['package'],"\\color{white} \\textbf{Componenti} & \color{white} \\textbf{Requisiti} \\\\ \n");
  fwrite($GLOBALS['package'],"\\endhead \n");
    
  $kPackage = "select distinct idP from PackageRequirement order by idP ";
  $qPackage = mysqli_query(connect(),$kPackage)or die("err recupero casi d'uso ".$kPackage);
  echo "mario";
  while($vPackage = $qPackage->fetch_array())
  {
    $primo = true;
    fwrite($GLOBALS['package'],"\pkg{\seqsplit{".$vPackage[0]."}} & ");
    fetchRequisiti('F',$vPackage[0]);
    fetchRequisiti('P',$vPackage[0]);
    fetchRequisiti('Q',$vPackage[0]);
    fetchRequisiti('V',$vPackage[0]);
    fwrite($GLOBALS['package'],"\\\\ \n");
  }

  
  fwrite($GLOBALS['package'],"\\rowcolor{white} \n");
  fwrite($GLOBALS['package'],"\\caption{Tracciamento componenti-requisiti} \n");
  fwrite($GLOBALS['package'],"\\end{longtable} \n \n \n");

//requisiti componenti


  function RequisitiPackageRic($idReq)
  {
    $kReq = "select * from Requisiti where padre = '$idReq' order by length(idR),substr(idR,3)";
    $qReq = mysqli_query(connect(),$kReq)or die("err Reqqfonte figlio".$kReq);
    while($vReq = $qReq->fetch_array())
    {
      fwrite($GLOBALS['package'],standardId($vReq[0])." & ".$vReq[2]." & ");
      $kReqPack = "select idP from PackageRequirement where idR = '$vReq[0]' order by length(idP),idP";
      $qReqPack = mysqli_query(connect(),$kReqPack) or die ("errore recupero package associati ".$kReqPack);
      while($vReqPack = $qReqPack->fetch_array())
        fwrite($GLOBALS['package'],"\pkg{\seqsplit{".$vReqPack[0]."}} \\newline \n");
      fwrite($GLOBALS['package'],$vReqPack[0]."\\\\ \n");
      RequisitiPackageRic($vReq[0]);
    }
  }
  
  function RequisitiPackage($type)
  {
    $kReq = "select * from Requisiti where padre is null and substr(idR,3,1) = '$type' order by length(idR),substr(idR,3)";
    $qReq = mysqli_query(connect(),$kReq)or die("err Reqqfonte ".$kReq);
    while($vReq = $qReq->fetch_array())
    {
      fwrite($GLOBALS['package'],standardId($vReq[0])." & ".$vReq[2]." & ");
      $kReqPack = "select idP from PackageRequirement where idR = '$vReq[0]' order by length(idP),idP";
      $qReqPack = mysqli_query(connect(),$kReqPack) or die ("errore recupero package associati ".$kReqPack);
      while($vReqPack = $qReqPack->fetch_array())
        fwrite($GLOBALS['package'],"\pkg{\seqsplit{".$vReqPack[0]."}} \\newline \n");
      fwrite($GLOBALS['package'],$vReqPack[0]."\\\\ \n");
      RequisitiPackageRic($vReq[0]);
    }
  }
  
fwrite($GLOBALS['package'],"\\newpage \n");
fwrite($GLOBALS['package'],"\\subsection{Tracciamento requisiti-componenti} \n");
fwrite($GLOBALS['package'],"\\vspace*{0.1em} \n");
fwrite($GLOBALS['package'],"\\def\arraystretch{1.5}");
fwrite($GLOBALS['package'],"\\rowcolors{2}{D}{P} \n");
fwrite($GLOBALS['package'],"\\begin{longtable}{p{2cm}!{\VRule}p{5cm}!{\VRule}p{5cm}!{\VRule}}  \n");
fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
fwrite($GLOBALS['package'],"\\color{white} \\textbf{Requisito} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Componenti}\\\\ \n");
fwrite($GLOBALS['package'],"\\endfirsthead \n");
fwrite($GLOBALS['package'],"\\rowcolor{I} \n");
fwrite($GLOBALS['package'],"\\color{white} \\textbf{Requisito} & \color{white} \\textbf{Descrizione} & \color{white} \\textbf{Componenti}\\\\ \n");
fwrite($GLOBALS['package'],"\\endhead \n");
RequisitiPackage('F');
RequisitiPackage('P');
RequisitiPackage('Q');
//RequisitiPackage('V');
fwrite($GLOBALS['package'],"\\rowcolor{white} \n");
fwrite($GLOBALS['package'],"\\caption{Tracciamento requisiti-componenti} \n");
fwrite($GLOBALS['package'],"\\end{longtable} \n \n");

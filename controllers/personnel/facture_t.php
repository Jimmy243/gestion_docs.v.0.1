<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function setFactureTrait($url)
{ 
  authentification($url);
  $db = Connecter();
  $data = json_decode(file_get_contents('php://input'),true);

  if(empty($data['IdF'])){
      echo json_encode([ "error" => "L'identifiant de cette Facture n'existe pas"]);
      exit;
  }
  if(empty($data['Motif'])){
    echo json_encode([ "error" => "Completez le motif de cette facture SVP !"]);
    exit;
 }
  $IdF = htmlspecialchars(trim($data['IdF']));
  $Motif = htmlspecialchars(trim($data['Motif']));

  $db = Connecter();
  $sql1 ="SELECT DateEnreg FROM facture WHERE IdF=?";
  $req1= $db->prepare($sql1);
  $req1->execute(array($IdF));
  $data1 = $req1->fetch();
  if(empty($data1)){
    echo json_encode([ "error" => "L'Indentifiant de cette Facture n'existe pas."]);
    exit;
  }

  $DateEnreg = $data1['DateEnreg'];
  $date = new DateTime($DateEnreg);
  $dateNow = new DateTime("NOW");
  $interval = $date->diff($dateNow);
  $days = $interval->format('%a');
  $Pourcentage = 0;
  switch ($days) {
    case 0: $Pourcentage = 100; break;
    case 1: $Pourcentage = 80; break;
    case 2: $Pourcentage = 60; break;
    case 3: $Pourcentage = 40; break;
    case 4: $Pourcentage = 20; break;
    default: echo json_encode([ "error" => "Cette Facture a deja depasse le delai du traitement"]); exit;
  }

  $sql2 ="SELECT IdF FROM facture_traitee WHERE IdF=?";
  $req2= $db->prepare($sql2);
  $req2->execute(array($IdF));
  $data2 = $req2->fetch();
  if(!empty($data2)){
    echo json_encode([ "error" => "Cette Facture a ete deja traite"]);
    exit;
  }

  $sql3 = "INSERT INTO facture_traitee (IdF,Motif,Pourcentage)VALUES(?,?,?)";
  try{
    $req3=$db->prepare($sql3);
    $data3=$req3->execute(array($IdF,$Motif,$Pourcentage));
    $trait = !$data3? ["error" => 'Echec du traitement de facture !']:["message" => "La facture a ete traite avec succes"];
    echo json_encode($trait);
  }catch(Exception $th){
      echo json_encode(["auth" => $th]);
  }

}
 setFactureTrait($url);

// $jour = '2010-09-17';
// $date = new DateTime($jour);
// $date->add(new DateInterval('P1D')); // P1D veut dire 1 Jour, P2D veut dire 2 jours ...
// $notreDate = $date->format('Y-m-d'); // ensuite ici on le formate au format voulu
// echo $notreDate; // Affichage du resutlat

// Pourcentage
?>
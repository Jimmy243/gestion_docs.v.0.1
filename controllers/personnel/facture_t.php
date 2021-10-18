<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function setFactureTrait($url)
{ 
  echo "Ok";
  exit;
  authentification($url);
  $db = Connecter();
  $data = json_decode(file_get_contents('php://input'),true);

  if(empty($_POST['IdF'])){
      echo json_encode([
          "error" => "L'identifiant de cette Facture n'existe pas";
      ]);
      exit;
  }
  if(empty($_POST['Motif'])){
    echo json_encode([
        "error" => "Completez le motif de cette facture SVP !";
    ]);
    exit;
 }
  $IdF = htmlspecialchars(trim($_POST['IdF']));
  $Motif = htmlspecialchars(trim($_POST['Motif']));
  $db = Connecter();
  $sql1 ="SELECT * FROM facture WHERE IdF=?";
  $req1= $db->prepare($sql1);
  $req1->execute(array($IdF));
  $data1 = $req1->fetch();
  if(empty($data1)){
     echo json_encode([
         "error" => " L'indentifiant de cette Facture n'existe pas ";
     ]);
     exit;
  }

  $sql2 = "INSERT INTO facture_traitee(IdF,Motif)VALUES(?,?)";
  try{
    $req2=$db->prepare($sql2);
    $data2=$req2->execute(array($IdF,$Motif));
    $trait = !$data2? [
      "error" => 'Echec du traitement de facture !'
    ];
    echo json_encode($trait);
  }catch(Exept $th){
      echo json_encode(["auth" => $th]);
  }

}
 setFactureTrait($url);
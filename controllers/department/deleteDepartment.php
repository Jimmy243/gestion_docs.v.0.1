<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";

function setDepartment(){ 
  header('Content-Type:application/json');
  $data = json_decode(file_get_contents('php://input'),true);
  if(empty($data['IdD'])){
    $tab = [
      "error" => "L'identifiant de ce departement est inconnu."
    ];
    echo json_encode($tab);
    exit;
  }
  $db = Connecter();
  $IdD = htmlspecialchars(trim($data['IdD']));
  $sql1 = "SELECT IdD FROM department WHERE IdD=?";
  $req1 =$db->prepare($sql1);
  $req1->execute(array($IdD));
  $data1 = $req1->fetch();

  if(empty($data1)){
    $tab = [
      "error" => "Le Departement que vous voulez supprimer n'existe pas."
    ];
    echo json_encode($tab);
    exit;
  }

  $sql2 = "DELETE FROM department WHERE IdD=?";
  $req2 =$db->prepare($sql2);
  $data2 =$req2->execute(array($IdD));
  
  if(!empty($data2))
  {
    $tab = [
      "message" => "Le Departement a ete supprime avec succes."
    ];
    echo json_encode($tab);
    exit;
  }else{
    $tab = [
      "error" => "Le Departement n'a pas ete supprime."
    ];
    echo json_encode($tab);
    exit;
  }
}

setDepartment();
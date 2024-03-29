<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function setDepartment($url){ 
  authentification($url);
  $data = json_decode(file_get_contents('php://input'),true);
  if(empty($data['NameD'])){
    $tab = [
      "erreur" => "Veuillez entrer le nom de departement."
    ];
    echo json_encode($tab);
    exit;
  }
  $db = Connecter();
  $NameD = htmlspecialchars(trim($data['NameD']));
  $sql1 = "SELECT IdD FROM department WHERE NameD=?";
  $req1 =$db->prepare($sql1);
  $req1->execute(array($NameD));
  $data1 = $req1->fetch();

  if(!empty($data1)){
    $tab = [
      "error" => "Le Departement que vous venez d'ajouter existe deja."
    ];
    echo json_encode($tab);
    exit;
  }


  $sql2 = "INSERT INTO department (NameD) VALUE(?)";
  $req2 =$db->prepare($sql2);
  $data2 =$req2->execute(array($NameD));
  
  if(!empty($data2))
  {
    $tab = [
      "message" => "Le Departement a ete enregistre avec succes."
    ];
    echo json_encode($tab);
    exit;
  }else{
    $tab = [
      "error" => "Le Departement n'a pas ete enregistre."
    ];
    echo json_encode($tab);
    exit;
  }
}

setDepartment($url);
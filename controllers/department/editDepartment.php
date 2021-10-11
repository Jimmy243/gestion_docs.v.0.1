<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";

function editDepartment(){ 
  header('Content-Type:application/json');
  $data = json_decode(file_get_contents('php://input'),true);

  // test if NameD exist
  if(empty($data['NameD'])){
    $tab = [
      "error" => "Veuillez entrer le nom du departement."
    ];
    echo json_encode($tab);
    exit;
  }
  // test if IdD exist
  if(empty($data['IdD'])){
    $tab = [
      "error" => "L'identifiant de ce departement est inconnu."
    ];
    echo json_encode($tab);
    exit;
  }
  
  $db = Connecter();
  $NameD = htmlspecialchars(trim($data['NameD']));
  $IdD = htmlspecialchars(trim($data['IdD']));

  // test if department exist before updating

  $sql1 = "SELECT IdD FROM department WHERE IdD=$IdD";
  $req1 = $db->query($sql1);
  $data1 = $req1->fetch();
  if(empty($data1)){
    $tab = [
      "error" => "Le departement n'existe pas. Si le probleme persiste, essayez de rafraichir la page."
    ];
    echo json_encode($tab);
    exit;
  }


  $sql2 = "SELECT IdD FROM department WHERE NameD='$NameD' AND IdD!=$IdD";
  $req2 = $db->query($sql2);
  $data2 = $req2->fetch();
  if(!empty($data2)){
    $tab = [
      "error" => "Un autre Departement possede ce nom '$NameD'. Deux Departements ne peuvent pas avoir deux noms similaires."
    ];
    echo json_encode($tab);
    exit;
  }


  $sql3 = "UPDATE department SET NameD =? WHERE IdD=$IdD";
  $req3 =$db->prepare($sql3);
  $data3 =$req3->execute(array($NameD));
  
  if(!empty($data3))
  {
    $tab = [
      "message" => "Le Departement a ete modifie avec succes."
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

editDepartment();
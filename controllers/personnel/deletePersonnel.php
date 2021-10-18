<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function deletePersonnel($id,$url){ 
  authentification($url);
    // header("Content-Type:application/json");
    $data = json_decode(file_get_contents('php://input'),true);
    if(empty($data['Id'])){
           $tab = [
               "Erreur"=>"Le personnel de cet identifiant n'existe pas"
           ];
           echo json_encode($tab);
        exit; 
    }

  $db = Connecter();
  $Id = htmlspecialchars(trim($data['Id']));
  $sql1 = "SELECT Id FROM users WHERE Id=?";
  $req1 = $db->prepare($sql1);
  $req1->execute(array($Id));
  $data1 = $req1->fetch();
  if(empty($data1)){
    $tab = [
      "error" => "Le Personnel que vous voulez supprimer n'existe pas."
    ];
    echo json_encode($tab);
    exit;
  }
  $sql2 = "DELETE FROM users WHERE Id=?";
  $req2 =$db->prepare($sql2);
  $data2 =$req2->execute(array($Id));

  if(!empty($data2))
  {
    $tab = [
      "message" => "Le Personnel a ete supprime avec succes."
    ];
    echo json_encode($tab);
    exit;
  }else{
    $tab = [
      "error" => "Le Personnel n'a pas ete supprime."
    ];
    echo json_encode($tab);
    exit;
  }

}

deletePersonnel($id,$url);


?>
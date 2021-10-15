<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function getDepartment($url){
  authentification($url);
    $db = Connecter();
    $sql = "SELECT NameD, IdD FROM department";
    $req = $db->query($sql);
    $tab = [];
    while($data=$req->fetch()){
      array_push($tab,[
        "NameD" => $data['NameD'],
        "IdD" => $data['IdD'],
      ]);
    }
   if(count($tab)>0){
      echo json_encode($tab);
   }else{
   echo  json_encode(["error" => "Il n'y a pas de donnees "]);
      
   }
}
getDepartment($url);

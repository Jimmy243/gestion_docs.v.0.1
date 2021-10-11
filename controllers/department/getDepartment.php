<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";

function getDepartment(){
  @ini_set('display_errors', 'on');
    header('Content-Type:application/json');
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
   echo  json_encode(["Erreur" => "Il y a des donnees "]);
      
   }
}
getDepartment();


?>
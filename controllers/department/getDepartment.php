<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";

function getDepartment(){
  @ini_set('display_errors', 'on');
    header('Content-Type:application/json');
    $db = Connecter();
    $sql = "SELECT department.NameD as NameD FROM department";
    $req = $db->query($sql);
    $tab = [];
    while($data=$req->fetch()){
      array_push($tab,$data['NameD']);
    }
   if(count($tab)>0){
      echo json_encode($tab);
   }else{
   echo  json_encode(["Erreur" => "Il y a des donnees "]);
      
   }
}
getDepartment();


?>
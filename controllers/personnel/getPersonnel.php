<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function getPersonnel($url){
  authentification($url);
    $db = Connecter();
    $sql = "SELECT Id,Fullname,Functions,DateB,Images,Addresss,NumberM,States,Gander,Mobile,Email,Roles,NameD,users.IdD FROM users LEFT OUTER JOIN department ON users.IdD = department.IdD WHERE users.Roles!='Admin' AND users.Statuss='active'";
    $req = $db->query($sql);
    $tab = [];
    while($data=$req->fetch(PDO::FETCH_ASSOC)){
      array_push($tab,$data);
    }
   if(count($tab)>0){
      echo json_encode($tab);
   }else echo  json_encode(["error" => "Il n'y a pas de personnel "]);
}
getPersonnel($url);
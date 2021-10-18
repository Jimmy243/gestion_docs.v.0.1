<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function getOnePersonnel($id,$url){ 
  $payload = authentification($url);
    if ($payload['role'] != "Admin") {
      if($id != $payload['id'])
      {
        $id = $payload['id'];
      }
    }

  $db = Connecter();
  $sql = "SELECT Id,Fullname,Functions,DateB,Images,Addresss,NumberM,States,Gander,Mobile,Email,Statuss,Roles,NameD,users.IdD FROM users LEFT OUTER JOIN department ON users.IdD = department.IdD WHERE users.Statuss='active' AND users.Id = ?";
  $req = $db->prepare($sql);
  $req->execute(array($id));
  
  $tab = [];
  while($data=$req->fetch(PDO::FETCH_ASSOC)){
    array_push($tab,$data);
  }
 if(count($tab)>0){
    echo json_encode($tab[0]);
 }else echo  json_encode(["error" => "Ce personnel n'existe pas."]);
}

getOnePersonnel($id,$url);
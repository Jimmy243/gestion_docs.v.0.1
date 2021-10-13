<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."verifyToken.php";

function getOnePersonnel($id){
  header('Content-Type:application/json');
  $token = $_COOKIE['gestion_doc'];
  $payload = verifyToken($token);

  if(!$payload){
    echo json_encode([
      'login' =>  'true'
    ]);
    exit;
  }

  if($id !== $payload['id'] && $payload['role'] !== 'Admin')
  {
    echo json_encode([
      'auth' =>  'faille'
    ]);
    exit;
  }

  $db = Connecter();
  $sql = "SELECT Id,Fullname,Functions,DateB,Images,Addresss,NumberM,States,Gander,Mobile,Email,Roles,NameD FROM users LEFT OUTER JOIN department ON users.IdD = department.IdD WHERE users.Statuss='active' AND users.Id = ?";
  $req = $db->prepare($sql);
  $req->execute(array($id));
  
  $tab = [];
  while($data=$req->fetch(PDO::FETCH_ASSOC)){
    array_push($tab,$data);
  }
 if(count($tab)>0){
    echo json_encode($tab[0]);
 }else echo  json_encode(["error" => "Il n'y a pas de personnel "]);
}
<?php 
include __DIR__.DIRECTORY_SEPARATOR."signToken.php";
include_once dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";

use Firebase\JWT\JWT;

function verifyToken($token)
{
  try {
    $private_key = "eyJpZCI6Miwicm9sZSI6IiBBRE1JTiIsImlhdCI6MTmYzMzk2NjE2NCwiZXhwIjoxNjMzOTY2NDY0fQ";
    $decoded = JWT::decode($token, $private_key, array('HS256'));

    $db1 = Connecter();
    $sql = "SELECT Id,Roles FROM users WHERE Id=? AND Statuss='active'";
    $req = $db1->prepare($sql);
    $req->execute(array($decoded->id));
    $data = $req->fetch();
    if(empty($data)) return false;

    $payload = [
      "id" => $decoded->id,
      "role" => $data['Roles'],
      'souvenez_vous' => $decoded->souvenez_vous,
      "iat" => time(),
    ]; 
    if(!$decoded->souvenez_vous){
      $time = time()+(60*30);
      $payload["exp"] = $time;
      $exp = $time;
    }else $exp = 0;
    
    $token =  signToken($payload);
    setcookie('gestion_doc',$token,$exp,"/","",false,true);
    return
     [
      "id" => $decoded->id,
      "role" => $decoded->role,
      "iat" => $decoded->iat
    ];
  } catch (Exception $th) {
    return false;
  }
}
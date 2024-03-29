<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include __DIR__.DIRECTORY_SEPARATOR."signToken.php";

function setDepartment(){ 
  header('Content-Type:application/json');
  $data = json_decode(file_get_contents('php://input'),true);

  $tab = [];
  if(empty($data['email'])) array_push($tab,'Veuillez entrer votre email SVP');
  if(empty($data['password'])) array_push($tab,'Veuillez entrer votre mot de passe SVP');

  $email = htmlspecialchars(trim($data['email']));
  $password = $data['password'];
  

  $souvenez_vous = $data['souvenez_vous']??false;
  $db = Connecter();
  $sql = "SELECT Id,Email,Roles,Pwd FROM users WHERE users.Statuss='active' AND users.Email = ?";
  $req = $db->prepare($sql);
  $req->execute(array($email));
  $data = $req->fetch(PDO::FETCH_ASSOC);
// admin  admin@gmail.com
// receptioniste:  b5fecd20 jean@gmail.com
// user: 5a6b22c9 jule@gmail.com
// 9ad601e1 mark@gmail.com
// jule1@gmail.com

  if(!empty($data))
  {
    if(password_verify($password,$data['Pwd']))
    {
      $payload = [
        "id" => $data['Id'],
        "role" => $data['Roles'],
        'souvenez_vous' => $souvenez_vous,
        "iat" => time(),
        
      ]; 
      if(!$souvenez_vous){
        $time = time()+(60*30);
        $payload["exp"] = $time;
        $exp = $time;
      }else $exp = 0;
      
      $token =  signToken($payload);
      setcookie('gestion_doc',$token,$exp,"/","",false,true);
      echo json_encode(['message' => 'ok']);
      // header('location: /profile');
    }else{
      echo json_encode(['error' => 'Mot de passe que vous aviez entre n\'est pas valide']);
    }
  }else{
    echo json_encode(['error' => 'Email que vous aviez entre n\'est pas valide']);
  }
  

}

setDepartment();

?>
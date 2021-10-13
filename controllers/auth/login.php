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
  $password = htmlspecialchars(trim($data['password']));
  

  $souvenez_vous = $data['souvenez_vous']??false;
  $db = Connecter();
  $sql = "SELECT Id,Email,Roles,Pwd FROM users WHERE users.Statuss='active' AND users.Email = ?";
  $req = $db->prepare($sql);
  $req->execute(array($email));
  $data = $req->fetch(PDO::FETCH_ASSOC);
// admin 0e9f233b jule9@gmail.com
// receptioniste: 0a47adbb sadock@gmail.com
// user: 05455778 charles@gmail.com 

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
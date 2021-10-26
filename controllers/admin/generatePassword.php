<?php
include dirname(__DIR__) . DIRECTORY_SEPARATOR . "connection.php";
include dirname(__DIR__) . DIRECTORY_SEPARATOR . "auth" . DIRECTORY_SEPARATOR . "authentification.php";

function generatePassword($id, $url)
{
  authentification($url);
  $db = Connecter();

  $sql = "SELECT Id FROM users WHERE Id=?";
  $req = $db->prepare($sql);
  $req->execute(array($id));
  $data = $req->fetch();

  if (empty($data)) {
    echo json_encode(["error" => 'Le personnel n\'existe pas. Si le probleme persiste, essayez de rafraichir la page.']);
    exit;
  }

  try {
    $passwordPlaintText = substr(sha1(time()), 0, 8);
    $password_encrypt = password_hash($passwordPlaintText, PASSWORD_BCRYPT);
    $sql1 = "UPDATE users SET Pwd = ? WHERE Id = ?";
    $req1 = $db->prepare($sql1);
    $data1 = $req1->execute(array($password_encrypt,$id));
    if(!empty($data1)) echo json_encode(['password' => $passwordPlaintText ]);
    else echo json_encode(['error' => "On n'a pas pu genere le mot de passe1."]);
  } catch (Exception $th) {
    echo json_encode(["error" => "On n'a pas pu genere le mot de passe."]);
  }
}
generatePassword($id, $url);

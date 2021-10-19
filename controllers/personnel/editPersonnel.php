<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function editPersonnel($id,$url){
  authentification($url);
  $db = Connecter();
  // $data = json_decode(file_get_contents('php://input'),true);

  $tabErrors = [];

  if(empty($_POST['Fullname'])) array_push($tabErrors,'Completer le nom du personnel.');
  if(empty($_POST['Functions'])) array_push($tabErrors,'Veuillez indiquer la fonction du personnel.');
  if(empty($_POST['IdD'])) array_push($tabErrors,'Veuillez assigner un departement a ce personnel.');
  if(empty($_POST['DateB'])) array_push($tabErrors,'Veuillez mettre la date de naissance du personnel.');
  if(empty($_POST['Addresss'])) array_push($tabErrors,'Completer l\'adresse du personnel.');
  if(empty($_POST['NumberM'])) array_push($tabErrors,'Completer le numero matricule du personnel.');
  if(empty($_POST['Gander'])) array_push($tabErrors,'Veuillez indiquer le genre du personnel.');
  if(empty($_POST['Mobile'])) array_push($tabErrors,'Completer le numero du personnel.');
  if(empty($_POST['Email'])) array_push($tabErrors,'Veuillez ajouter l\'adresse email du personnel.');
  if(empty($_POST['States'])) array_push($tabErrors,'Veuillez ajouter la province de provinance du personnel.');

if(count($tabErrors) > 0){
  echo json_encode([
    "error" => $tabErrors
  ]);
  exit;
}
 
$Fullname=htmlspecialchars(trim($_POST['Fullname']));
$Functions=htmlspecialchars(trim($_POST['Functions']));
$IdD=htmlspecialchars(trim($_POST['IdD']));
$DateB=htmlspecialchars(trim(($_POST['DateB'])));
$Addresss=htmlspecialchars(trim($_POST['Addresss']));
$NumberM=htmlspecialchars(trim($_POST['NumberM']));
$States=htmlspecialchars(trim(($_POST['States'])));
$Gander=htmlspecialchars(trim(($_POST['Gander'])));
$Mobile=htmlentities(trim(($_POST['Mobile'])));
$Email=htmlentities(trim(($_POST['Email'])));

$sql = "SELECT Id FROM users WHERE Id=?";
$req = $db->prepare($sql);
$req->execute(array($id));
$data = $req->fetch();
if(empty($data)) {
  echo json_encode([ "error" => 'Le personnel n\'existe pas. Si le probleme persiste, essayez de rafraichir la page.']);
  exit;
}

$sql1 = "SELECT IdD FROM department WHERE IdD=?";
$req1 = $db->prepare($sql1);
$req1->execute(array($IdD));
$data1 = $req1->fetch();
if(empty($data1)) {
  echo json_encode([ "error" => 'Le departement n\'existe pas']);
  exit;
}

$sql2="SELECT Email FROM users WHERE Email=? AND Id!=?";
$req2 = $db->prepare($sql2);
$req2->execute(array($Email,$id));
$data2 = $req2->fetch();
if(!empty($data2)) 
{
  echo json_encode([ "error" => 'Cet email "'.$Email.'" est deja pris par un autre personnel.' ]);
  exit;
}

// traitement d'image
$is_Image = "";
$is_send = false;
$sql4 = "SELECT Images FROM users WHERE Id=?";
$req4 = $db->prepare($sql4);
$req4->execute(array($id));
$data4 = $req4->fetch();
if(!empty($data4)) $is_Image = $data4['Images'];

if(!empty($_FILES["Images"])){
  if($_FILES["Images"]['error'] == 1 || $_FILES["Images"]['error'] == 2){
    echo json_encode(["error" => 'La photo que vous choisissez a une grande taille.']);
    exit;
  }else if($_FILES["Images"]['error'] == 0)
  {
    $ext = ["gif","jpg","jpeg","png"];
    $doc = pathinfo($_FILES['Images']['name']);
    if(!in_array(strtolower($doc['extension']),$ext)) {
      echo json_encode(["error" => 'Veuillez inserer la bonne photo qui est soit gif,jpg,jpeg,png']);
      exit;
    }
    $Images = "file".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.date_timestamp_get(date_create())."_".$_FILES['Images']['name'];
    $is_send = true;
  }else $Images = $is_Image;
}else $Images = $is_Image;


$sql3="UPDATE  users SET Fullname=?, Functions=?, IdD=?, DateB=?,Images=?,Addresss=?,NumberM=?,States=?,Gander=?,Mobile=?,Email=? WHERE Id=?";
try {
  $req3=$db->prepare($sql3);
  $data3=$req3->execute(array($Fullname,$Functions,$IdD,$DateB,$Images,$Addresss,$NumberM,$States,$Gander,$Mobile,$Email,$id));
  if(!$data3) echo json_encode([ "error" => 'Le personnel n\'est pas modifie.']);
  else{
    move_uploaded_file($_FILES['Images']['tmp_name'], $Images);
    if($is_send && $is_Image != "file/images/icon.png") {
      if(file_exists($is_Image)){
        $file = pathinfo($is_Image);
        $path = $file['dirname'].DIRECTORY_SEPARATOR.$file['filename']."_NotFollowed.".$file['extension'];
        rename($is_Image,$path);
      }
    }
    echo json_encode(['message' => 'Le personnel a ete modifie avec succes']);
  }
} catch (Exception $th) {
  echo json_encode([ "error" => $th ]);
}

}
editPersonnel($id,$url);
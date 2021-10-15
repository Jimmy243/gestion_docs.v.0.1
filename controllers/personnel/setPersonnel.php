<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function setDepartment($url){ 
  authentification($url);
  $db = Connecter();
  $data = json_decode(file_get_contents('php://input'),true);

  $tabErrors = [];

  if(empty($data['Fullname'])) array_push($tabErrors,'Completer le nom du personnel.');
  if(empty($data['Functions'])) array_push($tabErrors,'Veuillez indiquer la fonction du personnel.');
  if(empty($data['IdD'])) array_push($tabErrors,'Veuillez assigner un departement a ce personnel.');
  if(empty($data['DateB'])) array_push($tabErrors,'Veuillez mettre la date de naissance du personnel.');
  if(empty($data['Addresss'])) array_push($tabErrors,'Completer l\'adresse du personnel.');
  if(empty($data['NumberM'])) array_push($tabErrors,'Completer le numero matricule du personnel.');
  if(empty($data['Gander'])) array_push($tabErrors,'Veuillez indiquer le genre du personnel.');
  if(empty($data['Mobile'])) array_push($tabErrors,'Completer le numero du personnel.');
  if(empty($data['Email'])) array_push($tabErrors,'Veuillez ajouter l\'adresse email du personnel.');
  if(empty($data['States'])) array_push($tabErrors,'Veuillez ajouter la province de provinance du personnel.');

  if(count($tabErrors) > 0){
    echo json_encode([
      "error" => $tabErrors
    ]);
    exit;
  }

  $Fullname=htmlspecialchars(trim($data['Fullname']));
  $Functions=htmlspecialchars(trim($data['Functions']));
  $IdD=htmlspecialchars(trim($data['IdD']));
  $DateB=htmlspecialchars(trim(($data['DateB'])));
  $Addresss=htmlspecialchars(trim($data['Addresss']));
  $NumberM=htmlspecialchars(trim($data['NumberM']));
  $States=htmlspecialchars(trim(($data['States'])));
  $Gander=htmlspecialchars(trim(($data['Gander'])));
  $Mobile=htmlentities(trim(($data['Mobile'])));
  $Email=htmlentities(trim(($data['Email'])));

  // gestion de password
  $passwordPlaintText = substr(sha1(time()),0,8);
  $password_encrypt=password_hash($passwordPlaintText,PASSWORD_BCRYPT);

  // gestion des images
  $Images = 'assets/img/doctor-thumb-05.PNG';

  // gestion des ststus-role
  $status = "Active";
  $roles = "User";

  $sql1 = "SELECT IdD FROM department WHERE IdD=?";
  $req1 = $db->prepare($sql1);
  $req1->execute(array($IdD));
  $data1 = $req1->fetch();
  if(empty($data1)) {
    echo json_encode([ "error" => 'Le departement n\'existe pas']);
    exit;
  }

  $sql2="SELECT Email FROM users WHERE Email=?";
  $req2 = $db->prepare($sql2);
  $req2->execute(array($Email));
  $data2 = $req2->fetch();
  if(!empty($data2)) 
  {
    echo json_encode([ "error" => 'Cet email "'.$Email.'" est deja pris par un autre personnel.' ]);
    exit;
  }

  $sql3="INSERT INTO users(Fullname,Functions,IdD,DateB,Images,Addresss,NumberM,States,Gander,Mobile,Email,Pwd,Statuss,Roles) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  try {
    $req3=$db->prepare($sql3);
    $data3=$req3->execute(array($Fullname,$Functions,$IdD,$DateB,$Images,$Addresss,$NumberM,$States,$Gander,$Mobile,$Email,$password_encrypt,$status,$roles));
    $t = !$data3? [
      "error" => 'Le personnel n\'est pas enregistre.']:[
      'email' => $Email,
      'password' => $passwordPlaintText
    ];
    echo json_encode($t);
  } catch (Exception $th) {
    echo json_encode([ "error" => $th ]);
  }
}
setDepartment($url);
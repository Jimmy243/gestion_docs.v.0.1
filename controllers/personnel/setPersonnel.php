<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function setDepartment($url){ 
  authentification($url);
  $db = Connecter();

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
  $Images = "file/images/icon.png";
  
  // gestion de password
  $passwordPlaintText = substr(sha1(time()),0,8);
  $password_encrypt=password_hash($passwordPlaintText,PASSWORD_BCRYPT);

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

  // test numero matricule est unique
  $sql3="SELECT NumberM FROM users WHERE NumberM=?";
  $req3 = $db->prepare($sql3);
  $req3->execute(array($NumberM));
  $data3 = $req3->fetch();
  if(!empty($data3)) 
  {
    echo json_encode([ "error" => 'Ce numero matricule "'.$NumberM.'" est deja pris par un autre personnel.' ]);
    exit;
  }

  if(!empty($_FILES["Images"])){
    if($_FILES["Images"]['error'] == 1 || $_FILES["Images"]['error'] == 2){
      echo json_encode(["error" => 'La photo que vous choisissez a une grande taille.']);
      exit;
    }else if($_FILES["Images"]['error'] == 0)
    {
      $ext = ["gif","jpg","jpeg","png"];
      $doc = pathinfo($_FILES['Images']['name']);
      if(!in_array($doc['extension'],$ext)) {
        echo json_encode(["error" => 'Veuillez inserer la bonne photo qui est soit gif,jpg,jpeg,png']);
        exit;
      }
      $Images = "file".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.date_timestamp_get(date_create())."_".$_FILES['Images']['name'];
    }
  }

  $sql4="INSERT INTO users(Fullname,Functions,IdD,DateB,Images,Addresss,NumberM,States,Gander,Mobile,Email,Pwd,Statuss,Roles) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  try {
    $req4=$db->prepare($sql4);
    $data4=$req4->execute(array($Fullname,$Functions,$IdD,$DateB,$Images,$Addresss,$NumberM,$States,$Gander,$Mobile,$Email,$password_encrypt,$status,$roles));
    if(!$data4) echo json_encode([ "error" => 'Le personnel n\'est pas enregistre.']);
    else{
      move_uploaded_file($_FILES['Images']['tmp_name'], $Images);
      echo json_encode(['email' => $Email,'password' => $passwordPlaintText]);
    }
  } catch (Exception $th) {
    echo json_encode([ "error" => $th ]);
  }
}
setDepartment($url);
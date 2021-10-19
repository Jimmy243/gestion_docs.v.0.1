<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";
function setDepartment($url){ 
  authentification($url);
  $db = Connecter();
  $tabErrors = []; 

  if(empty($_POST['NameR'])) array_push($tabErrors,'Completer le nom du deposant.');
  if(empty($_POST['Reference'])) array_push($tabErrors,'Veuillez indiquer la reference du document.');
  if(empty($_POST['IdD'])) array_push($tabErrors,'Veuillez selectionner le departement.');
  if(empty($_POST['Id'])) array_push($tabErrors,'Veuillez selectionner le personnel.');
  if(empty($_POST['Devise'])) array_push($tabErrors,'Completer selectionner la device.');
  if(empty($_POST['MontantF'])) array_push($tabErrors,'Veuillez indiquer le montant du facture.');


  if(count($tabErrors) > 0){ 
    echo json_encode([
      "error" => $tabErrors
    ]);
    exit;
  }

  if(!in_array($_POST['Devise'],["FBU","USD"])) 
  {
    $tab = [ "error" => 'Veuillez selectionner une bonne device "FBU" ou "USD".' ];
    echo json_encode($tab);
    exit;
  }
  
  if(empty($_FILES["Facture"]) || $_FILES["Facture"]['error'] != 0) {
    if($_FILES["Facture"]['error'] == 1 || $_FILES["Facture"]['error'] == 2)
    {
      $tab = [ "error" => 'Le document que vous choisissez a une grande taille.' ];
      echo json_encode($tab);
      exit;
    } else 
    {
      $tab = [ "error" => 'Veuillez inserer le document.' ];
      echo json_encode($tab);
      exit;
    }
  }

  $ext = ["doc","docx","pdf","jpg","jpeg","png"];
  $doc = pathinfo($_FILES['Facture']['name']);
  if(!in_array(strtolower($doc['extension']),$ext)) 
  {
    $tab = [ "error" => "Veuillez inserer le document word ou pdf." ];
    echo json_encode($tab);
    exit;
  }

  // recuperation de donnees
  $NameR=htmlspecialchars(trim($_POST['NameR']));
  $Reference=htmlspecialchars(trim($_POST['Reference']));
  $IdD=htmlspecialchars(trim($_POST['IdD']));
  $MontantF=htmlspecialchars(trim(($_POST['MontantF'])));
  $Id=htmlspecialchars(trim(($_POST['Id'])));
  $Devise=htmlentities(trim(($_POST['Devise'])));
  $MontantF=htmlspecialchars(trim(($_POST['MontantF'])));

  // test if department existe
  $sql1 = "SELECT IdD FROM department WHERE IdD=?";
  $req1 = $db->prepare($sql1);
  $req1->execute(array($IdD));
  $data1 = $req1->fetch();
  if (empty($data1)) {
    $tab = [
      "error" => "Le departement que vous selectionnez n'existe pas. Si le probleme persiste, essayez de rafraichir la page."
    ];
    echo json_encode($tab);
    exit;
  }

  // test if personnel existe
  $sql2 = "SELECT Id FROM users WHERE Id=?";
  $req2 = $db->prepare($sql2);
  $req2->execute(array($Id));
  $data2 = $req2->fetch();
  if(empty($data2)) {
    echo json_encode([ "error" => 'Le personnel que vous selectionnez n\'existe pas. Si le probleme persiste, essayez de rafraichir la page.']);
    exit;
  }

  // test if personnel appartient au departement selectionne
  $sql3 = "SELECT Id FROM users WHERE Id=? AND IdD=?";
  $req3 = $db->prepare($sql3);
  $req3->execute(array($Id,$IdD));
  $data3 = $req3->fetch();
  if(empty($data3)) {
    echo json_encode([ "error" => 'Le personnel que vous selectionnez n\'appartient au departement selectionne']);
    exit;
  }

  // test if la facture existe deja
  $sql4 = "SELECT IdF FROM facture WHERE Reference=?";
  $req4 = $db->prepare($sql4);
  $req4->execute(array($Reference));
  $data4 = $req4->fetch();
  if(!empty($data4)) {
    echo json_encode([ "error" => 'Une autre facture de cette reference exite deja.']);
    exit;
  }

  $Facture = "file".DIRECTORY_SEPARATOR."factures".DIRECTORY_SEPARATOR.date_timestamp_get(date_create())."_".$_FILES['Facture']['name'];

  $sql5="INSERT INTO facture (NameR,Reference,IdD,Id,Devise,MontantF,Facture) VALUES(?,?,?,?,?,?,?)";
  try {
    $req5= $db->prepare($sql5);
    $data5= $req5->execute(array($NameR,$Reference,$IdD,$Id,$Devise,$MontantF,$Facture));
    if(!$data5) echo json_encode([ "error" => 'La facture n\' a pas ete enregistre.']);
    else{
      move_uploaded_file($_FILES['Facture']['tmp_name'], $Facture);
      echo json_encode(["message" => "La facture a ete bien enregistre"]);
    } 
  } catch (Exception $th) {   
    echo json_encode([ "error" => $th ]);
  }
}

setDepartment($url);
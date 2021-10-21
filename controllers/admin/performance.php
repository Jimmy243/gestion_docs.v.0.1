<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function performance($url)
{ 
  authentification($url);
  $db = Connecter();
  try {
    $sql1 = "SELECT Fullname,Pourcentage, users.Id FROM users LEFT JOIN facture ON users.Id = facture.Id LEFT JOIN facture_traitee ON facture.IdF = facture_traitee.IdF WHERE Roles != 'Admin' AND Roles != 'Receptioniste'";
    $req1 = $db->query($sql1);
    $tab1 = [];
    while($data1=$req1->fetch(PDO::FETCH_ASSOC)){
      array_push($tab1,$data1);
    }
    $invoice = [];
    foreach ($tab1 as $key => $value) {
      if(empty($value['Pourcentage'])) {
        $value["Pourcentage"] = 0;
          $value["state"] = "Non traitee";
          $invoice[] = $value;
      }
      else {
        $value["state"] = "Traitee";
        $invoice[] = $value;
      }
    }

    $t1 = [];
    foreach ($invoice as $key => $value) {
      @$t1[$value["Id"]]['total'] += $value['Pourcentage'];
      @$t1[$value["Id"]]['Fullname'] = $value['Fullname'];
      @$t1[$value["Id"]]['itera']++;
    }

    $t2 = [];
    foreach ($t1 as $key => $value) {
      $t2[] = [
        "Pourcentage" => $value['total']/$value['itera'],
        "Fullname" => $value["Fullname"]
      ]; 
    }

    echo json_encode($t2);
  }catch(Exception $e){
    echo json_encode($e);
 }
}
performance($url);
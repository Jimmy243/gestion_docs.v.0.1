<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function invoice($url)
{ 
  authentification($url);
  $db = Connecter();
  try {
    $sql1 = "SELECT facture.IdF,NameR,Reference,IdD,Id,Devise,MontantF,Facture,facture_traitee.DateT,DateEnreg,Pourcentage FROM facture LEFT OUTER JOIN  facture_traitee ON facture.IdF = facture_traitee.IdF";
    $req1 = $db->query($sql1);
    $tab1 = [];
    while($data1=$req1->fetch(PDO::FETCH_ASSOC)){
      array_push($tab1,$data1);
    }

    foreach ($tab1 as $key => $value) {
      if(empty($value['DateT'])) {
        $date = new DateTime($value["DateEnreg"]);
        $dateNow = new DateTime("NOW");
        $interval = $date->diff($dateNow);
        $days = $interval->format('%a');
        if($days > 4) $notTreated[] = $value;
      }
      else $treated[] = $value;
    }
    echo json_encode(
      [
        "invoice" => [
          "treated" => $treated,
          "notTreated" => $notTreated
        ],
        "doc" => []
      ]
    );
  }catch(Exception $e){
    echo json_encode($e);
 }
}
invoice($url);
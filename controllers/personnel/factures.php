<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function getFacture($url){
 $payload = authentification($url);
 $Id = $payload['id'];
 $db = Connecter();
 try{
 $sql1 = "SELECT facture.IdF,NameR,Reference,IdD,Id,Devise,MontantF,Facture,facture_traitee.DateT,DateEnreg FROM facture LEFT OUTER JOIN  facture_traitee ON facture.IdF = facture_traitee.IdF  WHERE Id=?";
 $req1 = $db->prepare($sql1);
 $req1->execute(array($Id));

 $tab1 = [];
  while($data1=$req1->fetch(PDO::FETCH_ASSOC)){
    array_push($tab1,$data1);
  }
  $treated = [];
  $notTreated = [];
  // if(count($tab1)>0){
    foreach ($tab1 as $key => $value) {
      if(empty($value['DateT'])) {
        $date = new DateTime($value["DateEnreg"]);
        $dateNow = new DateTime("NOW");
        $interval = $date->diff($dateNow);
        $days = $interval->format('%a');
        if($days < 5) $notTreated[] = $value;
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

    // $sql2 = "SELECT facture.IdF,NameR,Reference,IdD,Id,Devise,MontantF,Facture,facture_traitee.DateT FROM facture,facture_traitee   WHERE Id=? AND facture.IdF = facture_traitee.IdF ";
    // $req2 = $db->prepare($sql2);
    // $req2->execute(array($Id));
    // $tab2 = [];
    // while($data2=$req2->fetch(PDO::FETCH_ASSOC)){
    //   array_push($tab2,$data2);
    // }
    // if(count($tab1) == 0) $tab2 = [];
    // echo json_encode(
    //   [
    //     "treated" => $tab2 ,
    //     "notTreated" => $tab1
    //   ]
    // );
  // }else echo  json_encode(["error" => "Il n'y a pas des factures a traiter "]);
}catch(Exception $e){
   echo json_encode($e);
}

}

getFacture($url);
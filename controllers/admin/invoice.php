<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function invoice($url)
{ 
  authentification($url);
  $db = Connecter();
  try {
    $pagination = json_decode(file_get_contents('PHP://input'),1);
    $sql1 = "SELECT facture.IdF,NameR,Reference,NameD,users.Fullname,Devise,MontantF,Facture,facture_traitee.DateT,DateEnreg,Pourcentage FROM facture LEFT OUTER JOIN  facture_traitee ON facture.IdF = facture_traitee.IdF LEFT OUTER JOIN department ON facture.IdD = department.IdD LEFT OUTER JOIN users ON facture.Id = users.Id ";
    $req1 = null;

    if(!empty($pagination['next']))
    {
      $sql1 = "$sql1  WHERE facture.IdF > ? LIMIT 5";
      $req1 = $db->prepare($sql1);
      $req1->execute(array($pagination['next']));
    }else if(!empty($pagination['back']))
    {
      $sql1 = "$sql1  WHERE facture.IdF < ? ORDER BY facture.IdF DESC LIMIT 5";
      $req1 = $db->prepare($sql1);
      $req1->execute(array($pagination['back']));
    }else {
      $sql1 = "$sql1 LIMIT 5";
      $req1 = $db->query($sql1);
    }
      
    $tab1 = [];
    while($data1= $req1->fetch(PDO::FETCH_ASSOC)){
      array_push($tab1,$data1);
    }
    $invoice = [];
    // var_dump($tab1);
    // var_dump(empty(NULL));
    // exit;
    foreach ($tab1 as $key => $value) {
      if(empty($value['DateT'])) {
        $date = new DateTime($value["DateEnreg"]);
        $dateNow = new DateTime("NOW");
        $interval = $date->diff($dateNow);
        $days = $interval->format('%a');
        if($days > 4) {
          $value["state"] = "Non traitee";
          $invoice[] = $value;
        }
      }
      else {
        $value["state"] = "Traitee";
        $invoice[] = $value;
      }
    }

    // next and back
    $Tabpagination = [];
    $sqlModel = "SELECT facture.IdF FROM facture LEFT OUTER JOIN  facture_traitee ON facture.IdF = facture_traitee.IdF LEFT OUTER JOIN department ON facture.IdD = department.IdD LEFT OUTER JOIN users ON facture.Id = users.Id ";
    $req2 = null;
    if(!empty($pagination['next']))
    {
     if(count($invoice) !== 0){
      $sql2 = "$sqlModel  WHERE facture.IdF < ". $invoice[array_key_first($invoice)]['IdF'] ." LIMIT 1";
      $req2 = $db->query($sql2);
      $back = $req2->fetch();
      if($back) $Tabpagination['back'] = $invoice[array_key_first($invoice)]['IdF'];
      else $Tabpagination['back'] = 0;

      $sql3 = "$sqlModel  WHERE facture.IdF > ". $invoice[array_key_last($invoice)]['IdF'] ." LIMIT 1"; 
      $req3 = $db->query($sql3);
      $back = $req3->fetch();
      if($back) $Tabpagination['next'] = $invoice[array_key_last($invoice)]['IdF'] ;
      else $Tabpagination['next'] = 0;
     }else {
      $Tabpagination['back'] = $pagination['next'] ;
      $Tabpagination['next'] = 0;
     }
    }else if(!empty($pagination['back']))
    {
      if(count($invoice) !== 0){
        $sql2 = "$sqlModel  WHERE facture.IdF < ". $invoice[array_key_last($invoice)]['IdF'] ." LIMIT 1";
        $req2 = $db->query($sql2);
        $back = $req2->fetch();
        if($back) $Tabpagination['back'] = $invoice[array_key_last($invoice)]['IdF'];
        else $Tabpagination['back'] = 0;
  
        $sql3 = "$sqlModel  WHERE facture.IdF > ". $invoice[array_key_first($invoice)]['IdF']." LIMIT 1"; 
        $req3 = $db->query($sql3);
        $back = $req3->fetch();
        if($back) $Tabpagination['next'] = $invoice[array_key_first($invoice)]['IdF'];
        else $Tabpagination['next'] = 0;
       }else {
        $Tabpagination['back'] = 0;
        $Tabpagination['next'] =  $pagination['back'];
       }
    }else {
      if(count($invoice) !== 0){
        $sql2 = "$sqlModel  WHERE facture.IdF < ". $invoice[array_key_first($invoice)]['IdF'] ." LIMIT 1";
        $req2 = $db->query($sql2);
        $back = $req2->fetch();
        if($back) $Tabpagination['back'] = $invoice[array_key_first($invoice)]['IdF'];
        else $Tabpagination['back'] = 0;
  
        $sql3 = "$sqlModel  WHERE facture.IdF > ". $invoice[array_key_last($invoice)]['IdF'] ." LIMIT 1"; 
        $req3 = $db->query($sql3);
        $back = $req3->fetch();
        if($back) $Tabpagination['next'] = $invoice[array_key_last($invoice)]['IdF'] ;
        else $Tabpagination['next'] = 0;
       }else {
        $Tabpagination['back'] = 0 ;
        $Tabpagination['next'] = 0;
       }
    }

    echo json_encode(
      [
        "invoice" => $invoice,
        "doc" => [],
        "pagination" => $Tabpagination,
        "data" =>  $pagination
      ]
    );
  }catch(Exception $e){
    echo json_encode($e);
 }
}
invoice($url); 
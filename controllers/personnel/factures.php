<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR."connection.php";
include dirname(__DIR__).DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."authentification.php";

function getFacture($url){
 $payload = authentification($url);
 $Id = $payload['id'];
 $db = Connecter();
 try{
 $sql = "SELECT IdF,NameR,Reference,IdD,Id,Devise,MontantF,Facture FROM facture WHERE Id=$Id";
 $req = $db->query($sql);
 $tab = [];
    while($data=$req->fetch(PDO::FETCH_ASSOC)){
      array_push($tab,$data);
    }
   //  echo "Ok";
   if(count($tab)>0){
      echo json_encode($tab);
   }else echo  json_encode(["error" => "Il n'y a pas des factures a traiter "]);
}catch(Exption $e){
   echo json_encode($e);
}

}

getFacture($url);
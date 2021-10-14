<?php
include __DIR__ . DIRECTORY_SEPARATOR . "verifyToken.php";

function authentification($url)
{
  header('Content-Type:application/json');
  if (!empty($_COOKIE['gestion_doc'])) {
    $token = $_COOKIE['gestion_doc'];
    $payload = verifyToken($token);


    $tab1 = ["personnel_get", "department_get"]; // Admin et Receptioniste
    // $tab2 = ["facture","appointment"]; // Receptioniste
    $tab3 = ["department_set", "department_edit", "department_delete", "personnel_get_one", "personnel_set", "personnel_edit", "personnel_edit_post"];

    if (in_array($url, $tab1)) {
      if ($payload['role'] != "Admin" and $payload['role'] != "Receptioniste") {
        echo json_encode([
          'auth' =>  'Vous n\'avez pas le droit d\'effectuer cette action'
        ]);
        exit;
      }
    } else if (in_array($url, $tab1)) {
      if ($payload['role'] != "Admin") {
        echo json_encode([
          'auth' =>  'Vous n\'avez pas le droit d\'effectuer cette action'
        ]);
        exit;
      }
    } else {
      // if(in_array($url,$tab2))
      // {
      //   if($payload['role'] != "Receptioniste")
      //     header("location: /profile");
      // }
    }
  } else {
    // echo json_encode([
    //   'login' =>  'true'
    // ]);
    // exit;
  }
}

<?php
include __DIR__ . DIRECTORY_SEPARATOR . "verifyToken.php";

function authentification($url)  
{
  header('Content-Type:application/json');
  if (!empty($_COOKIE['gestion_doc'])) {
    $token = $_COOKIE['gestion_doc'];
    $payload = verifyToken($token);


    $tab1 = ["personnel_get", "department_get"]; // Admin et Receptionniste
    $tab2 = ["facture", "facture_set", "reception","get_document"]; // Receptionniste
    $tab3 = ["home","department_set", "department_edit", "department_delete", "personnel_set", "personnel_edit", "personnel_edit_post", "personnel_one_delete","invoice"];
    $tab4 = ["factures-get"];

    if (in_array($url, $tab1)) {
      if ($payload['role'] != "Admin" and $payload['role'] != "Receptioniste") {
        echo json_encode([
          'auth' =>  'Vous n\'avez pas le droit d\'effectuer cette action'
        ]);
        exit;
      }
    } else if (in_array($url, $tab2)) {
      if ($payload['role'] != "Receptioniste") {
        echo json_encode([
          'auth' =>  'Vous n\'avez pas le droit d\'effectuer cette action'
        ]);
        exit;
      }
    } else if (in_array($url, $tab3)) {
      if ($payload['role'] != "Admin") {
        echo json_encode([
          'auth' =>  'Vous n\'avez pas le droit d\'effectuer cette action'
        ]);
        exit;
      }
    } else if (in_array($url, $tab4)) {
      if ($payload['role'] != "User") {
        echo json_encode([
          'auth' => 'Vous n\'avez pas le droit d\'effectuer cette action'
        ]);
        exit;
      }
    }
    return $payload;
  } else {
    // echo json_encode([
    //   'login' =>  'true'
    // ]);
    // exit;
  }
}

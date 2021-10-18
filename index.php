<?php
// permet d'appeler les routes auto...
@ini_set('display_errors', 'on');
require 'vendor/autoload.php'; 

$router = new AltoRouter();
$router->map('GET','/',function($url){
    require "controllers/home.php";
},'home');

$router->map('GET','/home',function($url){
  require "controllers/home.php";
},'_home');


// Params
// $router->map('GET','/department/[i:IdD]',function($IdD){
//    echo $IdD;
// });

/** LOGIN */
$router->map('GET','/login',function($url){
  require "views/auth/login.php";
},'login');

$router->map('GET','/logout',function($url){
  require "controllers/auth/logout.php";
},'logout');

$router->map('POST','/login/set',function($url){
  require "controllers/auth/login.php";
},'login_set');

/** DEPARTMENT ROUTE */
$router->map('GET','/department',function($url){
  $url = "department";
  require "views/department/department.php";
  // authentication($payload);
},'department');
// get department
$router->map('GET','/department/get',function($url){
  require "controllers/department/getDepartment.php";
},'department_get');
// set department
$router->map('POST','/department/set',function($url){
  require "controllers/department/setDepartment.php";
},'department_set');
// edit department
$router->map('POST','/department/edit',function($url){
  require "controllers/department/editDepartment.php";
},'department_edit');
// delete department
$router->map('POST','/department/delete',function($url){
  require "controllers/department/deleteDepartment.php";
},'department_delete');

/** PERSONNEL ROUTE */
$router->map('GET','/personnel',function($url){
  require "views/personnel/personnel.php";
},'personnel');
// get personnel
$router->map('GET','/personnel/get',function($url){
  require "controllers/personnel/getPersonnel.php";
},'personnel_get');
// get One personnel
$router->map('GET','/personnel/get/[i:id]',function($id,$url){
  require "controllers/personnel/getOnePersonnel.php";
},'personnel_get_one');
// -- one personnel
$router->map('GET','/personnel/[i:id]',function($id,$url){
  require "views/personnel/getOnePersonnel.php";
  echo "<script> var idPersonnel=$id </script>";
  echo '</body></html>';
},'personnel_one_get');
// set personnel
$router->map('POST','/personnel/set',function($url){
  require "controllers/personnel/setPersonnel.php";
},'personnel_set');
// edit personnel
$router->map('GET','/personnel/edit/[i:id]',function($id,$url){
  require "views/personnel/editPersonnel.php";
  echo "<script> var idPersonnel=$id </script>";
  echo '</body></html>';
},'personnel_edit');
// set edit personnel
$router->map('POST','/personnel/edit/[i:id]',function($id,$url){
  require "controllers/personnel/editPersonnel.php";
},'personnel_edit_post');
// delete One personnel
$router->map('POST','/personnel/delete/[i:id]',function($id,$url){
  require "controllers/personnel/deletePersonnel.php";
},'personnel_one_delete');


/** RECEPTION ROUTE */
$router->map('GET','/reception',function($url){
  require "views/reception/reception.php";
},'reception');

/** FACTURE ROUTE */
$router->map('GET','/facture',function($url){
  require "views/reception/facture.php";
},'facture');
// set facture
$router->map('POST','/facture/set',function($url){
  require "controllers/reception/setFacture.php";
},'facture_set');

// profile
$router->map('GET','/profile',function($url){
  require "views/personnel/profile.php";
},'profile');




//Facture personnel -- Traitement
$router->map('GET','/factures',function($url){
  require "views/personnel/factures.php";
},'factures');

// Get Facture for personnel use
$router->map('GET','/factures_traitement/get',function($url){
  require "controllers/personnel/factures.php";
},'factures-get');

// echo '<br>';
// use Firebase\JWT\JWT;
// $payload = [
//   "id" => 2,
//   "role" => " ADMIN",
//   "iat" => time(),
//   "exp" => time()+(60*5),
// ];
// $private_key = 'amisi';
// $token = JWT::encode($payload, $private_key, "HS256");
// echo $token;
// echo "</br></br>";

// $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6Miwicm9sZSI6IiBBRE1JTiIsImlhdCI6MTYzMzk2NjE2NCwiZXhwIjoxNjMzOTY2NDY0fQ.-iIgp3Lj2t8cnF9r7IQ80nQ2BceHV-L46vSl94jSY60";
// $decoded = JWT::decode($jwt, $private_key, array('HS256'));
// echo "<pre>";
// echo "Decode:\n" . print_r((array) $decoded, true) . "\n";
// echo "</pre>";

// phpinfo();

  $match = $router->match();

  if( is_array($match) && is_callable( $match['target'] ) ) {
    $match['params']['url'] = $match['name'];
    call_user_func_array( $match['target'], $match['params'] ); 
  } else {
    // no route was matched
      echo 403;
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
  }

  // function authentication($payload)
  // {
  //   if($payload['role'] !== "Admin" OR $payload['role'] !== "Receptioniste")
  //     header("location: /profile");
  // }
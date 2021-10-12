<?php
// permet d'appeler les routes auto...
@ini_set('display_errors', 'on');
require 'vendor/autoload.php'; 

$router = new AltoRouter();
$router->map('GET','/',function(){
    require "controllers/home.php";
},'home');


// Params
// $router->map('GET','/department/[i:IdD]',function($IdD){
//    echo $IdD;
// });

/** LOGIN */
$router->map('GET','/login',function(){
  require "views/login.php";
},'login');

/** DEPARTMENT ROUTE */
$router->map('GET','/department',function(){
  require "views/department/department.php";
},'department');
// get department
$router->map('GET','/department/get',function(){
  require "controllers/department/getDepartment.php";
},'department_get');
// set department
$router->map('POST','/department/set',function(){
  require "controllers/department/setDepartment.php";
},'department_set');
// edit department
$router->map('POST','/department/edit',function(){
  require "controllers/department/editDepartment.php";
},'department_edit');
// delete department
$router->map('POST','/department/delete',function(){
  require "controllers/department/deleteDepartment.php";
},'department_delete');

/** PERSONNEL ROUTE */
$router->map('GET','/personnel',function(){
  require "views/personnel/personnel.php";
},'personnel');
// get personnel
$router->map('GET','/personnel/get',function(){
  require "controllers/personnel/getPersonnel.php";
},'personnel_get');
// get One personnel
$router->map('GET','/personnel/get/[i:id]',function($id){
  require "controllers/personnel/getOnePersonnel.php";
  getOnePersonnel($id);
},'personnel_get_one');
// set personnel
$router->map('POST','/personnel/set',function(){
  require "controllers/personnel/setPersonnel.php";
},'personnel_set');
// edit personnel
$router->map('GET','/personnel/edit/[i:id]',function($id){
  require "views/personnel/editPersonnel.php";
  echo "<script> var idPersonnel=$id </script>";
  echo '</body></html>';
},'personnel_edit');


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

    call_user_func_array( $match['target'], $match['params'] ); 
  } else {
    // no route was matched
      echo 403;
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
  }

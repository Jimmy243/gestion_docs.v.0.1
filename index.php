<?php
// permet d'appeler les routes auto...
require 'vendor/autoload.php'; 

$router = new AltoRouter();
$router->map('GET','/',function(){
    require "controllers/home.php";
},'home');
$router->map('GET','/department',function(){
    require "views/department/department.php";
},'department');

// Params
// $router->map('GET','/department/[i:IdD]',function($IdD){
//    echo $IdD;
// });

//route get datas
$router->map('GET','/department/get',function(){
    require "controllers/department/getDepartment.php";
},'department/get');



$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {

	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
    echo 403;
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
?>
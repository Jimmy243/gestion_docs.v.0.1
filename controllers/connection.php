<?php
function Connecter(){
    try {
    $db = new PDO("mysql:host=localhost;dbname=gestion_doc","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    return $db; 
}
catch( PDOException $Exception ) {
    // throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
    die($Exception->getMessage());
}
    
}






?>
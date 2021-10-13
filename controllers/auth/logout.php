<?php
function logout(){
  setcookie('gestion_doc',"",time()-(60*60),"/","",false,true);
  header("location: /login");
}

logout();
?>
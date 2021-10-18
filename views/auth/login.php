<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/links/link.php"; ?>
</head>

<body>
  <div class="main-wrapper account-wrapper" id="app">
    <div class="container">
     <div class="row">
       <div class="col-md-2">
         <img src="assets/img/burundi.png" width="100%" height="100" /></div>
       <div class="col-md-8">
       <p>
     <center>MINISTERE DES FINANCES, DU BUDGET ET DE LA PLANIFICATION ECONOMIQUE</center>
     <center><b>Ensemble pour batir une économie prospere</b></center>
     </p>
       </div>
       <div class="col-md-2"><img src="assets/img/dev.png" width="100%" height="120" /></div>
     </div> 
     
    </div>
    <div class="account-page">
      <div class="account-center">
        <div class="account-box">
          <form class="form-signin">
            <div class="account-logo">
              Gestion ! Docs
             </div>   
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">@</span>
  </div>
  <input type="email" placeholder="Adresse mail" v-model="email" autofocus="" class="form-control" required>
  </div>  
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">p</span>
  </div>
  <input type="password" placeholder="Mot de passe" v-model="password" class="form-control" required>
  </div> 
  <div class="form-group">
    <a href="#">Mot de passe oublie?</a>
  </div>
 <div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" v-model="souvenez_vous">
  <label class="form-check-label" for="inlineCheckbox1">Souvenez-vous de moi</label>
  </div>
  <div class="form-group text-center">
  <button type="button" class="btn btn-primary account-btn" v-on:click="valider">Se connecter</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include "includes/js/js.php"; ?>

  <script src="/assets/js/auth/login.js" defer></script>
</body>
</html>
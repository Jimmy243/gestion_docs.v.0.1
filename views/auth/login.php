<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/links/link.php"; ?>
</head>

<body>
  <div class="main-wrapper account-wrapper" id="app">
    <div class="account-page">
      <div class="account-center">
        <div class="account-box">
          <form class="form-signin">
            <div class="account-logo">
              Gestion ! Docs
            <div class="form-group">
              <label>Email</label>
              <input type="email" v-model="email" autofocus="" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Mot de passe</label>
              <input type="password" v-model="password" class="form-control" required>
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
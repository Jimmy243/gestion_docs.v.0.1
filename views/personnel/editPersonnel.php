<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/links/link.php"; ?>
</head>

<body>
  <div class="main-wrapper" id="app">
    <!-- Header -->
    <?php include "includes/header/header.php"; ?>
    <!-- End -->
    <!-- Sidebar -->
    <?php include "includes/sidebar/sidebar.php"; ?>
    <!--   Section Slider -->
    <div class="page-wrapper">
      <div class="content">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="page-title">Edition du profil de {{personnel.Fullname}}</h4>
          </div>
        </div>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="!personnel && message_error">
          <strong>Erreur 401:</strong> {{message_error}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form v-else id="setformp">
          <div class="card-box">
            <h3 class="card-title">Informations du personnel</h3>
            <div class="row">
              <div class="col-md-12">
                <div class="profile-img-wrap">
                  <img class="inline-block" :src="'/'+personnel.Images" alt="user" />
                  <div class="fileupload btn">
                    <span class="btn-text">editer</span>
                    <input class="upload" type="file" accept="image/*" name="Images"  />
                  </div>
                </div>
                <div class="profile-basic">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="Fullname" name="Fullname" placeholder="noms" :value="personnel.Fullname">
                        <label for="Fullname">Noms</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-control" id="Department" aria-label="Floating label select example" name="IdD" :value="personnel.IdD">
                          <option disabled selected value="selected"> Selectionner un departement</option>
                          <option v-for="(item,id) in tabDepartment" :key="item.id" v-bind:value="item.IdD">{{item.NameD}}</option>
                        </select>
                        <label for="Department">Departement</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="DateB" placeholder="Date de naissance" name="DateB" :value="personnel.DateB">
                        <label for="DateB">Date de naissance</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-control" id="Gander" aria-label="Floating label select example" name="Gander" :value="personnel.Gander">
                          <option disabled selected=""></option>
                          <option value="Homme">Homme</option>
                          <option value="Femme">Femme</option>
                        </select>
                        <label for="Gander">Selectionner le genre</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="card-box">
            <h3 class="card-title">Plus d'informations sur le personnel</h3>
            <div class="row">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="address" placeholder="Adresse" name="Addresss" :value="personnel.Addresss">
                  <label for="address">Adresse</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="NumberM" placeholder="NumberM" name="NumberM" :value="personnel.NumberM">
                  <label for="NumberM">Numero Matricule</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-control" id="States" aria-label="Floating label select example" name="States" :value="personnel.States">
                    <option disabled selected value="selected"> Selectionner une province d'origine</option>
                    <option v-for="(item,id) in tabPronvinces" :key="item.id" v-bind:value="item">{{item}}</option>
                  </select>
                  <label for="States">Province</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="email" placeholder="email" name="Email" :value="personnel.Email">
                  <label for="email">Email</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="Functions" placeholder="fonction" name="Functions" :value="personnel.Functions">
                  <label for="Functions">Fonction</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="Mobile" placeholder="Mobile" name="Mobile" :value="personnel.Mobile">
                  <label for="Mobile">Mobile</label>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="text-center m-t-20">
        <button class="btn btn-primary submit-btn" type="button" v-on:click="valider()">
          Enregistrer
        </button>
        <br><br>
      </div>
      </form>
    </div>
  </div>
  </div>
  <?php include "includes/js/js.php"; ?>

  <script src="/assets/js/sweetAlert.js" defer></script>
  <script src="/assets/js/personnel/editPersonnel.js" defer></script>
  
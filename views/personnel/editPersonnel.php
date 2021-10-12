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
            <h4 class="page-title">Editer Profil</h4>
          </div>
        </div>
        <form>
          <div class="card-box">
            <h3 class="card-title">Informations du personnel</h3>
            <div class="row">
              <div class="col-md-12">
                <div class="profile-img-wrap">
                  <img class="inline-block" src="/assets/img/doctor-thumb-05.jpg" alt="user" />
                  <div class="fileupload btn">
                    <span class="btn-text">editer</span>
                    <input class="upload" type="file" />
                  </div>
                </div>
                <div class="profile-basic">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-focus">
                        <label class="focus-label">Noms</label>
                        <input type="text" class="form-control floating" v-model="personnel.Fullname"/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus">
                        <label class="focus-label">Departement</label>
                        <input type="text" class="form-control floating" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus">
                        <label class="focus-label">Date de naissance</label>
                        <div class="cal-icon">
                          <input class="form-control floating datetimepicker" type="text" v-model="personnel.DateB" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus select-focus">
                        <label class="focus-label">Genre</label>
                        <select class="select form-control floating" v-model="personnel.Gander">
                          <option disabled selected="">Selectionner le genre</option>
                          <option value="Homme">Homme</option>
                          <option value="Femme">Femme</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="card-box">
            <h3 class="card-title">Pl</h3>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group form-focus">
                  <!-- <label class="focus-label">Adresse</label> -->
                  <input type="text" class="form-control floating" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-focus">
                  <!-- <label class="focus-label">Province</label> -->
                  <input type="text" class="form-control floating"  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-focus">
                  <!-- <label class="focus-label">Email</label> -->
                  <input type="text" class="form-control floating" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-focus">
                  <!-- 
<label class="focus-label">Personnel</label> -->
                  <input type="text" class="form-control floating" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-focus">
                  <!-- <label class="label">Mobile</label> -->
                  <input type="text" class="form-control floating" />
                </div>
              </div>
            </div>
          </div>
          <div class="text-center m-t-20">
            <button class="btn btn-primary submit-btn" type="button">
              Enregistrer
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include "includes/js/js.php"; ?>

  <script src="/assets/js/personnel/editPersonnel.js" defer></script>


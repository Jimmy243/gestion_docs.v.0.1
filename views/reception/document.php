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
          <div class="col-sm-5 col-5">
            <h4 class="page-title">DOCUMENT ADMINISTRAITIF</h4>
          </div>
          <div class="col-sm-7 col-7 text-right m-b-30">
            <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#ajoutdepart">
              <!-- <i class="fa fa-plus"></i> --> Gestion des Documents
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div id="message"></div>
              </div>
              <div class="card-body">
                <div class="message"></div>
                <!--  -->
                <form method="post" id="setformf" class="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Noms</label>
                        <input type="text" name="NameR" id="NameR" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fullname">Departement</label>
                        <select name="IdD" id="IdD" class="form-control" required @change="getIdD">
                          <option disabled selected value="0"> Selectionner un departement</option>
                          <option v-for="(item,id) in tabDepartment" :key="item.id" v-bind:value="item.IdD">{{item.NameD}}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="row">
                    <div class="col-md-6">
                      <label for="DateB">Personnel</label>
                      <select name="Id" id="Id" class="form-control" required>
                        <option disabled selected> Selectionner un personnel</option>
                        <option v-for="(item,id) in getPersonnelFilter" :key="item.id" v-bind:value="item.Id">{{item.Fullname}}</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="Docs">Document</label>
                        <input type="file" name="Docs" id="document" class="form-control" required accept="image/jpeg,.png,.pdf,.doc,.docx">
                      </div>
                    </div>
                    </div>
                    <!--  -->
                  <div class="">
                    <button type="button" id="submit" class="btn btn-info btn-block" v-on:click="valider()">
                      Envoyer
                    </button>
                   </div>

                  </div>
                  <!--  -->
                  </div>
                  
                  

                </form>

                <!--  -->
              </div>
            </div>
          </div>


        </div>

      </div>
    </div>
  </div>
  <?php require "includes/js/js.php"; ?>
  <script src="/assets/js/sweetAlert.js" defer></script>
 
</body>

</html>
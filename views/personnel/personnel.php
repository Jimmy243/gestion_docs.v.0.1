<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/links/link.php"; ?>
</head>

<body>
  <div class="main-wrapper">
    <!-- Header -->
    <?php include "includes/header/header.php"; ?>
    <!-- End -->
    <!-- Sidebar -->
    <?php include "includes/sidebar/sidebar.php"; ?>
    <!--   Section Slider -->

    <div id="app">
      <div class="page-wrapper">
        <div class="content">
          <div class="row">
            <!-- <div class="col-md-12"> -->
            <div class="col-md-8">
              <h4 class="page-title">PERSONNEL(ELLE)S</h4>
            </div>
            <!-- Admin only -->
            <?php if($payload['role'] === "Admin") { ?>
            <div class="col-md-4">
              <button type="button" @click="getDepartment" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#ajoutPersonnel" v-on:click="getDepartment">
                <i class="fa fa-plus"></i>
                AJOUT PERSONNEL
              </button>
            </div>
           <?php } ?>
            <!-- </div> -->
          </div>
     <?php if($payload['role'] === "Admin") { ?>
          <!-- alert for message -->
          <div v-show="showAlert">
            <div v-if="!isError">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succes</strong> Le personnel est enregistre avec succes.<br />
                Les donnees de connexion :
                <ul>
                  <li>Email {{email_login}}</li>
                  <li>Mot de passe {{password_login}}</li>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" v-on:click.stop="closeAlert">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div v-else>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur 401:</strong>
                <ul class="list-unstyled">
                  <li v-for="(error,id) in message_error" :key="error.id">{{error}}</li>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" v-on:click.stop="closeAlert">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-12">
              <div class="card card-transparent">
                <div class="card-header">
                  <center>Liste de personnels deja enregistres</center>
                </div>
                <div id="message"></div> 
                <div class="card-body">
                  <div class="row doctor-grid">
                    <div class="col-md-4 col-sm-4  col-lg-3" v-for="(item,id) in tabPersonnel" :key="item.id">
                      <div class="profile-widget">
                        <div class="doctor-img">
                          <a class="avatar" href="#"><img alt="" v-bind:src="item.Images"></a>
                        </div>
                        <!-- Admin only --> 
                        <?php if($payload['role'] === "Admin") { ?>
                        <div class="dropdown profile-action">
                          <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" :href="'/personnel/edit/'+item.Id"><i class="fa fa-pencil m-r-5"></i> Editer</a>
                            <a class="dropdown-item"  v-on:click="deletePersonnel(id)"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                            <a class="dropdown-item" :href="'/personnel/'+item.Id"><i class="fa fa-trash-o m-r-5"></i> Voir</a>
                          </div>
                        </div>
                        <?php } ?>
                        <h4 class="doctor-name text-ellipsis">{{item.Fullname}}</h4> 
                        <div class="doc-prof">{{item.Functions}}</div>
                        <div class="user-country">
                          <i class="fa fa-map-marker"></i>
                          {{item.States}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal for setPersonnel -->

        <div class="modal" tabindex="-1" role="dialog" id="ajoutPersonnel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajout personnel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" id="setformp" class="form">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fullname">Noms</label>
                        <input type="text" v-model="Fullname" id="Fullname" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Functions">Fonction</label>
                        <input type="text" v-model="Functions" id="Functions" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Departement</label>
                        <select v-model="IdD" id="IdD" class="form-control" required>
                          <option disabled selected value="selected"> Selectionner un departement</option>
                          <option v-for="(item,id) in tabDepartment" :key="item.id" v-bind:value="item.IdD">{{item.NameD}}</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="DateB">Date de naissance</label>
                        <input type="date" v-model="DateB" id="DateB" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Image">Image</label>
                        <input type="file" name="Images" id="Images" class="form-control" required accept="image/*">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Address">Adresse</label>
                        <input type="text" v-model="Addresss" id="Addresss" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="NumberM">Numero Matricule</label>
                        <input type="text" v-model="NumberM" id="NumberM" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fullname">Province</label>
                        <select v-model="States" id="States" class="form-control">
                          <option v-for="(item,id) in tabPronvinces" :key="item.id" v-bind:value="id">{{item}}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Gander">Genre</label>
                        <select v-model="Gander" id="Gander" class="form-control" required>
                          <option disabled selected="">Selectionner le genre</option>
                          <option value="Homme">Homme</option>
                          <option value="Femme">Femme</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Mobile">Mobile</label>
                        <input type="tel" v-model="Mobile" id="Mobile" class="form-control" maxlength="8">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fullname">E-mail</label>
                        <input type="email" v-model="Email" id="Email" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <br /><br />
                      <button type="button" class="btn btn-info btn-block" v-on:click="setPersonnel"> Enregistrer</button>
                    </div>
                  </div>
                  <!--  -->
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include "includes/js/js.php"; ?>
  <script src="assets/js/personnel/personnel.js" defer></script>

</body>

</html>
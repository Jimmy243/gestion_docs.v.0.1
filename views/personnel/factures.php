<!DOCTYPE html>
<html lang="en">

<head>
  <?php require "includes/links/link.php"; ?>
</head>

<body>
  <div class="main-wrapper" id="app">
    <!-- Header -->
    <?php require "includes/header/header.php"; ?>
    <!-- End -->
    <!-- Sidebar -->
    <?php require "includes/sidebar/sidebar.php"; ?>
    <!--   Section Slider -->

    <div class="page-wrapper">
      <div class="content">
        <div class="row">
          <div class="col-sm-5 col-5">
            <h4 class="page-title">TRAITEMENT DE FACTURES</h4>
          </div>
          <div class="col-sm-7 col-7 text-right m-b-30">
            <!-- <b class="btn btn-primary btn-rounded">Gestion de Facture</b> -->
          </div>
        </div>
        <div class="card-body">
          <!-- Tableau collapse -->
          <div class="profile-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
              <li class="nav-item"><a class="nav-link " href="#about-cont" data-toggle="tab" id="tab1">Les Factures en cours de traitement </a></li>
              <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab" id="tab2">Les Factures non traités <span class="badge badge-pill bg-danger float-right" style="color:white">{{tabFacture.notTreated.length}}</span></a></li>
              <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab" id="tab3">Les Factures déja traités <span class="badge badge-pill bg-success float-right" style="color:white">{{tabFacture.treated.length}}</span></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="about-cont">
                <div class="container">
                  <div class="card">
                    <div class="card-header" v-if="facture">Envoie le facture traité</div>
                    <div class="card-body">
                      <div class="container" v-if="facture">
                        <div class="row">
                          <div class="col-md-8">
                            <form class="form">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="Ref">La reférence de facture</label>
                                    <input type="text" class="form-control" v-bind:value="facture.Reference">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="NameR">Nom du depositaire</label>
                                    <input type="text" v-bind:value="facture.NameR" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Devise</label>
                                    <input type="text" v-bind:value="facture.Devise" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Montant</label>
                                    <input type="text" v-bind:value="facture.MontantF" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <!-- Modal image  -->
                          <div class="col-md-4">

                            <img id="myImg" v-bind:src="`/${facture.Facture}`" data-toggle="modal" data-target="#myModal" style="width:100%;max-width:300px;height:100%;max-height:200px;cursor: pointer;">

                          </div>
                          <!--  -->
                        </div>
                        <!--  -->
                        <form class="form">
                          <div class="form-group">
                            <div class="form-group">
                              <label for="Ref">Motif du facture</label>
                              <textarea id="" cols="30" rows="4" required class="form-control" v-model="Motif"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <button class="btn btn-info" type="button" v-on:click="setFactureTrait(facture.IdF)">
                              Envoyer
                            </button>
                          </div>
                        </form>
                      </div>
                      <div class="container" v-else>
                        <p v-if="tabFacture.notTreated.length > 0">Veuillez selectionner une facture pour la traiter</p>
                        <p v-else>A present vous n'avez pas de factures a traiter</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- {{tabFacture}} -->
              <div class="tab-pane show active" id="bottom-tab2">
                <div class="responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          <center>#</center>
                        </th>
                        <th>
                          <center>Nom du depositaire</center>
                        </th>
                        <th>
                          <center>Reférence</center>
                        </th>
                        <th>
                          <center>Montant</center>
                        </th>
                        <th>
                          <center>Devise</center>
                        </th>
                        <th>
                          <center>Date de dépot</center>
                        </th>
                        <th>
                          <center>traitement de Facture</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,id) in tabFacture.notTreated" :key="item.id">
                        <td>
                          <center>{{id+1}}</center>
                        </td>
                        <td>
                          <center>{{item.NameR}}</center>
                        </td>
                        <td>
                          <center>{{item.Reference}}</center>
                        </td>
                        <td>
                          <center>{{item.MontantF}}</center>
                        </td>
                        <td>
                          <center>{{item.Devise}}</center>
                        </td>
                        <td>
                          <center>{{item.DateEnreg}}</center>
                        </td>
                        <td>
                          <center>
                            <button class="btn btn-info" title="traitement de Facture" v-on:click="setTraitement(item.IdF)">
                              cliquer</button>
                          </center>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
              <div class="tab-pane" id="bottom-tab3">

                <div class="responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          <center>#</center>
                        </th>
                        <th>
                          <center>Nom du depositaire</center>
                        </th>
                        <th>
                          <center>Reférence</center>
                        </th>
                        <th>
                          <center>Montant</center>
                        </th>
                        <th>
                          <center>Devise</center>
                        </th>
                        <th>
                          <center>Date de traitement</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,id) in tabFacture.treated" :key="item.id">
                        <td>
                          <center>{{id+1}}</center>
                        </td>
                        <td>
                          <center>{{item.NameR}}</center>
                        </td>
                        <td>
                          <center>{{item.Reference}}</center>
                        </td>
                        <td>
                          <center>{{item.MontantF}}</center>
                        </td>
                        <td>
                          <center>{{item.Devise}}</center>
                        </td>
                        <td>
                          <center>{{item.DateT}}</center>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>


        </div>

      </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img id="myImg" v-bind:src="`/${facture.Facture}`" style="width:100%;max-width:100%">
        </div>
      </div>
    </div>


    <?php require "includes/js/js.php"; ?>
    <script src="assets/js/sweetAlert.js" defer></script>
    <script src="assets/js/personnel/factureTraitement.js" defer></script>
</body>
</html>
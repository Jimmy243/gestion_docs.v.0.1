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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <span>LES DOCUMENTS DEJA TRAITE</span>
                </div>
              </div>
            </div>
          </div>
          <!-- HEADER  -->
          <div class="r">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">

                  <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                      <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">
                          Les factures deja traitees
                        </a></li>
                      <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">
                          Les documents administratifs deja traites
                        </a></li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane show active" id="about-cont">
                        <div class="container">
                          <div class="card">
                            <!-- <div class="card-header">Listes de factures</div> -->
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group row col-sm-8">
                                  <label for="trie" class="col-sm-4 col-form-label">Trier par: </label> 
                                  <select class="form-control col-sm-8" name="tri" id="tri" v-on:click.stop="getTri" v-model="by">
                                    <!-- <option value="date_t">Date de traitement {{getIcon("date_t")}} </option> -->
                                    <option value="date_d">Date du depot {{getIcon("date_d")}} </option>
                                    <option value="depart">Departement {{getIcon("depart")}} </option>
                                    <option value="montant">Montant {{getIcon("montant")}} </option>
                                    <option value ="name_p">Nom du personnel {{getIcon("name_p")}} </option>
                                  </select>
                                </div>
                                <div class="col-4 clear-fix">
                                 <button type="button" class="btn btn-primary float-right">Filtre avance</button>
                                </div>
                              </div>
                              <div class="responsive">
                                <table class="table table-strited">
                                  <thead>
                                    <tr>
                                      <th>
                                        <center>#</center>
                                      </th>
                                      <th>
                                        <center>Departement</center>
                                      </th>
                                      <th>
                                        <center>Nom du personnel</center>
                                      </th>
                                      <th>
                                        <center>Montant</center>
                                      </th>
                                      <th>
                                        <center>Date du depot</center>
                                      </th>
                                      <th>
                                        <center>Date de traitement</center>
                                      </th>
                                      <th>
                                        <center>Etat</center>
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="(item,id) in tabInvoice" :key="item.id">
                                      <td>
                                        <center>{{id+1}}</center>
                                      </td>
                                      <td>
                                        <center>{{item.NameD}}</center>
                                      </td>
                                      <td>
                                        <center>{{item.Fullname}}</center>
                                      </td>
                                      <td>
                                        <center>{{item.MontantF}}FBU</center>
                                      </td>
                                      <td>
                                        <center>{{item.DateEnreg}}</center>
                                      </td>
                                      <td>
                                        <center>
                                          <span v-if="item.state=='Traitee'">{{item.DateT}}</span>
                                          <span v-else>-----</span>
                                        </center>
                                      </td>
                                      <td>
                                        <center>
                                          <button class="btn btn-success" v-if="item.state=='Traitee'">{{item.state}}</button>
                                          <button class="btn btn-danger" v-else>{{item.state}}</button>
                                        </center>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="clear-fix">
                                <div class="float-right">
                                  <button type="button" class="btn btn-primary" v-on:click="getInvoiceByPagination('back')" v-bind:disabled="back == 0">Back</button>
                                  <button type="button" class="btn btn-primary" v-on:click="getInvoiceByPagination('next')" v-bind:disabled="next == 0">Next</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="bottom-tab2">
                        <div class="card">
                          <div class="card-header">Listes de documents</div>
                          <div class="card-body">

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include "includes/js/js.php"; ?>
  <script type="text/javascript" src="/assets/js/sweetAlert.js" defer></script>
  <script src="/assets/js/invoice/invoice.js"></script>
</body>

</html>
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
                                    <td><center>{{id+1}}</center></td>
                                    <td><center>{{item.NameD}}</center></td>
                                    <td><center>{{item.Fullname}}</center></td>
                                    <td><center>{{item.MontantF}}FBU</center></td>
                                    <td><center>{{item.DateEnreg}}</center></td>
                                    <td><center>
                                      <span v-if="item.state=='Traitee'">{{item.DateT}}</span>
                                      <span v-else>------</span>
                                    </center></td>
                                    <td><center>
                                      <button v-if="item.state=='Traitee'" class="btn btn-success">
                                      {{item.state}} </button>
                                      <button v-else class="btn btn-danger">
                                      {{item.state}}</button> 
                                    </center></td>
                                    
                                    </tr>
                                  </tbody>
                                </table>
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
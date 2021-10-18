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
       <div class="row">
        <div class="col-md-12">
         <div class="card">
          <div class="card-header">
            <div id="message"></div>
        </div>
        <div class="card-body">
        <!-- Tableau collapse -->
        <div class="profile-tabs">
          <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Les Factures en cours de traitement </a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Les Factures non traités <span class="badge badge-pill bg-info float-right"
            style="color:white">{{tabFacture.length}}</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Les Factures déja traités</a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
              <div class="container">
                <div class="card">
                  <div class="card-header">Envoie le facture traité</div>
                  <div class="card-body">
                    <div class="container">
                    <form method="POST" class="form"  >
                       <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                            <label for="Ref">La reférence de facture</label>
                            <input type="text" class="form-control" v-bind:value="facture.Reference">
                            </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                                <label for="NameR">Nom du depositaire</label>
                                <input type="text" v-bind:value="facture.NameR" class="form-control">
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                                <label for="">Devise</label>
                                <input type="text" v-bind:value="facture.Devise" class="form-control">
                             </div>
                          </div>
                       </div>
                       <div class="row">
                          <div class="col-md-4">
                             <div class="form-group">
                                <label for="">Montant</label>
                                <input type="text" v-bind:value="facture.MontantF" class="form-control">
                             </div>
                          </div>
                    
                          <div class="col-md-8">
                          <div class="form-group">
                        <label for="Ref">Motif du facture</label>
                        <textarea id="" cols="30" rows="4" required class="form-control">
                           
                        </textarea>
                      </div>
                          </div>
                       </div>  
          
                      
                      
                      <div class="form-group">
                        <button class="btn btn-info" v-on:click="setFactureTrait()">
                            Envoyer
                        </button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- {{tabFacture}} -->
            <div class="tab-pane" id="bottom-tab2">
              <div class="responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                     <th><center>#</center></th>
                     <th><center>Nom du depositaire</center></th>
                     <th><center>Reférence</center></th>
                     <th><center>Montant</center></th>
                     <th><center>Devise</center></th>
                     <th><center>traitement de Facture</center></th>
                   </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item,id) in tabFacture" :key="item.id">
                      <td><center>{{id+1}}</center></td>
                      <td><center>{{item.NameR}}</center></td>
                      <td><center>{{item.Reference}}</center></td>
                      <td><center>{{item.MontantF}}</center></td>
                      <td><center>{{item.Devise}}</center></td>
                      <td><center>
                        <button class="btn btn-info" title="traitement de Facture"
                         v-on:click="setTraitement(item.IdF)"
                         href="#about-cont" data-toggle="tab"
                         >
                         cliquer</button>
                      </center></td>
                    </tr>  
                  </tbody>
                </table>

              </div>
            </div>
            <div class="tab-pane" id="bottom-tab3">
              Tableau 3
            </div>
          </div>
        </div>
      </div>
      
        <!--  -->
        </div>
        </div>
        </div>
              
               
      </div>    

        </div>
    </div>
</div>
   <?php require "includes/js/js.php"; ?>
   <script src="assets/js/personnel/factureTraitement.js" defer></script>
</body>

</html>
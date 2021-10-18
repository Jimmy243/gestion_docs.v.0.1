<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "includes/links/link.php"; ?>
</head>

<body>
    <div class="main-wrapper">
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
        <b class="btn btn-primary btn-rounded">Gestion de Facture</b>
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
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Les Factures en cours de traitement</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Les Factures non traités</a></li>
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
                      <div class="form-group">
                        <label for="Ref">La reférence de facture</label>
                        <input type="number" min="1" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="Ref">Motif du facture</label>
                        <textarea id="" cols="30" rows="4" required class="form-control">

                        </textarea>
                      </div>
                      <div class="form-group">
                        <label for="Ref">Date du traitement de facture</label>
                        <input type="date"  class="form-control" required>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-info">
                            Envoyer
                        </button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="bottom-tab2">
              Tableau 2
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

</body>

</html>
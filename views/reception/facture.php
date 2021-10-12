<!DOCTYPE html>
<html lang="en">
<head>
    <?php include"includes/links/link.php"; ?>
</head>

<body>
    <div class="main-wrapper">
        <!-- Header -->
         <?php include"includes/header/headerReception.php"; ?>
        <!-- End -->
        <!-- Sidebar -->
        <?php include"includes/sidebar/sidebarReception.php"; ?>
      <!--   Section Slider -->

        <div class="page-wrapper">
            <div class="content">
             <div class="row">
      <div class="col-sm-5 col-5">
        <h4 class="page-title">FACTURE</h4>
      </div>
      <div class="col-sm-7 col-7 text-right m-b-30">
        <a href="#" class="btn btn-primary btn-rounded"
           data-toggle="modal" 
           data-target="#ajoutdepart" ><!-- <i class="fa fa-plus"></i> --> Gestion de Facture</a>
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
                         <div class="col-md-4">
                         <div class="form-group">
                         <label for="name">Noms</label>
                          <input type="text" name="NameR" id="NameR" class="form-control" required>
                   </div>
               </div>
               <div class="col-md-4">
                     <div class="form-group">
                        <label for="Functions">Reference</label>
                        <input type="number" name="Reference" id="Reference" class="form-control" require>
                     </div>
                 </div>
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="fullname">Departement</label>
                       <select name="IdD" id="IdD" class="form-control">
                       <option disabled selected>
                           Selectionner un departement
                       </option>
                        <option value="">Direction de budget</option>
                       </select>
                   </div>
               </div>
            </div>
            <!--  -->
            <div class="row">
            <div class="col-md-4">
                   <div class="form-group">
                       <label for="DateB">Personnel</label>
                       <input type="text" name="Id" id="Id" class="form-control" required>
                   </div>
               </div> 
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="Image">Devise</label>
                       <select name="Devise" id="Devise" class="form-control">
                         <option disabled selected>Selectionner le devise</option>
                         <option value="FBU">FBU</option>
                         <option value="USD">USD</option>
                       </select>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                   <label for="Address">Montant</label>
                   <input type="number" name="MontantF" id="MontantF" class="form-control" required>
                   </div>
               </div>
               
            </div>
            <!--  -->
            
            <!--  -->
            <div class="row">
            <div class="col-md-4">
                   <div class="form-group">
                       <label for="Mobile">Date d'envoie</label>
                       <input type="date" name="DateEnreg" id="DateEnreg" class="form-control" required>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="DateE">Echeance du traitement document</label>
                       <input type="number" name="DateE" id="DateE" class="form-control" required>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="DateE">Facture</label>
                       <input type="file" name="Facture" id="Facture" class="form-control" required>
                   </div>
               </div>
               

             </div>
             <!--  -->
             <div class="col-md-4">
                     <br/>
                     <button type="submit" id="submit" class="btn btn-info btn-block">
                        Envoyer
                     </button>
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

</body>

</html>


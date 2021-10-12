<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "includes/links/link.php"; ?>
</head>

<body>
    <div class="main-wrapper">
        <!-- Header -->
         <?php require "includes/header/headerReception.php"; ?>
        <!-- End -->
        <!-- Sidebar -->
        <?php require "includes/sidebar/sidebarReception.php"; ?>
      <!--   Section Slider -->

        <div class="page-wrapper">
            <div class="content">
             <div class="row">
      <div class="col-sm-5 col-5">
        <h4 class="page-title">RECEPTION</h4>
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
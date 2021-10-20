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
          <div class="card">
              <div class="card-header">PERFORMANCES DES PERSONNELS</div>
          </div>
          <!-- Performance -->
          <div class="row">
          <div class="col-12 col-md-8 col-lg-8 col-xl-8">
            <div class="card">
              <div class="card-body">
                <div class="chart-title">
                  <h4>PERSONNELS ET LEURS PERFORMANCES</h4>
                  <div class="float-right">
                    <ul class="chat-user-total">
                      <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
                      <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
                    </ul>
                  </div>
                </div>  
                <canvas id="bargraph"></canvas>
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
</body>

</html>

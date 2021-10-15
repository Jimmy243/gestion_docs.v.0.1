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
          <div class="col-sm-7 col-6">
            <h4 class="page-title">Mon Profil </h4>
          </div>
          <?php if($payload['role'] === "Admin"){ ?>
          <div class="col-sm-5 col-6 text-right m-b-30">
            <a href="#" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Editer Profil</a>
          </div>
          <?php } ?> 
        </div>
        <div class="card-box profile-header">
          <div class="row">
            <div class="col-md-12">
              <div class="profile-view">
                <div class="profile-img-wrap">
                  <div class="profile-img">
                    <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a>
                  </div>
                </div>
                <div class="profile-basic">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="profile-info-left">
                        <h3 class="user-name m-t-0 mb-0">{{tabPersonnel.Fullname}}</h3>
                        <small class="text-muted">{{tabPersonnel.NameD}}</small>
                        <div class="staff-id">Personnel ID : {{tabPersonnel.NumberM}}</div>
                        <div class="staff-msg"><a href="#" class="btn btn-primary">Envoyer Message</a></div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <ul class="personal-info">
                        <li>
                          <span class="title">Phone:</span>
                          <span class="text"><a href="#">{{tabPersonnel.Mobile}}</a></span>
                        </li>
                        <li>
                          <span class="title">Email:</span>
                          <span class="text"><a href="#">{{tabPersonnel.Email}}</a></span>
                        </li>
                        <li>
                          <span class="title">Date de naissancce:</span>
                          <span class="text">{{tabPersonnel.DateB}}</span>
                        </li>
                        <li>
                          <span class="title">Adresse:</span>
                          <span class="text">714 Bujumbura  {{tabPersonnel.Addresss}}</span>
                        </li>
                        <li>
                          <span class="title">Genre:</span>
                          <span class="text">{{tabPersonnel.Gander}}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--  -->
        <div class="profile-tabs">
          <ul class="nav nav-tabs nav-tabs-bottom">
            <?php  if($payload['role']==='User'){ ?> 
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">
            Performance de mr {{tabPersonnel.Fullname}}
            </a></li>
            <?php } ?>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Listes de rendez-vous</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
              <div class="container">
                <div class="card">
                  <div class="card-header">Performance</div>
                  <div class="card-body">

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

    </div>
  </div>
  <script> 
    var personelId = <?php echo $payload['id']; ?> 
  </script>

  <?php include "includes/js/js.php"; ?>

  <script src="assets/js/personnel/profile.js" defer></script>


</body>
</html>
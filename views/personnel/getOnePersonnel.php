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
     <div class="col-sm-7 col-6">
     <h4 class="page-title">Mon Profil</h4>
     </div>
     <div class="col-sm-5 col-6 text-right m-b-30">
     <a href="edit/+tabPersonnel.Id" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Editer Profil</a>
     </div>
     </div>   
     <!--  -->
     <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                    <a class="avatar" href="#"><img alt="" v-bind:src="tabPersonnel.Images"></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{tabPersonnel.Fullname}}</h3>
                                                <small class="text-muted">{{tabPersonnel.NameD}}</small>
                                                <div class="staff-id">Personnel ID : {{tabPersonnel.NumberM}}</div>
                                                <div class="staff-msg"><a href="#" class="btn btn-primary">Envoyer un message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Mobile:</span>
                                                    <span class="text"><a href="#">{{tabPersonnel.Mobile}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Mail:</span>
                                                    <span class="text"><a href="#">{{tabPersonnel.Email}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Date-n:</span>
                                                    <span class="text">{{tabPersonnel.DateB}}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Adresse:</span>
                                                    <span class="text">Bujumbura {{tabPersonnel.Addresss}}</span>
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
      <!--  -->
      <div class="profile-tabs">
          <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">
            Plus d'information 
            </a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Performance de mr {{tabPersonnel.Fullname}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
              <div class="container">
                <div class="card">
                  <!-- <div class="card-header"></div> -->
                  <div class="card-body">
                  <ul class="personal-info">
                   <li>
                    <span class="title">Fonction</span>
                    <span class="text"><a href="#">{{tabPersonnel.Functions}}</a></span>
                   </li>
                   <li>
                    <span class="title">Statut</span>
                    <span class="text"><a href="#">{{tabPersonnel.Statuss}}</a></span>
                   </li>
                   <li>
                    <span class="title">Role</span>
                    <span class="text"><a href="#">{{tabPersonnel.Roles}}</a></span>
                   </li>
                  </ul>
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
</div>
</body>
</html>
<?php include "includes/js/js.php"; ?> 
<script src="/assets/js/personnel/getOnePersonnel.js" defer></script>

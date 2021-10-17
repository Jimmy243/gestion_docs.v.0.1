<?php
  include dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR."auth".DIRECTORY_SEPARATOR."verifyToken.php";
  if(!empty($_COOKIE['gestion_doc']))
  {
    $token = $_COOKIE['gestion_doc'];
    $payload = verifyToken($token);
    if(!empty($url))
    {
      $tab1 = ["department","personnel"]; // Admin et Receptioniste
      $tab2 = ["facture","appointment"]; // Receptioniste
      if(in_array($url,$tab1))
      {
        if($payload['role'] != "Admin" AND $payload['role'] != "Receptioniste")
          header("location: /profile");
      }else{
        if(in_array($url,$tab2))
        {
          if($payload['role'] != "Receptioniste")
            header("location: /profile");
        }
      }
    }
  }else{
    header("location: /login");
  }
?>
   <div class="header">
			<div class="header-left">
				<a href="index.html" class="logo">
					 <span><i class="fa fa-file"></i> MiniDocs</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fas fa-bell"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Prime</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">G</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">Toutes les Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fas fa-comment"></i> <span class="badge badge-pill bg-danger float-right">12</span></a>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
                        <?php  
                        if($payload['role']=='Admin'){ ?>
						<span>ADMIN</span>
                        <?php }elseif($payload['role']=='Receptioniste'){ ?>
						<span>Receptionniste</span>
                        <?php  }else{ ?>
						<span>Personnel</span>
                        <?php } ?> 
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/profile">Mon Profil</a>
						<a class="dropdown-item" href="/logout">Deconnection</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/profile">Mon Profil</a>
                    <a class="dropdown-item" href="/logout">Deconnection</a>
                </div>
            </div>
        </div>
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <!-- Tout le monde -->
        <?php if($payload['role'] === "Admin" OR $payload['role'] === "Receptioniste" OR $payload['role'] === "User"){ ?>
        <li class="active">
          <a href="/profile"><i class="fa fa-dashboard"></i> <span>Tableau de board</span></a>
        </li>
        <?php } ?> 
        <!-- Admin ET Receptioniste -->

        <?php if($payload['role'] === "Admin" OR $payload['role'] === "Receptioniste"){ ?>
        <li>
          <a href="/personnel"><i class="fa fa-user-md"></i> <span>Personnels</span></a>
        </li>
        <li>
          <a href="/department"><i class="fa fa-wheelchair"></i> <span>Départements</span></a>
        </li>
          <?php } ?> 

          <!-- Admin only -->
          <?php if($payload['role'] === "Admin"){ ?>
        <li>
          <a href=""><i class="fa fa-calendar"></i> <span>Documents</span></a>
        </li>
        <li>
          <a href="/invoice"><i class="fa fa-calendar"></i> <span>Factures</span></a>
        </li>
        <li>
          <a href=""><i class="fa fa-calendar-check-o"></i> <span>Performances</span></a>
        </li>
        <?php } ?>   



        <!-- Receptioniste  -->
        <?php if($payload['role'] === "Receptioniste"){ ?>
        <li>
          <a href="/facture"><i class="fa fa-calendar-check-o"></i> <span>Factures</span></a>
        </li>
        <li>
          <a href=""><i class="fa fa-calendar-check-o"></i> <span>Documents</span></a>
        </li>
        <?php } ?> 
        <!-- Pour le personnel -->
        <?php if($payload['role'] === "User"){ ?>
        <li>
          <a href="/factures"><i class="fa fa-calendar-check-o"></i> <span>Factures</span></a>
        </li> 
        <li>
          <a href=""><i class="fa fa-calendar-check-o"></i> <span>Documents</span></a>
        </li>
        <?php } ?> 
          <!-- Tout le monde -->
        <li>
          <a href=""><i class="fa fa-calendar-check-o"></i> <span>Messageries</span></a>
        </li>
        <li>
          <a href=""><i class="fa fa-calendar-check-o"></i> <span>Rendez-vous</span></a>
        </li>
        <?php if($payload['role'] === "Receptioniste"){ ?>
        <li>
        <a href="/appointment"><i class="fa fa-calendar-check-o"></i> <span>Gestion de rendez-vous </span></a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>

</div>

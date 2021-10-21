<?php
function getColor($_url,$url){
  if($_url === $url)
  return 'style="color: #009efb!important;"';
}
?>

<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <!-- Tout le monde -->
        <?php if($payload['role'] === "Admin" OR $payload['role'] === "Receptioniste" OR $payload['role'] === "User"){ ?>
        <li class="active">
          <a href="/"><i class="fa fa-dashboard"></i> <span>Tableau de board</span></a>
        </li>
        <?php } ?> 
        <!-- Admin ET Receptioniste -->

        <?php if($payload['role'] === "Admin" OR $payload['role'] === "Receptioniste"){ ?>
        <li>
          <a href="/personnel" <?= getColor("personnel",$url) ?> ><i class="fa fa-user-md"></i> <span>Personnels</span></a>
        </li>
        <li>
          <a href="/department" <?= getColor("department",$url) ?>><i class="fa fa-wheelchair"></i> <span>Départements</span></a>
        </li>
          <?php } ?> 

          <!-- Admin only -->
        <?php if($payload['role'] === "Admin"){ ?>
        <li>
          <a href="/home" <?= getColor("home",$url) ?>><i class="fa fa-file-text"></i> <span>Statistique</span></a>
        </li>
        <li>
          <a href="/invoice" <?= getColor("invoice",$url) ?>><i class="fa fa-file-text"></i> <span>Docs & Factures</span></a>
        </li>
        <li>
          <a href="/performance" <?= getColor("invoice",$url) ?>><i class="fa fa-calendar-check-o"></i> <span>Performances</span></a>
        </li>
        <?php } ?>   



        <!-- Receptioniste  -->
        <?php if($payload['role'] === "Receptioniste"){ ?>
        <li>
          <a href="/facture" <?= getColor("facture",$url) ?> ><i class="fa fa-file-text"></i> <span>Factures</span></a>
        </li>
        <li>
          <a href=""><i class="fa fa-file-text"></i> <span>Documents</span></a>
        </li>
        <?php } ?> 
        <!-- Pour le personnel -->
        <?php if($payload['role'] === "User"){ ?>
        <li>
          <a href="/factures" <?= getColor("factures",$url) ?> ><i class="fa fa-file-text"></i> <span>Factures</span></a>
        </li> 
        <li>
          <a href=""><i class="fa fa-file-text"></i> <span>Documents</span></a>
        </li>
        <?php } ?> 
          <!-- Tout le monde -->
        <li>
          <a href=""><i class="fa fa-commenting-o "></i> <span>Messageries</span></a>
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

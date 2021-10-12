<!DOCTYPE html>
<html lang="en">
<head>
    <?php require"includes/links/link.php"; ?>
</head>

<body>
  <div id="app">
  <div class="main-wrapper">
  <!-- Header -->
  <?php require"includes/header/header.php"; ?>
  <!-- End -->
  <!-- Sidebar -->
  <?php require"includes/sidebar/sidebar.php"; ?>
  <!--   Section Slider -->
<div class="page-wrapper">
  <div class="content"> 
    <div class="row">
      <div class="col-sm-5 col-5">
        <h4 class="page-title">Departments</h4>
      </div>
      <div class="col-sm-7 col-7 text-right m-b-30">
        <a href="add-department.html" class="btn btn-primary btn-rounded" 
        data-toggle="modal" data-target="#ajoutDepart"><i class="fa fa-plus"></i> Add Department</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Department Name</th>
                  <th  class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item,id) in tab" :key="item.id">
                  <td >{{id+1}}</td>  
                  <td >{{item.NameD}}</td>  
                  <td class="text-right">
                  <button type="button" class="btn btn-primary edit" 
                  >edit</button>
                  <button type="button" class="btn btn-danger" 
                  v-on:click="deleteDepartment(id)">
                  delete</button>
                  </td>  
                </tr>
              </tbody>
            </table>
          </di>
        </div>
      </di>
    </di>
  </div>
</div>

<!-- ajout department -->

<div class="modal" tabindex="-1" role="dialog" id="ajoutDepart">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><center>Ajout departement </center></h5>
        <button type="button" cla ss="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          <form method="POST">
             <div class="form-group">
              <label for="NameD">Nom de departement</label>
              <input v-model="setNameD" class="form-control">
             </div><br/>
             <div>
             <button type="button" class="btn btn-info" v-on:click="setDepartment()">
               Enregistrer
            </button>
             </div>
          </form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Editer departement -->
<div class="modal" tabindex="-1" role="dialog" id="editDepart">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><center>Editer un departement </center></h5>
        <button type="button" cla ss="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          <form method="POST">
             <div class="form-group">
              <label for="NameD">Nom de departement</label>
              <input v-model="setNameD" class="form-control">
             </div><br/>
             <div>
             <button type="button" class="btn btn-info" v-on:click="setDepartment()">
               Enregistrer
            </button>
             </div>
          </form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



  </div>


<?php require "includes/js/js.php";?>
<script src="assets/js/depart/department.js" defer></script>

</body>
</html>


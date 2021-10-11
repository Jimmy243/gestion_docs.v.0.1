<!DOCTYPE html>
<html lang="en">
<head>
    <?php require"includes/links/link.php"; ?>
</head>

<body>
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
        <a href="add-department.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
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
                  <th>Status</th>
                  <th  class="text-right">Action</th>
                </tr>
              </thead>
              <tbody  id="dapp" >
                <tr v-for="(item,id) in tab" :key="item.id">
                  <td >{{id+1}}</td>  
                  <td >{{item.NameD}}</td>  
                  <td >active</td>  
                  <td class="text-right">
                  <button type="button" class="btn btn-primary" v-on:click="getIdBForEdeting(id)">edit</button>
                  <button type="button" class="btn btn-danger" v-on:click="deleteDepartment(id)">delete</button>
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

<?php require "includes/js/js.php"; ?>

</body>
</html>


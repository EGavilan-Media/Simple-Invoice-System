<?php
  include('include/header.php');
?>

<!-- Page Content -->
<div class="container">
  <br><br>
  <!-- Simple Invoice System Cards -->
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card bg-light border-info text-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <h2><i class="fas fa-file-invoice-dollar"></i></h2>
          </div>
          <h4><b id="total_orders"></b> Total Invoices</h4>
        </div>
        <a class="card-footer border-info text-muted clearfix small z-1" href="invoice.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card bg-light border-info text-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <h2><i class="fas fa-users"></i></h2>
          </div>
          <h4><b id="total_users"></b> Total Users</h4>
        </div>
        <a class="card-footer border-info text-muted clearfix small z-1" href="user.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card bg-light border-info text-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <h2><i class="fas fa-users-cog"></i></h2>
          </div>
          <h4><b id="total_admin"></b> Total Admin</h4>
        </div>
        <a class="card-footer border-info text-muted clearfix small z-1" href="user.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card bg-light border-info text-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <h2><i class="fas fa-fw fa-dollar-sign"></i></h2>
          </div>
          <h4><b id="total_income"></b> Income</h4>
        </div>
        <a class="card-footer border-info text-muted clearfix small z-1" href="invoice.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
  <!-- End Simple Invoice System Information Cards -->

  <!-- Monthly Income Graphic -->
  <div class="card mb-3 border-info mb-3">
    <div class="card-header border-info">
      <i class="fas fa-table"></i>
      Latest Created Invoices
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="latest_invoices"></div>
      </div>
    </div>
  </div>
  <!-- Monthly Income Graphic -->

</div>

<div style="height: 265px;"></div>

<!-- Footer -->
<?php
  include("include/footer.php");  
?>

<script>
  $(document).ready(function(){
  
    $.ajax({
      type:"POST",
      data:{action:'add_info'},
      url:"admin_action.php",
      dataType:"json",
      success:function(data){
        $('#total_orders').text(data['total_orders']);
        $('#total_users').text(data['total_users']);
        $('#total_admin').text(data['total_admin']);
        $('#total_income').text(data['total_income']);
      }
    });

    $.ajax({
      url:"admin_action.php",
      method:"POST",
      data:{action:'latest_invoices'},
      success:function(data){
        $('#latest_invoices').html(data);
      }
    });

  });
</script>
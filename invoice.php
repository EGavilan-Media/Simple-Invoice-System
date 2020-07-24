<?php
  include('include/header.php');
  include('connection.php');
?>

<!-- Page Content -->
  <div class="container">

    <!-- Page Heading -->
    <h1 class="mt-4 mb-3">
      <small>Manage Invoices</small>
    </h1>

    <a href="create_invoice.php" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Add New Invoice</a>

    <!-- Invoices DataTable -->
    <div class="card mx-auto mb-4 border-info">
      <div class="card-header bg-info text-white">Invoice Table</div>
      <div class="card-body">
        <span id="sucess_message"></span>
        <div class="table-responsive">
          <table class="table table-bordered" id="itemTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Sub Total</th>
                <th>Tax Amount</th>
                <th>Grand Total</th>
                <th>Created Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!-- End Invoices DataTable -->

  </div>
  <!-- /.container -->

  <!-- Delete Note Modal -->
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h4 class="modal-title">Delete Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5><p class="text-center">Are you sure you want permanently delete this invoice?</p></h5>
        </div>
        <div class="modal-footer">
          <button type="button" name="ok_button" id="ok_button" class="btn btn-info">OK</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Delete Note Modal -->

  <!-- Update cration of the invoice modal -->
  <div class="modal fade" id="successMessageModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h4 class="modal-title">Success</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5 class="text-center"><span id="invoice_sucess_message"></span></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <span id="download_invoice_button"></span>
          <span id="print_invoice_button"></span>
        </div>
      </div>
    </div>
  </div>
  <!-- / Update creation of the invoice modal -->

  <!-- Footer -->
<?php
  include("include/footer.php");
?>

<script>
  $(document).ready(function(){

    order_id = "<?php 
    if(isset($_GET["order_id"])){
      echo $_GET['order_id'];
    } ?>";

    if (order_id) {
      $('#successMessageModal').modal('show');
      $('#invoice_sucess_message').show();
      $('#invoice_sucess_message').html('<div class="alert alert-success">Order ID '+order_id+' has been successfully updated.</div>');
      $('#download_invoice_button').html('<a href="print_invoice.php?order_id='+order_id+'&output" class="btn btn-info" role="button" aria-pressed="true"><i class="fas fa-download"></i> Download</a>');
      $('#print_invoice_button').html('<a href="print_invoice.php?order_id='+order_id+'" class="btn btn-info" role="button" aria-pressed="true" target="_blank"><i class="fas fa-print"></i> Print</a>');
    }
      
    var datatable = $('#itemTable').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
          url:'item_action.php',
          type: 'POST',
          data: {action:'item_fetch'}
      },
      'columns': [
          { data: 'order_id' },
          { data: 'order_receiver_name'},
          { data: 'order_total_before_tax'},
          { data: 'order_total_tax'},
          { data: 'order_total_after_tax'},
          { data: 'order_created_at'},
          { data: 'view',"orderable":false}
      ]
    });

    // Delete invoice
    $(document).on('click', '.delete_invoice', function(){
      order_id = $(this).attr('order_id');
      $('#deleteModal').modal('show');
    });

    $('#ok_button').click(function(){
      $.ajax({
        url:"item_action.php",
        method:"POST",
        data:{order_id:order_id, action:"delete_order"},
        dataType: "json",
        success:function(data){
          $('#sucess_message').show();
          $('#sucess_message').html('<div class="alert alert-success">'+data.message+'</div>');
          $('#deleteModal').modal('hide');
          datatable.ajax.reload();
          setTimeout(function () {
            $('#sucess_message').hide();
          }, 2000);
        }
      });
    });
  });
</script>
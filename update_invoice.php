<?php
  include('include/header.php');
  include('connection.php');
?>

  <div class="container">
    <!-- Page Heading -->
    <h1 class="mt-4 mb-3">
      <small>Update Invoice</small>
    </h1>
    <hr>
    <form id="invoice_form">
      <div id="alert_error_message" class="alert alert-danger collapse" role="alert"><i class="fas fa-exclamation-triangle"></i>
        Please check in on some of the fields below.
      </div>
      <div class="form-group">
        <label>Customer Name <i class="text-danger">*</i></label>
        <input type="text" id="customer_name" name="customer_name" class="form-control" maxlength="35" placeholder="Enter customer name" autocomplete="off">
        <div id="customer_name_error_message" class="text-danger"></div>
      </div>
      <div class="form-group">
        <label>Customer Address</i></label>
        <textarea id="customer_address" name="customer_address" class="form-control" maxlength="45" rows="1" placeholder="Enter customer address"></textarea>
      </div>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
              <tr>
                <th width="30%" class="text-center">Item Name</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="10%" class="text-center">Price</th>
                <th width="13%"class="text-center">Tax</th>
                <th width="13%"class="text-center">Subtotal</th>
                <th width="13%"class="text-center">Total</th>
                <th width="1%"class="text-center">Add</th>
              </tr>
            </thead>
            <tbody> 
              <tr>
                <td>
                  <input type="text" name="item_name" id="item_name" class="form-control" maxlength="50" autocomplete="off">
                  <div id="item_name_error_message" class="text-danger"></div>
                </td>
                <td>
                  <input type="number" name="qty" id="qty" class="form-control" min="1" max="100">
                  <div id="qty_error_message" class="text-danger"></div>
                </td>                
                <td>
                  <input type="number" name="price" id="price" class="form-control" step="0.00" min="0">
                  <div id="price_error_message" class="text-danger"></div>
                </td>
                <td>
                  <input type="number" name="tax" id="tax" class="form-control total" readonly>
                </td>
                <td>
                  <input type="number" name="subtotal" id="subtotal" class="form-control total" readonly>
                </td>
                <td>
                  <input type="number" name="total" id="total" class="form-control total" readonly>
                </td>
                <td>
                  <button type="button" class="btn btn-success" id="btnAddItem"><i class="fas fa-plus"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <div id="loadItemTableTemp"></div>
        </div>
      </div>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-sm-12">
          <div class="">
            <h5>Notes</h5>
            <textarea class="form-control" id="note" name="note" rows="3" maxlength="500" placeholder="Please enter a note."></textarea>
            <span><p id="character_left">You have reached the limit</p></span>
          </div>
        </div>
      </div>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-primary font-weight-bold" id="btnupdateInvoice"><i class="fas fa-save"></i> Update</button>
          <button type="button" class="btn btn-danger font-weight-bold float-right" id="btnCancel"><i class="fas fa-times"></i> Cancel</button>
        </div>
      </div>
    </form>
  </div>
  <!-- /.container -->

  <!-- Cancel cration of the invoice modal -->
  <div class="modal fade" id="cancelModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h4 class="modal-title">Delete Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5 class="text-center">Are you sure you want to cancel creation of the current invoice?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary">OK</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- / Cancel cration of the invoice modal -->

  <!-- Success cration of the invoice modal -->
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
  <!-- / Success creation of the invoice modal -->

  <div style="height: 130px;"></div>

  <!-- Footer -->
<?php
  include("include/footer.php");
?>

<script>

  $(document).ready(function(){

    order_id = "<?php echo $_GET['order_id']?>";

    $.ajax({
      type:"POST",
      data:{action:'single_fetch', order_id:order_id},
      url:"item_action.php",
      dataType:"json",
      success:function(data){
        $('#customer_name').val(data.order_receiver_name);
        $('#customer_address').val(data.order_receiver_address);
        $('#note').val(data.order_note);
      }
    });

    document.getElementById("customer_name").focus();

    $('#loadItemTableTemp').load("update_item_table_temp.php");

    $(document).keypress(function(e) {
      if(e.which == 13) {
        updateInvoice();
      }
    });

    $('#btnAddItem').click(function() {
      addItem();  
    });

    $('#btnupdateInvoice').click(function() {
      updateInvoice();
    });

    function clear_field()  {
      $('#invoice_form')[0].reset();

      $("#customer_name").val("");
      $("#customer_name").removeClass("is-invalid");
      $("#customer_name_error_message").hide();

      $("#customer_address").val("");

      $("#item_name").val("");
      $("#item_name").removeClass("is-invalid");
      $("#item_name_error_message").hide();

      $("#qty").val("");
      $("#qty").removeClass("is-invalid");
      $("#qty_error_message").hide();

      $("#price").val("");
      $("#price").removeClass("is-invalid");
      $("#price_error_message").hide();

      $("#note").val("");
      $("#note").removeClass("is-invalid");

      $("#subtotal").val("");
      $("#total").val("");
      $("#note").val("");

      $("#alert_error_message").hide();

    }

    var error_customer_name = false;
    var error_product_name = false;
    var error_qty = false;
    var error_price = false;

    $("#customer_name").focusout(function() {
      check_customer_name();
    });

    $("#item_name").focusout(function() {
      check_item_name();
    });

    $("#qty").focusout(function() {
      check_qty();
    });

    $("#price").focusout(function() {
      check_price();
    });

    $('#item_name').on('keyup change',function(){
      check_item_name();
    });

    $('#qty').on('keyup change',function(){
      calculateAmount();
      check_qty();
    });

    $('#price').on('keyup change',function(){
      calculateAmount();
      check_price();
    });

    function check_customer_name() {
      if( $.trim( $('#customer_name').val() ) == '' ){
        $("#customer_name_error_message").html("Customer name is a required field.");
        $("#customer_name_error_message").show();
        $("#customer_name").addClass("is-invalid");
        error_customer_name = true;
      } else {
        $("#customer_name_error_message").hide();
        $("#customer_name").removeClass("is-invalid");
      }
    }

    function check_item_name() {
      if( $.trim( $('#item_name').val() ) == '' ){
        $("#item_name_error_message").show();
        $("#item_name").addClass("is-invalid");
        error_item_name = true;
      } else {
        $("#item_name_error_message").hide();
        $("#item_name").removeClass("is-invalid");
      }
    }

    function check_qty() {

      var qty_value = parseInt($("#qty").val());

      if ($.trim($('#qty').val()) == '') {
        $("#qty_error_message").show();
        $("#qty").addClass("is-invalid");
        error_qty= true;
      } else if(qty_value == 0) {
        $("#qty_error_message").html("Enter a value higher than 0.");
        $("#qty_error_message").show();
        error_qty = true;
        $("#qty").addClass("is-invalid");
      } else if( qty_value > 100) {
        $("#qty_error_message").html("Qty must be less than or equal to 100.");
        $("#qty_error_message").show();
        error_qty = true;
      } else {
        $("#qty_error_message").hide();
        $("#qty").removeClass("is-invalid");
      }
    }

    function check_price() {

      var price_value = parseInt($("#price").val());

      if ($.trim($('#price').val()) == '') {
        $("#price_error_message").show();
        $("#price").addClass("is-invalid");
        error_price= true;
      } else if(price_value == 0) {
        $("#price_error_message").html("Enter a value higher than 0.");
        $("#price_error_message").show();
        error_price = true;
        $("#price").addClass("is-invalid");
      } else if( price_value > 100000) {
        $("#price_error_message").html("Price must be less than or equal to $100,000.");
        $("#price_error_message").show();
        error_price = true;
      } else {
        $("#price_error_message").hide();
        $("#price").removeClass("is-invalid");
      }
    }

    $('#character_left').text('500 characters left');
    $('#note').keyup(function () {
      var maximum_characters = 500;
      var note_length = $(this).val().length;
      if (note_length >= maximum_characters) {
        $('#character_left').text('You have reached the limit!');
        $('#character_left').addClass("text-danger");
        $("#note").addClass("is-invalid");
      } 
      else {
        var total_characters = maximum_characters - note_length;
        $('#character_left').text(total_characters + ' characters left');
        $('#character_left').removeClass('text-danger');
        $("#note").removeClass("is-invalid");
      }
    });

    function calculateAmount(){

      var qty, price, tax_subtotal, subtotal, total;
      var tax_percentage = 0.18;

      qty = parseFloat(document.getElementById("qty").value);
      if(isNaN(qty)) {
        qty = 0;
      }

      price = parseFloat(document.getElementById("price").value);
      if(isNaN(price)) {
        price = 0;
      }

      subtotal = qty * price;
      subtotal = (Math.round(subtotal * 100) / 100).toFixed(2);
      tax_subtotal = subtotal * tax_percentage;
      tax_subtotal = (Math.round(tax_subtotal * 100) / 100).toFixed(2);
      total = parseFloat(subtotal) + parseFloat(tax_subtotal);
      total = (Math.round(total * 100) / 100).toFixed(2);

      $('#tax').val(tax_subtotal);
      $('#subtotal').val(subtotal);
      $('#total').val(total);

    }

    function addItem(){
  
      error_customer_name = false;
      error_item_name = false;
      error_qty = false;
      error_price = false;

      check_customer_name();
      check_item_name();
      check_qty();
      check_price();

      if(error_customer_name == false && error_item_name == false && error_qty == false && error_price == false){

        $.ajax({
          type: "POST",
          data: $('#invoice_form').serialize()+'&action=update_item',
          url: "item_action.php",
          success: function(data) {
            $('#loadItemTableTemp').load("update_item_table_temp.php");
            beep();
            $("#item_name").val("");
            document.getElementById("item_name").focus();
            $("#qty").val("");
            $("#price").val("");
            $("#tax").val("");
            $("#subtotal").val("");
            $("#total").val("");
            $("#alert_error_message").hide();
          }
        });
      } else {
        $("#alert_error_message").show();
      }
    };

    function updateInvoice(){

      $.ajax({
        type:"POST",
        data: $('#invoice_form').serialize()+'&action=update_invoice',
        url:"item_action.php",
        dataType:"json",
        success:function(data){
          if(data.status=='success') {            
            window.location = "invoice.php?order_id="+data.order_id;        
          } else if (data.status=='empty') {
            check_customer_name();
            check_item_name();
            check_qty();
            check_price();
          }
        },
        error: function () {
          alert("Oops! Something went wrong.");
        }
      });
    }

    function beep() {
      var sound = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
      sound.play();
    }

    $('#btnCancel').click(function() {
      $('#cancelModal').modal('show');
    });

    $('#btn_cancel').click(function(){
      $.ajax({
        url: "item_action.php",
        method:"POST",
        data:{action:'cancel_update'},
        success: function(data) {
          window.location = "invoice.php";
        },
        error: function () {
          alert("Oops! Something went wrong.");
        }
      });
    });
  });

  function deleteItem(index) {
    $.ajax({
        type: "POST",
        data: {action:'delete_update_item', index:index},
        url:"item_action.php",
        success: function(data) {
          $('#loadItemTableTemp').load("update_item_table_temp.php");
        },
        error: function () {
          alert("Oops! Something went wrong.");
        }
    });
  }

</script>
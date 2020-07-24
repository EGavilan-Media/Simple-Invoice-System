<?php
  include('include/header.php');
?>

<!-- Page Content -->
  <div class="container">

    <!-- Page Heading -->
    <h1 class="mt-4 mb-3">
      <small>Manage Users</small>
    </h1>

    <button type="button" id="add_user" class="btn btn-info btn-sm mb-3">Add New User</button>

    <!-- Users DataTable -->
    <div class="card mx-auto mb-4 border-info">
      <div class="card-header bg-info text-white">Users Table</div>
      <div class="card-body">
        <div class="table-responsive">
        <span id="sucess_message"></span>
          <table class="table table-bordered table-striped" id="userTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th width="10%">Gender</th>
                <th width="10%">Role</th>
                <th width="10%">Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!-- End Users DataTable -->
  </div>
  <!-- /.container -->

  <!-- MODALS -->
  <!-- Add User Modal -->
  <div class="modal fade" id="formModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="modal_title"></h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="user_form">
            <div id="alert_error_message" class="alert alert-danger collapse" role="alert"><i class="fas fa-exclamation-triangle"></i>
              Please check in on some of the fields below.
            </div>
            <div class="form-group">
              <label>Full Name <i class="text-danger">*</i></label>
              <input type="text" id="full_name" name="full_name" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter full name">
              <div id="full_name_error_message" class="text-danger"></div>
            </div>
            <div class="form-group">
              <label>E-mail <i class="text-danger">*</i></label>
              <input type="text" id="email" name="email" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter E-mail">
              <div id="email_error_message" class="text-danger"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Gender <i class="text-danger"> *</i></label>
                <select name="gender" id="gender" class="custom-select">
                  <option value="" hidden>Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
                <div id="gender_error_message" class="text-danger"></div>
              </div>
              <div class="form-group col-md-4">
                <label>Role <i class="text-danger"> *</i></label>
                <select name="role" id="role" class="custom-select">
                  <option value="" hidden>Role</option>
                  <option>Admin</option>
                  <option>User</option>
                </select>
                <div id="role_error_message" class="text-danger"></div>
              </div>
              <div class="form-group col-md-4">
                <label>Status <i class="text-danger"> *</i></label>
                <select name="status" id="status" class="custom-select">
                  <option value="" hidden>Status</option>
                  <option>Active</option>
                  <option>Inactive</option>
                </select>
                <div id="status_error_message" class="text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password <i class="text-danger">*</i></label>
              <input type="password" class="form-control" id="password" name="password" maxlength="50" placeholder="Enter Password">
              <div id="password_error_message" class="text-danger"></div>
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm Password <i class="text-danger">*</i></label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="50" placeholder="Enter confirm password">
              <div id="confirm_password_error_message" class="text-danger"></div>
            </div>
            <br>
            <div class="modal-footer">
              <input type="hidden" name="user_id" id="user_id"/>
              <input type="hidden" name="action" id="action" value="add_user"/>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Save" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Add User Modal -->

  <!-- Update User Modal -->
  <div class="modal fade" id="updateUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Update User Information</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <br>
        <div class="container">
          <div class="card border-info">
            <h5 class="card-header bg-info text-white">Update User Profile</h5>
            <div class="modal-body">
              <form id="update_profile_form">
                <span id="update_profile_sucess_message"></span>
                <div id="update_profile_alert_error_message" class="alert alert-danger collapse" role="alert"><i class="fas fa-exclamation-triangle"></i>
                  Please check in on some of the fields below.
                </div>
                <div class="form-group">
                  <label>Full Name <i class="text-danger">*</i></label>
                  <input type="text" id="update_full_name" name="update_full_name" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter full name">
                  <div id="update_full_name_error_message" class="text-danger"></div>
                </div>
                <div class="form-group">
                  <label>E-mail <i class="text-danger">*</i></label>
                  <input type="text" id="update_email" name="update_email" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter E-mail">
                  <div id="update_email_error_message" class="text-danger"></div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Gender <i class="text-danger"> *</i></label>
                    <select name="update_gender" id="update_gender" class="custom-select">
                      <option value="" hidden>Gender</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                    <div id="update_gender_error_message" class="text-danger"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Role <i class="text-danger"> *</i></label>
                    <select name="update_role" id="update_role" class="custom-select">
                      <option value="" hidden>Role</option>
                      <option>Admin</option>
                      <option>User</option>
                    </select>
                    <div id="update_role_error_message" class="text-danger"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Status <i class="text-danger"> *</i></label>
                    <select name="update_status" id="update_status" class="custom-select">
                      <option value="" hidden>Status</option>
                      <option>Active</option>
                      <option>Inactive</option>
                    </select>
                    <div id="update_status_error_message" class="text-danger"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="update_profile_id" id="update_profile_id"/>
                  <input type="submit" name="button_update_profile" id="button_update_profile" class="btn btn-info" value="Update" />
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
        <div class="container">
          <div class="card border-info">
            <h5 class="card-header bg-info text-white">Update User Password</h5>
            <div class="modal-body">
              <form id="user_password_form">
                <span id="update_password_sucess_message"></span>
                <div id="update_password_alert_error_message" class="alert alert-danger collapse" role="alert"><i class="fas fa-exclamation-triangle"></i>
                  Please check in on some of the fields below.
                </div>
                <div class="form-group">
                  <label for="password">Password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="update_password" name="update_password" maxlength="50" placeholder="Enter new password">
                  <div id="update_password_error_message" class="text-danger"></div>
                </div>
                <div class="form-group">
                  <label for="confirm-password">Confirm Password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="update_confirm_password" name="update_confirm_password" maxlength="50" placeholder="Enter confirm password">
                  <div id="update_confirm_password_error_message" class="text-danger"></div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="update_password_id" id="update_password_id"/>
                  <input type="submit" name="button_action" id="update_button_action" class="btn btn-info" value="Update" />
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Update User Modal -->

  <!-- View User Modal-->
  <div class="modal fade" id="readModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">User Details</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-borderless">
            <tr>
              <th>ID</th>
              <td>
                <div id="view_id"></div>
              </td>
            </tr>
            <tr>
              <th>Full Name</th>
              <td>
                <div id="view_full_name"></div>
              </td>
            </tr>
            <tr>
              <th>E-Mail</th>
              <td>
                <div id="view_email"></div>
              </td>
            </tr>
            <tr>
              <th>Gender</th>
              <td>
                <div id="view_gender"></div>
              </td>
            </tr>
            <tr>
              <th>Role</th>
              <td>
                <div id="view_role"></div>
              </td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                <div id="view_status"></div>
              </td>
            </tr>
            <tr>
              <th>Created by</th>
              <td>
                <div id="view_created_by"></div>
              </td>
            </tr>            
            <tr>
              <th>Created</th>
              <td>
                <div id="view_created_at"></div>
              </td>
            </tr>
            <tr>
              <th>Last updated by</th>
              <td>
                <div id="view_last_update_by"></div>
              </td>
            </tr>
            <tr>
              <th>Last updated</th>
              <td>
                <div id="view_updated_at"></div>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End View Expense Modal -->

  <!-- Footer -->
<?php
  include("include/footer.php");
?>

<script>

  $(document).ready(function(){
    var datatable = $('#userTable').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
          url:'user_action.php',
          type: 'POST',
          data: {action:'user_fetch'}
      },
      'columns': [
          { data: 'user_id' },
          { data: 'user_full_name'},
          { data: 'user_email'},
          { data: 'user_gender'},
          { data: 'user_role'},
          { data: 'user_status'},
          { data: 'action',"orderable":false}
      ]
    });

    $('#add_user').click(function(){
      $('#modal_title').text('Add User');
      $('#button_action').val('Save');
      $('#action').val('add_user');
      $('#formModal').modal('show');
      clear_field();
    });

    function clear_field() {
      $('#user_form')[0].reset();      
      $("#full_name_error_message").hide();
      $("#full_name").removeClass("is-invalid");
      $("#email_error_message").hide();
      $("#email").removeClass("is-invalid");
      $("#gender_error_message").hide();
      $("#gender").removeClass("is-invalid");
      $("#role_error_message").hide();
      $("#role").removeClass("is-invalid");
      $("#status_error_message").hide();
      $("#status").removeClass("is-invalid");
      $("#password_error_message").hide();
      $("#password").removeClass("is-invalid");
      $("#confirm_password_error_message").hide();
      $("#confirm_password").removeClass("is-invalid");
      $("#alert_error_message").hide();
    }

    function clear_update_field() {
      $('#update_profile_form')[0].reset();
      $('#user_password_form')[0].reset();
      $("#update_full_name_error_message").hide();
      $("#update_full_name").removeClass("is-invalid");
      $("#update_email_error_message").hide();
      $("#update_email").removeClass("is-invalid");
      $("#update_password_error_message").hide();
      $("#update_password").removeClass("is-invalid");
      $("#update_confirm_password_error_message").hide();
      $("#update_confirm_password").removeClass("is-invalid");
      $("#update_profile_alert_error_message").hide();
      $("#update_password_alert_error_message").hide();
    }

    $('#user_form').on('submit', function(event){
      event.preventDefault();
      addUser();
    });

    $('#update_profile_form').on('submit', function(event){
      event.preventDefault();
      updateProfile();      
    });

    $('#user_password_form').on('submit', function(event){
      event.preventDefault();
      updatePassword();
    });

    var error_full_name = false;
    var error_email = false;
    var error_gender = false;
    var error_role = false;
    var error_status = false;
    var error_password = false;
    var error_confirm_password = false;
    var error_update_full_name = false;
    var error_update_email = false;
    var error_update_gender = false;
    var error_update_role = false;
    var error_update_status = false;
    var error_update_password = false;
    var error_update_confirm_password = false;

    $("#full_name").focusout(function() {
      check_full_name();
    });

    $("#email").focusout(function() {
      check_email();
    });

    $("#gender").focusout(function() {
      check_gender();
    });

    $("#role").focusout(function() {
      check_role();
    });

    $("#status").focusout(function() {
      check_status();
    });

    $("#password").focusout(function() {
      check_password();
    });

    $("#confirm_password").focusout(function() {
      check_confirm_password();
    });

    $("#update_full_name").focusout(function() {
      check_update_full_name();
    });

    $("#update_email").focusout(function() {
      check_update_email();
    });

    $("#update_password").focusout(function() {
      check_update_password();
    });

    $("#update_confirm_password").focusout(function() {
      check_update_confirm_password();
    });

    function check_full_name() {

      if( $.trim( $('#full_name').val() ) == '' ){
        $("#full_name_error_message").html("Full name is a required field.");
        $("#full_name_error_message").show();
        $("#full_name").addClass("is-invalid");
        error_full_name = true;
      }
      else{
        $("#full_name_error_message").hide();
        $("#full_name").removeClass("is-invalid");
      }

    }

    function check_update_full_name() {

      if( $.trim( $('#update_full_name').val() ) == '' ){
        $("#update_full_name_error_message").html("Full name is a required field.");
        $("#update_full_name_error_message").show();
        $("#update_full_name").addClass("is-invalid");
        error_update_full_name = true;
      }
      else{
        $("#update_full_name_error_message").hide();
        $("#update_full_name").removeClass("is-invalid");
      }

    }

    function check_email() {
      var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

      if ($.trim($('#email').val()) == '') {
        $("#email_error_message").html("Email is a required field.");
        $("#email_error_message").show();
        $("#email").addClass("is-invalid");
      } else if (!(pattern.test($("#email").val()))) {
        $("#email_error_message").html("Invalid email address");
        $("#email_error_message").show();
        error_email = true;
        $("#email").addClass("is-invalid");
      } else {
        $("#email_error_message").hide();
        $("#email").removeClass("is-invalid");
      }
    }

    function check_update_email() {
      var update_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

      if ($.trim($('#update_email').val()) == '') {
        $("#update_email_error_message").html("Email is a required field.");
        $("#update_email_error_message").show();
        $("#update_email").addClass("is-invalid");
      } else if (!(update_pattern.test($("#update_email").val()))) {
        $("#update_email_error_message").html("Invalid email address");
        $("#update_email_error_message").show();
        error_email = true;
        $("#update_email").addClass("is-invalid");
      } else {
        $("#update_email_error_message").hide();
        $("#update_email").removeClass("is-invalid");
      }
    }

    function check_status() {
      if( $.trim( $('#status').val() ) == '' ){
        $("#status_error_message").html("Status is a required field.");
        $("#status_error_message").show();
        $("#status").addClass("is-invalid");
        error_status = true;
      } else {
        $("#status_error_message").hide();
        $("#status").removeClass("is-invalid");
      }
    }

    function check_role() {
      if( $.trim( $('#role').val() ) == '' ){
        $("#role_error_message").html("Role is a required field.");
        $("#role_error_message").show();
        $("#role").addClass("is-invalid");
        error_role = true;
      } else {
        $("#role_error_message").hide();
        $("#role").removeClass("is-invalid");
      }
    }

    function check_gender() {
      if( $.trim( $('#gender').val() ) == '' ){
        $("#gender_error_message").html("Gender is a required field.");
        $("#gender_error_message").show();
        $("#gender").addClass("is-invalid");
        error_gender = true;
      } else {
        $("#gender_error_message").hide();
        $("#gender").removeClass("is-invalid");
      }
    }

    function check_password() {
      var password_length = $("#password").val().length;

      if ($.trim($('#password').val()) == '') {
        $("#password_error_message").html("Password is a required field.");
        $("#password_error_message").show();
        $("#password").addClass("is-invalid");
        error_password = true;
      } else if (password_length < 8) {
        $("#password_error_message").html("Please enter at least 8 characters!");
        $("#password_error_message").show();
        error_password = true;
        $("#password").addClass("is-invalid");
      } else {
        $("#password_error_message").hide();
        $("#password").removeClass("is-invalid");
      }
    }

    function check_confirm_password() {
      var password = $("#password").val();
      var confirm_password = $("#confirm_password").val();

      if ($.trim($('#confirm_password').val()) == '') {
        $("#confirm_password_error_message").html("Confirm password is a required field.");
        $("#confirm_password_error_message").show();
        $("#confirm_password").addClass("is-invalid");
        error_confirm_password = true;
      } else if (password != confirm_password) {
        $("#confirm_password_error_message").html("Passwords do not match!");
        $("#confirm_password_error_message").show();
        error_confirm_password = true;
        $("#confirm_password").addClass("is-invalid");
      } else {
        $("#confirm_password_error_message").hide();
        $("#confirm_password").removeClass("is-invalid");
      }
    }

    function check_update_password() {
      var update_password_length = $("#update_password").val().length;

      if ($.trim($('#update_password').val()) == '') {
        $("#update_password_error_message").html("Password is a required field.");
        $("#update_password_error_message").show();
        $("#update_password").addClass("is-invalid");
        error_update_password = true;
      } else if (update_password_length < 8) {
        $("#update_password_error_message").html("Please enter at least 8 characters!");
        $("#update_password_error_message").show();
        error_update_password = true;
        $("#update_password").addClass("is-invalid");
      } else {
        $("#update_password_error_message").hide();
        $("#update_password").removeClass("is-invalid");
      }
    }

    $("#update_confirm_password").focusout(function() {
      check_update_confirm_password();
    });

    function check_update_confirm_password() {
      var update_password = $("#update_password").val();
      var update_confirm_password = $("#update_confirm_password").val();

      if ($.trim($('#update_confirm_password').val()) == '') {
        $("#update_confirm_password_error_message").html("Confirm password is a required field.");
        $("#update_confirm_password_error_message").show();
        $("#update_confirm_password").addClass("is-invalid");
        error_update_confirm_password = true;
      } else if (update_password != update_confirm_password) {
        $("#update_confirm_password_error_message").html("Passwords do not match!");
        $("#update_confirm_password_error_message").show();
        error_update_confirm_password = true;
        $("#update_confirm_password").addClass("is-invalid");
      } else {
        $("#update_confirm_password_error_message").hide();
        $("#update_confirm_password").removeClass("is-invalid");
      }
    }

    function addUser(){

      error_full_name = false;
      error_email = false;
      error_gender = false;
      error_role = false;
      error_status = false;
      error_password = false;
      error_confirm_password = false;

      check_full_name();
      check_email();
      check_gender();
      check_role();
      check_status();
      check_password();
      check_confirm_password();

      if(error_full_name == false && error_email == false && error_gender == false && error_role == false && error_password == false && error_confirm_password == false) {

        data=$('#user_form').serialize();
        $.ajax({
          type:"POST",
          data: data,
          url:"user_action.php",
          dataType:"json",
          success:function(data){
            if (data.status == 'success') {
              $('#formModal').modal('hide');
              clear_field();
              datatable.ajax.reload();
              $('#sucess_message').show();
              $('#sucess_message').html('<div class="alert alert-success"><i class="fas fa-check"></i>'+data.message+'</div>');
              $("#alert_error_message").hide();
              setTimeout(function () {
                  $('#sucess_message').hide();
              }, 2000);
            } else if (data.status=='error') {
              $("#email_error_message").html("Email already exists");
              $("#email_error_message").show();
              $("#email").addClass("is-invalid");
            }
          },error:function(){
            alert("Oops! Something went wrong.");
          }
        });
      }else{
        $("#alert_error_message").show();
      }
    }

    $(document).on('click', '.update_user', function(){
      user_id = $(this).attr('id');
      clear_update_field();
      $('#updateUserModal').modal('show');      
      $.ajax({
        type:"POST",
        data: {action:'single_fetch', user_id:user_id},
        url:"user_action.php",
        dataType:"json",
        success:function(data){
          $('#update_profile_id').val(data.user_id);
          $('#update_password_id').val(data.user_id);
          $('#update_full_name').val(data.user_full_name);
          $('#update_email').val(data.user_email);
          $('#update_gender').val(data.user_gender);
          $('#update_role').val(data.user_role);
          $('#update_status').val(data.user_status);
        }
      });
    });

    function updateProfile(){

      error_update_full_name = false;
      error_update_email = false;

      check_update_full_name();
      check_update_email();

      if(error_update_full_name == false && error_update_email == false) {
        $.ajax({
          type:"POST",
          data: $('#update_profile_form').serialize()+'&action=update_user_profile',
          url:"user_action.php",
          dataType:"json",
          success:function(data){
            if (data.status == 'success') {
              datatable.ajax.reload();
              $('#update_profile_sucess_message').show();
              $('#update_profile_sucess_message').html('<div class="alert alert-success"><i class="fas fa-check"></i>'+data.message+'</div>');
              $("#update_profile_alert_error_message").hide();
              setTimeout(function () {
                  $('#update_profile_sucess_message').hide();
              }, 2000);
            } else if (data.status=='error') {
              $("#update_email_error_message").html("Email already exists.");
              $("#update_email_error_message").show();
              $("#update_email").addClass("is-invalid");
              $("#update_profile_alert_error_message").show();
            }
          },error:function(){
            alert("Oops! Something went wrong.");
          }
        });
      }else{
        $("#update_profile_alert_error_message").show();
      }
    }

    function updatePassword(){

      error_update_password = false;
      error_update_confirm_password = false;

      check_update_password();
      check_update_confirm_password();

      if(error_update_password == false && error_update_confirm_password == false) {
        $.ajax({
          type:"POST",
          data: $('#user_password_form').serialize()+'&action=update_user_password',
          url:"user_action.php",
          dataType:"json",
          success:function(data){
            if (data.status == 'success') {
              $('#user_password_form')[0].reset();
              $('#update_password_sucess_message').show();
              $('#update_password_sucess_message').html('<div class="alert alert-success"><i class="fas fa-check"></i>'+data.message+'</div>');
              $("#update_password_alert_error_message").hide();
              setTimeout(function () {
                  $('#update_password_sucess_message').hide();
              }, 2000);
            }
          },error:function(){
            alert("Oops! Something went wrong.");
          }
        });
      }else{
        $("#update_password_alert_error_message").show();
      }
    }

    var customer_id = '';
    $(document).on('click', '.view_user', function(){
      user_id = $(this).attr('id');
      $.ajax({
        type:"POST",
        data: {action:'single_fetch', user_id:user_id},
        url:"user_action.php",
        dataType:"json",
        success:function(data){
          $('#view_id').text(data['user_id']);
          $('#view_full_name').text(data['user_full_name']);
          $('#view_email').text(data['user_email']);
          $('#view_gender').text(data['user_gender']);
          $('#view_role').text(data['user_role']);          
          $('#view_status').text(data['user_status']);
          $('#view_created_by').text(data['user_created_by']);
          $('#view_last_update_by').text(data['user_last_update_by']);
          $('#view_created_at').text(data['user_created_at']);
          $('#view_updated_at').text(data['user_updated_at']);
        }
      });
    });
  });
</script>
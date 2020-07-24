<?php
  include('include/header.php');
?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading -->
    <h1 class="mt-4 mb-3">
      <small>Update Profile</small>
    </h1>

    <button type="button" id="update_profile" class="btn btn-info btn-sm mb-3">Update Profile</button>
    <button type="button" id="update_password" class="btn btn-info btn-sm mb-3">Update Password</button>

    <!-- Update User Password -->
    <div class="card mx-auto mb-4 border-info">
      <div class="card-header bg-info text-white">User Profile</div>
      <div class="card-body">
        <span id="sucess_message"></span>
        <table class="table table-borderless">
          <tr>
            <th>Full Name</th>
            <td>
              <div id="view_full_name"></div>
            </td>
          </tr>
          <tr>
            <th>E-mail</th>
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
            <th>Created</th>
            <td>
              <div id="view_created_date"></div>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <!-- MODALS -->
    <!-- Update User Profile Modal -->
    <div class="modal fade" id="update_profile_form">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="modal_title">Update Profile</h5>
            <button class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="profile_form">
              <div id="alert_error_message" class="alert alert-danger collapse" role="alert"><i class="fas fa-exclamation-triangle"></i>
                Please check in on some of the fields below.
              </div>
              <div class="form-group">
                <label>Full Name <i class="text-danger">*</i></label>
                <input type="text" id="full_name" name="full_name" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter full name">
                <div id="full_name_error_message" class="text-danger"></div>
              </div>
              <div class="form-group">
                <label>E-mail </label>
                <input type="text" id="email" name="email" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter email" readOnly>
                <div id="email_error_message" class="text-danger"></div>
              </div>
              <div class="form-group">
                <label>Gender <i class="text-danger">*</i></label>
                <select name="gender" id="gender" class="custom-select">
                  <option value="" hidden>Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
                <div id="gender_error_message" class="text-danger"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="button_action" id="button_action"> Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Update User Profile Modal -->

    <!-- User Modal -->
    <div class="modal fade" id="Password-Update-Modal-Form">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="modal_title">Update Password</h5>
            <button class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="update_password_form">
              <div id="password_update_alert_error_message" class="alert alert-danger collapse" role="alert"><i class="fas fa-exclamation-triangle"></i>
                  Please check in on some of the fields below.
              </div>
              <div class="mb-3">
                  <label for="password">Current Password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current Password">
                  <div id="current_password_error_message" class="text-danger"></div>
              </div>
              <div class="mb-3">
                  <label for="password">New password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="new_password" name="new_password" maxlength="50"
                      placeholder="Enter password">
                  <div id="new_password_error_message" class="text-danger"></div>
              </div>
              <div class="mb-3">
                  <label for="confirm-password">Confirm Password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                      maxlength="50" placeholder="Enter confirm password">
                  <div id="confirm_password_error_message" class="text-danger"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="update_password" id="update_password"> Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- End User Modal -->

  </div>
  <!-- /.container -->

  <div style="height: 500px;"></div>

<!-- Footer -->
<?php
  include("include/footer.php");
?>

<script>

  $(document).ready(function () {

    getProfile();

    var error_full_name = false;
    var error_current_password = false;
    var error_new_password = false;
    var error_confirm_password = false;

    $("#full_name").focusout(function() {
      check_full_name();
    });

    $("#current_password").focusout(function() {
      check_current_password();
    });

    $("#new_password").focusout(function() {
      check_new_password();
    });

    $("#confirm_password").focusout(function() {
      check_confirm_password();
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

    function check_current_password() {

      var current_password_length = $("#current_password").val().length;

      if( $.trim( $('#current_password').val() ) == '' ){
        $("#current_password_error_message").html("Current password is a required field.");
        $("#current_password_error_message").show();
        $("#current_password").addClass("is-invalid");
        error_current_password = true;
      }else if(current_password_length < 8) {
        $("#current_password_error_message").html("At least 8 characters.");
        $("#current_password_error_message").show();
        $("#current_password").addClass("is-invalid");
        error_current_password = true;
      } else {
        $("#current_password_error_message").hide();
        $("#current_password").removeClass("is-invalid");
      }
    }

    function check_new_password() {

      var current_password = $("#current_password").val();
      var new_password = $("#new_password").val();
      var new_password_length = $("#new_password").val().length;

      if( $.trim( $('#new_password').val() ) == '' ){
        $("#new_password_error_message").html("New password is a required field.");
        $("#new_password_error_message").show();
        $("#new_password").addClass("is-invalid");
        error_new_password = true;
      }else if(new_password_length < 8) {
        $("#new_password_error_message").html("At least 8 characters.");
        $("#new_password_error_message").show();
        $("#new_password").addClass("is-invalid");
        error_new_password = true;
      }else if(new_password == current_password) {
          $("#new_password_error_message").html("New password cannot be same as your current password.");
          $("#new_password_error_message").show();
          $("#new_password").addClass("is-invalid");
          error_confirm_password = true;
      }else{
        $("#new_password_error_message").hide();
        $("#new_password").removeClass("is-invalid");
      }
    }

    function check_confirm_password() {

      var new_password = $("#new_password").val();
      var confirm_password = $("#confirm_password").val();

        if( $.trim( $('#confirm_password').val() ) == '' ){
          $("#confirm_password_error_message").html("Confirm password is a required field.");
          $("#confirm_password_error_message").show();
          $("#confirm_password").addClass("is-invalid");
          error_confirm_password = true;
        }else if(new_password !=  confirm_password) {
          $("#confirm_password_error_message").html("Passwords do not match.");
          $("#confirm_password_error_message").show();
          $("#confirm_password").addClass("is-invalid");
          error_confirm_password = true;
        } else {
          $("#confirm_password_error_message").hide();
          $("#confirm_password").removeClass("is-invalid");
        }
    }

    function getProfile() {

      $.ajax({
          type: "POST",
          data: {action: 'profile_fetch'},
          url: "account_action.php",
          dataType: "json",
          success: function (data) {
              $('#view_full_name').text(data['user_full_name']);
              $('#view_email').text(data['user_email']);
              $('#view_gender').text(data['user_gender']);
              $('#view_status').text(data['user_status']);
              $('#view_created_date').text(data['user_created_at']);              
          }
      });
    }

    $('#update_profile').click(function(){

      $('#update_profile_form').modal('show');

      $.ajax({
        type: "POST",
        data: {action: 'profile_fetch'},
        url: "account_action.php",
        dataType: "json",
        success: function (data) {
          $('#full_name').val(data.user_full_name);
          $('#email').val(data.user_email);
          $('#gender').val(data.user_gender);
          $("#full_name_error_message").hide();
          $("#full_name").removeClass("is-invalid");
          $("#alert_error_message").hide();
        }
      });
    });

    $('#update_profile_form').on('submit', function (event) {
      event.preventDefault();
      error_full_name = false;

      check_full_name();

      if (error_full_name == false) {

        $.ajax({
          type: "POST",
          data: $('#profile_form').serialize()+'&action=update_profile',
          url: "account_action.php",
          dataType: "json",
          success: function (data) {
            if (data.status == 'success') {
              getProfile();
              $('#update_profile_form').modal('hide');
              $('#sucess_message').show();
              $('#sucess_message').html('<div class="alert alert-success"><i class="fas fa-check"></i>'+data.message+'</div>');
              $("#alert_error_message").hide();
              setTimeout(function () {
                  $('#sucess_message').hide();
              }, 2000);
            }
          },
          error: function () {
            alert("Oops! Something went wrong.");
          }
        });
      } else {
        $("#alert_error_message").show();
      }
    });

    $('#update_password').click(function(){

      $('#Password-Update-Modal-Form').modal('show');

      $("#password_update_alert_error_message").hide();
      $('#update_password_form')[0].reset();

      $("#current_password_error_message").hide();
      $("#current_password").removeClass("is-invalid");

      $("#new_password_error_message").hide();
      $("#new_password").removeClass("is-invalid");

      $("#confirm_password_error_message").hide();
      $("#confirm_password").removeClass("is-invalid");

    });

    $('#update_password_form').on('submit', function (event) {
      event.preventDefault();
      
      error_current_password = false;
      error_new_password = false;
      error_confirm_password = false;

      check_current_password();
      check_new_password();
      check_confirm_password();

      if(error_current_password == false && error_new_password == false && error_confirm_password == false) {

        $.ajax({
          type:"POST",
          data: $('#update_password_form').serialize()+'&action=update_password',
          url:"account_action.php",
          dataType:"json",
          success:function(data){
            if(data.status) {
              $('#Password-Update-Modal-Form').modal('hide');
              $('#sucess_message').show();
              $('#sucess_message').html('<div class="alert alert-success"><i class="fas fa-check"></i>'+data.message+'</div>');
              $("#alert_error_message").hide();
              setTimeout(function () {
                $('#sucess_message').hide();
              }, 2000);
            }else if(data.error) {
              $("#current_password_error_message").html("Your current password does not match with our records.");
              $("#current_password_error_message").show();
              $("#current_password").addClass("is-invalid");
            }
          },error:function(){
            alert("Oops! Something went wrong.");
          }
        });
      }else{
        $("#password_update_alert_error_message").show();
      }
    });

  });

</script>
<?php

	session_start();
	
	require_once "connection.php";

	$sql = "SELECT * FROM tbl_users WHERE user_email = '".$_POST["email"]."' AND user_password = '".sha1($_POST['password'])."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);

    if($row[6] == "Inactive"){
      $output = array(
        'status'        => 'inactive',
        'error'         => 'This user has been set as inactive. Please contact your administrator.'
      );
    } else {
		if(mysqli_num_rows($result) > 0){
			$_SESSION['user_id']                 = $row[0];
			$_SESSION['user_created_by']         = $row[1];
			$_SESSION['user_last_update_by']     = $row[2];
			$_SESSION['user_full_name']          = $row[3];
			$_SESSION['user_email']              = $row[4];
			$_SESSION['user_gender']             = $row[5];
			$_SESSION['user_status']             = $row[6];
			$_SESSION['user_role']               = $row[7];
			$_SESSION['user_created_at']         = $row[8];
			$_SESSION['user_updated_at']         = $row[9];

			$output = array(
			'status'        => 'success'
			);
		} else {
			$output = array(
				'status'        => 'error',
				'error'         => 'Incorrect email or password.'
			);
		}
	}
  
	echo json_encode($output);

?>
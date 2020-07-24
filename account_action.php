<?php
    // Current user logged in action.
    require_once "connection.php";

    session_start();

    $output = '';

    if(isset($_POST["action"])){

        // Get current logged in user profile information.
        if($_POST["action"] == "profile_fetch"){

            $sql = "SELECT user_id,
                            user_full_name,
                            user_email,
                            user_gender,
                            user_status,
                            user_role,
                            user_created_at
                            FROM tbl_users 
                            WHERE user_id = '".$_SESSION["user_id"]."'";

            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_row($result);

            $output = array(
                'user_id'             =>    $row[0],
                'user_full_name'      =>    $row[1],
                'user_email'          =>    $row[2],
                'user_gender'         =>    $row[3],
                'user_status'         =>    $row[4],
                'user_role'           =>    $row[5],
                'user_created_at'     =>    $row[6],
            );

            echo json_encode($output);
        }

        // Update current logged in user profile information.
        if($_POST["action"] == "update_profile"){
        
            $sql = "UPDATE tbl_users SET user_full_name = '".$_POST["full_name"]."',
                                    user_gender = '".$_POST["gender"]."'
                                    WHERE user_id = '".$_SESSION["user_id"]."'";

            if(mysqli_query($conn, $sql)){
        
                $_SESSION['user_full_name'] = $_POST["full_name"];

                $output = array(
                    'status'        => 'success',
                    'message'       => ' Your profile has been updated successfully.',
                );
        
            }

            echo json_encode($output);

        }

        // Update current logged in user password
        if($_POST["action"] == "update_password"){

            $sql = "SELECT * FROM tbl_users WHERE user_password = '".sha1($_POST['current_password'])."' AND user_id = '".$_SESSION["user_id"]."'";
            $result = mysqli_query($conn, $sql);
            $checkrows = mysqli_num_rows($result);

            if($checkrows > 0) {

                $sql = "UPDATE tbl_users SET user_password = '".sha1($_POST['new_password'])."' WHERE user_id = '".$_SESSION["user_id"]."'";
                $result = mysqli_query($conn, $sql);

                if($result > 0)	{

                    $output = array(
                        'status'        => 'success',
                        'message'       => ' Password updated successfully.'
                    );

                    echo json_encode($output);
                }

            } else {

                $output = array(
                    'error'          =>	'true'
                );

                echo json_encode($output);

            }

        }

    }

?>

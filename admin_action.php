<?php
include "connection.php";
$output = '';
if(isset($_POST["action"])){

  if($_POST["action"] == "add_info"){

    $sql_order = "SELECT count(order_id) FROM tbl_orders";
    $sql_user = "SELECT count(user_id) FROM tbl_users";
    $sql_admin_user = "SELECT count(user_id) FROM tbl_users WHERE user_role = 'Admin'";
    $sql_income = "SELECT SUM(order_total_after_tax) AS total_income FROM tbl_orders";

    $order_result = mysqli_query($conn, $sql_order);
    $user_result = mysqli_query($conn, $sql_user);
    $user_role_result = mysqli_query($conn, $sql_admin_user);
    $income_result = mysqli_query($conn, $sql_income);

    $row_1 = mysqli_fetch_row($order_result);
    $row_2 = mysqli_fetch_row($user_result);
    $row_3 = mysqli_fetch_row($user_role_result);
    $row_4 = mysqli_fetch_row($income_result);

    $output=array(
      'total_orders'     => $row_1[0],
      'total_users'      => $row_2[0],
      'total_admin'      => $row_3[0],
      'total_income'     => $row_4[0]
    );

    echo json_encode($output);

  }

  if($_POST["action"] == "latest_invoices"){

    $sql_invoices="SELECT order_id,
                          order_receiver_name,
                          order_total_before_tax,
                          order_total_tax,
                          order_total_after_tax,
                          order_created_at
                          FROM tbl_orders ORDER BY order_id DESC LIMIT 5";

    $result = mysqli_query($conn, $sql_invoices);

    $output = '
    <div>
      <table class="table table-hover table-condensed table-bordered" id="dataTable">
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
        <tbody>';
        while ($row=mysqli_fetch_row($result)) {
          $output .= '
          <tr>
            <td style="text-align: left;">'.$row[0].'</td>
            <td style="text-align: left;">'.$row[1].'</td>
            <td style="text-align: left;">'.$row[2].'</td>
            <td style="text-align: left;">'.$row[3].'</td>
            <td style="text-align: left;">'.$row[4].'</td>
            <td style="text-align: left;">'.$row[5].'</td>
            <td style="text-align: left;">
              <a href="print_invoice.php?order_id='.$row[0].'&output" class="btn btn-info btn-sm"><i class="fas fa-download"></i></a>
              <a href="print_invoice.php?order_id='.$row[0].'" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i></a>
              <a href="update_invoice.php?order_id='.$row[0].'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          ';
        }
        $output .= '
        </tbody>
      </table>   
    </div>';

    echo $output;
  }
}
?>
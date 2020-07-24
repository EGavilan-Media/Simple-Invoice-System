<?php
	session_start();
?>

	<table class="table table-bordered table-hover">
			<thead>
				<tr class="font-weight-bold">
					<td>No.</td>
					<td>Item</td>
					<td>Qty</td>
					<td>Price</td>
					<td>Tax</td>
					<td>Subtotal</td>
					<td>Total</td>
					<td>Delete</td>
				</tr>
			</thead>
		<?php
		$total = 0.00;
		$tax_amount = 0.00;
		$sub_total = 0.00;
		$i = 0;

		if(isset($_SESSION['update_item_table_temp'])):foreach (@$_SESSION['update_item_table_temp'] as $key) {

			$row=explode("||", @$key);

		?>

			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $row[0] ?></td>
				<td><?php echo $row[1] ?></td>
				<td><?php echo $row[2] ?></td>
				<td><?php echo $row[3] ?></td>
				<td><?php echo $row[4] ?></td>
				<td><?php echo $row[5] ?></td>
				<td width="5%">
					<span class="btn btn-danger btn-xs" onclick="deleteItem('<?php echo $i; ?>');">
						<i class="fas fa-times"></i>
					</span>
				</td>
			</tr>

			<?php
			$sub_total = $sub_total + $row[4];
			$tax_amount = $tax_amount + $row[3];
			$total = $total + $row[5];
			$i++;

			$_SESSION['update_sub_total']=$sub_total;
			$_SESSION['update_tax_amount']=$tax_amount;
			$_SESSION['update_total']=$total;

		}
		endif;
		
		if ($i == 0){
			$_SESSION['update_sub_total'] = 0.00;
			$_SESSION['update_tax_amount'] = 0.00;
			$_SESSION['update_total'] = 0.00;
		}
		?>
	</table>

	<hr class="colorgraph">
	<div class="row">
		<div class="col-sm-12 col-lg-7">
		</div>
		<div class="col-sm-12 col-lg-5">
			<div class="card text-muted bg-light">
				<div class="card-body">
					<table class="table table-bordered table-hover">
						<tbody>
							<tr>
								<th class="text-right">Sub Total
								</th>
								<td class="text-center">
									<?php echo $sub_total; ?>
								</td>
							</tr>
							<tr>
								<th class="text-right">Tax Total
								</th>
								<td class="text-center">
									<?php echo $tax_amount; ?>
								</td>
							</tr>
							<tr>
								<th class="text-right">Grand Total
								</th>
								<td class="text-center">
									<?php echo $total; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
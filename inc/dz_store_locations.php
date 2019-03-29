<div class="wrap">
	<h1><?= get_admin_page_title() ?></h1>
	<?php 
		$data = json_decode(dz_get_store());

		if(isset($_GET['delete']) && isset($_GET['id'])){ /******DELETE*******/
			$id = $_GET['id'];
			dz_delete_store($id) ? $status = 1 : $status = 0;
			wp_redirect(admin_url('admin.php?page=dz_store_locations&status='.$status));
		}

		if(isset($_GET['status']) && $_GET['status'] == 1){ ?>
			<div style="padding: 10px;" class="notice notice-success is-dismissible">Data Successfully Delete!</div><?php
		} else if(isset($_GET['status']) && $_GET['status'] == 0){ ?>
			<div style="padding: 10px;" class="notice notice-error is-dismissible">Error Deleting your data!</div><?php
		}
	?>

	<table id="locations_table">
		<thead>
			<tr>
				<th>Dealer</th>
				<th>Dealer Name</th>
				<th>Address</th>
				<th>City</th>
				<th>State</th>
				<th>PIN</th>
				<th>Mobile</th>
				<th>E-Mail</th>
				<th>Registration number</th>
				<th>action</th>
			</tr>
		</thead>

		<tbody>
			<?php 
				foreach ($data as $value) { ?>

					<tr>
						<td><?= $value->dz_dealer ?></td>
						<td><?= $value->dz_dealer_name ?></td>
						<td><?= $value->dz_address ?></td>
						<td><?= $value->dz_city ?></td>
						<td><?= $value->dz_state ?></td>
						<td><?= $value->dz_pin ?></td>
						<td><?= $value->dz_mobile ?></td>
						<td><?= $value->dz_email ?></td>
						<td><?= $value->dz_reg_no ?></td>
						<td>
							<a href="<?= admin_url('admin.php?page=dz_add_store_locations&edit=true&id='.$value->id) ?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?= admin_url('admin.php?page=dz_store_locations&delete=true&id='.$value->id) ?>" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr> <?php
					
				}
			?>
		</tbody>

		<tfoot>
			<tr>
				<th>Dealer</th>
				<th>Dealer Name</th>
				<th>Address</th>
				<th>City</th>
				<th>State</th>
				<th>PIN</th>
				<th>Mobile</th>
				<th>E-Mail</th>
				<th>Registration number</th>
				<th>action</th>
			</tr>
		</tfoot>
	</table>	
</div>

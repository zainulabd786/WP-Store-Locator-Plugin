<div class="wrap">
	<h1><?= get_admin_page_title() ?></h1><?php
	if(isset($_GET['status']) && $_GET['status'] == 1){ ?>
		<div style="padding: 10px;" class="notice notice-success is-dismissible">Data Successfully Saved!</div><?php
	} else if(isset($_GET['status']) && $_GET['status'] == 0){ ?>
		<div style="padding: 10px;" class="notice notice-error is-dismissible">Error Saving your data!</div><?php
	}

	if(isset($_GET['edit']) && isset($_GET['id'])){ /******EDIT*******/
		$id = $_GET['id'];
		$data = json_decode(dz_get_store(array('id'=>$id)))[0];
	} ?>
	<form action="admin-post.php" method="post">
		<input type="hidden" name="action" value="<?= isset($_GET['edit']) ? 'dz_store_location_edit_form' : 'dz_store_location_form' ?>">
		<?php wp_nonce_field("dz_store_location_form_verify"); ?>
		<?php 
			if(isset($_GET['edit']) && isset($_GET['id'])){ ?>
				<input type="hidden" name="id" value="<?= (!empty($data->id)) ? $data->id : '' ?>"><?php
			}
		?>
		<div class="form-group">
			<label for="dz_dealer">Dealer</label>
			<input type="text" class="form-control" name="dz_dealer" id="dz_dealer" value="<?= (!empty($data->dz_dealer)) ? $data->dz_dealer : '' ?>">
		</div>

		<div class="form-group">
			<label for="dz_dealer_name">Dealer Name</label>
			<input type="text" class="form-control" name="dz_dealer_name" id="dz_dealer_name" value="<?= (!empty($data->dz_dealer_name)) ? $data->dz_dealer_name : '' ?>">
		</div>

		<div class="form-group">
			<label for="dz_address">Address</label>
			<textarea class="form-control" name="dz_address" id="dz_address"><?= (!empty($data->dz_address)) ? $data->dz_address : '' ?></textarea>
		</div>

		<div class="form-group">
			<label for="dz_city">City</label>
			<input type="text" class="form-control suggest" name="dz_city" id="dz_city" list="dz_city_datalist" value="<?= (!empty($data->dz_city)) ? $data->dz_city : '' ?>">
			<datalist id="dz_city_datalist">
				
			</datalist>
		</div>

		<div class="form-group">
			<label for="dz_state">State</label>
			<input type="text" class="form-control suggest" name="dz_state" id="dz_state" list="dz_state_datalist" value="<?= (!empty($data->dz_state)) ? $data->dz_state : '' ?>">
			<datalist id="dz_state_datalist">
				
			</datalist>
		</div>

		<div class="form-group">
			<label for="dz_pin">PIN</label>
			<input type="text" class="form-control" name="dz_pin" id="dz_pin" value="<?= (!empty($data->dz_pin)) ? $data->dz_pin : '' ?>">
		</div>

		<div class="form-group">
			<label for="dz_mobile">Mobile</label>
			<input type="text" class="form-control" name="dz_mobile" id="dz_mobile" value="<?= (!empty($data->dz_mobile)) ? $data->dz_mobile : '' ?>">
		</div>

		<div class="form-group">
			<label for="dz_email">E-mail</label>
			<input type="text" class="form-control" name="dz_email" id="dz_email" value="<?= (!empty($data->dz_email)) ? $data->dz_email : '' ?>">
		</div>

		<div class="form-group">
			<label for="dz_reg_no">Registration Number</label>
			<input type="text" class="form-control" name="dz_reg_no" id="dz_reg_no" value="<?= (!empty($data->dz_reg_no)) ? $data->dz_reg_no : '' ?>">
		</div>

		<input type="submit" name="dz_submit" class="btn-primary btn">

	</form>
</div>
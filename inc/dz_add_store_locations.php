<div class="wrap">
	<h1><?= get_admin_page_title() ?></h1><?php
	if(isset($_GET['status']) && $_GET['status'] == 1){ ?>
		<div style="padding: 10px;" class="notice notice-success is-dismissible">Data Successfully Saved!</div><?php
	} else{ ?>
		<div style="padding: 10px;" class="notice notice-error is-dismissible">Error Saving your data!</div><?php
	} ?>
	<form action="admin-post.php" method="post">
		<input type="hidden" name="action" value="dz_store_location_form">
		<?php wp_nonce_field("dz_store_location_form_verify"); ?>
		<div class="form-group">
			<label for="dz_dealer">Dealer</label>
			<input type="text" class="form-control" name="dz_dealer" id="dz_dealer">
		</div>

		<div class="form-group">
			<label for="dz_dealer_name">Dealer Name</label>
			<input type="text" class="form-control" name="dz_dealer_name" id="dz_dealer_name">
		</div>

		<div class="form-group">
			<label for="dz_address">Address</label>
			<textarea class="form-control" name="dz_address" id="dz_address"></textarea>
		</div>

		<div class="form-group">
			<label for="dz_city">City</label>
			<input type="text" class="form-control" name="dz_city" id="dz_city">
		</div>

		<div class="form-group">
			<label for="dz_state">State</label>
			<input type="text" class="form-control" name="dz_state" id="dz_state">
		</div>

		<div class="form-group">
			<label for="dz_pin">PIN</label>
			<input type="text" class="form-control" name="dz_pin" id="dz_pin">
		</div>

		<div class="form-group">
			<label for="dz_mobile">Mobile</label>
			<input type="text" class="form-control" name="dz_mobile" id="dz_mobile">
		</div>

		<div class="form-group">
			<label for="dz_email">E-mail</label>
			<input type="text" class="form-control" name="dz_email" id="dz_email">
		</div>

		<div class="form-group">
			<label for="dz_reg_no">Registration Number</label>
			<input type="text" class="form-control" name="dz_reg_no" id="dz_reg_no">
		</div>

		<input type="submit" name="dz_submit" class="btn-primary btn">

	</form>
</div>
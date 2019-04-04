jQuery(document).ready(function($){
	script_data.is_admin && $("#locations_table").DataTable();

	if(script_data.is_admin){
		$(".suggest").keyup(function(){
			let listName = $(this).attr('list');
			let name = $(this).attr('name');
			let markup = "";
			let data = {
				action: "dz_get_suggestions_data",
				name: name,
				val: $(this).val()
			}
			$.get(script_data.ajax_url, {
				action: "dz_get_suggestions_data",
				name: $(this).attr('name'),
				val: $(this).val()
			}, resp => {
				resp = JSON.parse(resp);
				resp.forEach( resp => {
					markup += `<option value="${resp[name]}">`
				})
				$(`#${listName}`).html(markup);
			})
		})
	}

	$("#wp_dz_state").change(function(){
		$("#wp_dz_city").html("<option>Select your City</option>");
		$.get(script_data.ajax_url, {action: 'dz_get_cities', state: $(this).val()}, resp => {
			resp = JSON.parse(resp);
			resp.forEach(i => $("#wp_dz_city").append(`<option value="${i.dz_city}">${i.dz_city}</option>`))
		})
	})

	$("#wp_dz_city").change(function(){
		$("#searching-gif").removeClass("d-none").addClass("d-flex");
		let data = {"dz_state": $("#wp_dz_state").val(), "dz_city" : $("#wp_dz_city").val()}
		$.get(script_data.ajax_url, {action: "get_store_data", params: data}, resp => {
			resp = JSON.parse(resp);
			let markup = "";

			resp.forEach(resp => {
				markup += `
					<div class="jumbotron">
					  <h1 class="display-4">${resp.dz_dealer}</h1>
					  <p class="lead">${resp.dz_address}, ${resp.dz_city}, ${resp.dz_state}, ${resp.dz_pin}</p>
					  <hr class="my-4">
					  <p>
					  	<strong>Email:</strong> ${resp.dz_email}<br/>
					  	<strong>Mobile:</strong> ${resp.dz_mobile}<br/>
					  	<strong>GST:</strong> ${resp.dz_reg_no}<br/>
					  </p>
					  
					</div>
				`;
			})
			setTimeout(()=>{
				$("#searching-gif").removeClass("d-flex").addClass("d-none");
				$("#wp_dz_display_store").html(markup);
			}, 2000);
			
		} );
	})


})
jQuery(document).ready(function($){
	script_data.is_admin && $("#locations_table").DataTable();

	$("#wp_dz_state").change(function(){
		$("#wp_dz_city").html("<option>Select your City</option>");
		$.get(script_data.ajax_url, {action: 'dz_get_cities', state: $(this).val()}, resp => {
			resp = JSON.parse(resp);
			resp.forEach(i => $("#wp_dz_city").append(`<option value="${i.dz_city}">${i.dz_city}</option>`))
		})
	})

	$("#wp_dz_city").change(function(){
		let data = {"dz_state": $("#wp_dz_state").val(), "dz_city" : $("#wp_dz_city").val()}
		$.get(script_data.ajax_url, {action: "get_store_data", params: data}, resp => {
			resp = JSON.parse(resp);
			console.log(resp);
		} );
		$("#wp_dz_display_store").html();
	})
})
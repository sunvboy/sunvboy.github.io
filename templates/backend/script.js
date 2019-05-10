$(document).ready(function(){

	/*  XĂ³a nhiá»u */
	$('.gcheckActionTrash').click(function(){
		var modules = $(this).attr('data-module');
		var id_checked = []; // Láº¥y id báº£n ghi
		$('.checkbox-item:checked').each(function() {
			id_checked.push($(this).val());
		});
		var formURL = modules + '/ajax/'+modules+'/deletetrash';
		$.post(formURL, {
				post: id_checked,module:modules},
			function(data){
				$('#alertModal').modal('toggle');
				var json = JSON.parse(data);
				if(json.error == false){
					$('.message-alert').html(json.message);

				}else{
					$('.message-alert').html(json.message);
				}
				window.setTimeout('location.reload()', 2000); //Reloads after three seconds
			});
		return false;
	});




	/*  XĂ³a nhiá»u */
	$('.gcheckAction').click(function(){
		var modules = $(this).attr('data-module');
		var id_checked = []; // Láº¥y id báº£n ghi
		$('.checkbox-item:checked').each(function() {
			id_checked.push($(this).val());
		});
		var formURL = modules + '/ajax/'+modules+'/delete';
		$.post(formURL, {
				post: id_checked,module:modules},
			function(data){
				$('#alertModal').modal('toggle');
				var json = JSON.parse(data);
				if(json.error == false){
					$('.message-alert').html(json.message);

				}else{
					$('.message-alert').html(json.message);
				}
				window.setTimeout('location.reload()', 2000); //Reloads after three seconds
			});
		return false;
	});


	$(document).ready(function() {
		$('input.filter').click(function() {
			var id = $(this).prop('id');
			var name = $(this).prop('name');
			$('input[name="'+name+'"]:not(#'+id+')').prop('checked',false);

		})
	});
	function changeBackground() {
		$('.checkbox-item').each(function() {
			if($(this).is(':checked')) {
				$(this).parents('tr').addClass('bg-active');
			}else {
				$(this).parents('tr').removeClass('bg-active');
			}
		});
	}
	function showActionButton() {

		if($('.checkbox-item:checked').length) {
			$('.gcheckAction').show();
		}else {
			$('.gcheckAction').hide();
		}
	}

	function showActionButtonTrash() {
		if($('.checkbox-item:checked').length) {
			$('.gcheckActionTrash').show();
		}else {
			$('.gcheckActionTrash').hide();
		}
	}

	function changeChecked() {
		$('.checkbox-item').each(function() {
			if($(this).is(':checked')) {
				$(this).parent().find('.label-checkboxitem').addClass('checked');
			}else {
				$(this).parent().find('.label-checkboxitem').removeClass('checked');
			}
		});
	}
	function userGroupChecked() {
		$('.tpInputCheckbox').each(function() {
			if($(this).is(':checked')) {
				$(this).parent().addClass('checked');
			}else {
				$(this).parent().removeClass('checked');
			}
		});
	}
	userGroupChecked();

	if($('#checkbox-all').length){
		$('#checkbox-all').click(function(){
			if($(this).prop('checked')){
				$('.checkbox-item').prop('checked', true);
			}
			else{
				$('.checkbox-item').prop('checked', false);
			}
		});
	}
	if($('.checkbox-item').length) {
		$('.checkbox-item').click(function(){
			if($('.checkbox-item:checked').length == $('.checkbox-item').length) {
				$('#checkbox-all').prop('checked', true);
			}
			else{
				$('#checkbox-all').prop('checked', false);
			}
		});
	}
	$( ".gcheck .check" ).click(function(e) {
		e.stopImmediatePropagation();
		$('.gcheckDropdown').hide();
	});
	$(".gcheck").click(function (e) {
		e.stopPropagation();
		$('.gcheckDropdown').show();
	});
	$(document).click(function(e) {
		$('.gcheckDropdown').hide();
	});
	$('.gcheck-item').click(function() {
		var dataCheck = $(this).attr('data-check');
		if(dataCheck === 'checkall') {
			$('.checkbox-item').prop('checked', true);
			$('#checkbox-all').prop('checked', true)
		}else if(dataCheck === 'uncheckall'){
			$('.checkbox-item').prop('checked', false);
			$('#checkbox-all').prop('checked', false);
		}
		changeBackground();
		showActionButton();
		showActionButtonTrash();
		changeChecked();
	});
	$('.label-checkboxitem').click(function() {
		$(this).parent().find('.checkbox-item').trigger('click');
	});

	$('.tpInputLabel').on('click', function() {
		if($(this).find('.tpInputCheckbox').is(':checked')) {
			$(this).addClass('checked');
		}else {
			$(this).removeClass('checked');
		}
	});

	$('form').change(function() {
		changeBackground();
		showActionButton();
		showActionButtonTrash();
		changeChecked();
	});

	//$('.location').on('change',function(){
	//	var id = $(this).val();
	//	var returnSection = $(this).attr('data-return');
	//	var flag = $(this).attr('data-flag');
	//	var formURL = 'projects/ajax/projects/ajax_change_location';
	//	var _this = $(this);
	//	if(returnSection == 'district'){
	//		$('#ward').html('');
	//		$('#district').html('');
	//	}else if(returnSection == 'ward'){
	//		$('#ward').html('');
	//	}
    //
	//	$.post(formURL, {id: id},
	//		function(data){
	//			var json = JSON.parse(data);
	//			if(flag == 0){
	//				if(returnSection == 'district'){
	//					$('#'+returnSection).html(json.html).val(districtid).trigger('change');
	//				}else if(returnSection == 'ward'){
	//					$('#'+returnSection).html(json.html).val(wardid).trigger('change');
	//				}
	//				_this.attr('data-flag',1);
	//			}else{
	//				$('#'+returnSection).html(json.html);
	//			}
	//		});
    //
	//	var city_id = $('#cityid option:selected').val();
	//	var district_id = $('#district option:selected').val();
	//	var ward_id = $('#ward option:selected').val();
    //
    //
	//	var city_text = $('#cityid option:selected').text();
	//	var district_text = $('#district option:selected').text();
	//	var ward_text = $('#ward option:selected').text();
	//	/* Ghi nhanh Ä‘á»‹a chá»‰ */
	//	var address = '';
	//	address = ((ward_text != '') ? '' + ward_text : '') + ((district_text != '') ? ' - ' + district_text : '') + ((city_text != '') ? ' - ' + city_text : '');
	//	$('#address').val('').val(address);
	//	/* ---------------- */
	//	if(typeof(district_id) == 'undefined'){
	//		district_id = 0;
	//	}
	//	if(typeof(ward_id) == 'undefined'){
	//		ward_id = 0;
	//	}
	//	if(typeof(projectid) == 'undefined'){
	//		projectid = 0;
	//	}
	//	if(typeof(streetid) == 'undefined'){
	//		streetid = 0;
	//	}
	//	listProject(city_id, district_id, ward_id, projectid);
	//	//listStreet(city_id, district_id, ward_id, streetid);
	//});
	//if(cityid > 0){
	//	$('#cityid').val(cityid).trigger('change');
	//}
});

/* Láº¥y dá»± Ă¡n theo thĂ nh phá»‘, quáº­n, huyá»‡n */
//function listProject (cityid, districtid, wardid, projectid){
//	var formURL = 'projects/ajax/projects/ajax_get_project_list'
//	$.post(formURL, {cityid: cityid, districtid:districtid, wardid:wardid},
//		function(data){
//			var json = JSON.parse(data);
//			$('#project').html('').html(json.html).val(projectid);
//		});
//}
//function listStreet(cityid, districtid, wardid, streetid) {
//	var formURL = 'projects/ajax/projects/ajax_get_street_list'
//	$.post(formURL, {cityid: cityid, districtid: districtid, wardid: wardid},
//		function (data) {
//			var json = JSON.parse(data);
//			$('#street').html('').html(json.html).val(streetid);
//
//		});
//}
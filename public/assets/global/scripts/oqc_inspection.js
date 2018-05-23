var dataColumn = [
        { data: function(data) {
            return '<input type="checkbox" class="checkboxes" value="'+data.id+'">';
        }, name: 'id', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
        { data: 'fyww', name: 'fyww', orderable: false, searchable: false },
		{ data: 'date_inspected', name: 'date_inspected' },
		{ data: 'device_name', name: 'device_name' },
		{ data: 'time_ins_from', name: 'time_ins_from' },
		{ data: 'time_ins_to', name: 'time_ins_to' },
		{ data: 'submission', name: 'submission' },
		{ data: 'lot_qty', name: 'lot_qty' },
		{ data: 'sample_size', name: 'sample_size' },
		{ data: 'num_of_defects', name: 'num_of_defects' },
		{ data: 'lot_no', name: 'lot_no' },
		{ data: 'mod', name: 'mod', orderable: false, searchable: false },
		{ data: 'po_qty', name: 'po_qty' },
		{ data: 'judgement', name: 'judgement' },
		{ data: 'inspector', name: 'inspector' },
		{ data: 'remarks', name: 'remarks' },
		{ data: 'type', name: 'type' }
    ];
var modColumn = [
        { data: function(data) {
            return '<input type="checkbox" class="checkboxes-mod" value="'+data.id+'">';
        }, name: 'id', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
		{ data: 'mod1', name: 'mod1' },
		{ data: 'qty', name: 'qty' },
    ];
$( function() {
	initialize();
	$(".date-picker").datepicker().datepicker("setDate", new Date());
	checkAllCheckboxesInTable('.group-checkable','.checkboxes');
	checkAllCheckboxesInTable('.group-checkable-mod','.checkboxes-mod');

	getDatatable('tbl_oqc',oqcDataTableURL,dataColumn,[],0);

	$('#frm_inspection').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			dataType: 'JSON',
			data: $(this).serialize(),
		}).done(function(data, textStatus, xhr) {
			msg(data.msg,data.status);
			getDatatable('tbl_oqc',oqcDataTableURL,dataColumn,[],0);
		}).fail(function(data, textStatus, xhr) {
			var errors = data.responseJSON;
			InspectionErrors(errors);
		});
	});

	$('input#is_probe').on('change', function(e) {
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
	});

	$('#frm_mode_of_defects').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			dataType: 'JSON',
			data: $(this).serialize(),
		}).done(function(data, textStatus, xhr) {
			var modUrl = modDataTableURL+'?_token='+token+
					'&&pono='+$('#po_no').val()+
					'&&device='+$('#series_name').val()+
					// '&&lotno='+$('#lot_no').val()+
					'&&submission='+$('#submission').val();
			getDatatable('tbl_mode_of_defects',modUrl,modColumn,[],0);
			clearMOD();
		}).fail(function(data, textStatus, xhr) {
			var errors = data.responseJSON;
			ModeOfDefectsErrors(errors);
		});
	});

	$('#tbl_oqc_body').on('click', '.btn_edit_inspection', function() {
		$('#inspection_id').val($(this).attr('data-id'));
		$('#assembly_line').val($(this).attr('data-assembly_line'));
		$('#lot_no').val($(this).attr('data-lot_no'));
		$('#app_date').val($(this).attr('data-app_date'));
		$('#app_time').val($(this).attr('data-app_time'));
		$('#prod_category').val($(this).attr('data-prod_category'));
		$('#po_no').val($(this).attr('data-po_no'));
		$('#series_name').val($(this).attr('data-device_name'));
		$('#customer').val($(this).attr('data-customer'));
		$('#po_qty').val($(this).attr('data-po_qty'));
		$('#family').val($(this).attr('data-family'));
		$('#type_of_inspection').val($(this).attr('data-type_of_inspection'));
		$('#severity_of_inspection').val($(this).attr('data-severity_of_inspection'));
		$('#inspection_lvl').val($(this).attr('data-inspection_lvl'));
		$('#aql').val($(this).attr('data-aql'));
		$('#accept').val($(this).attr('data-accept'));
		$('#reject').val($(this).attr('data-reject'));
		$('#date_inspected').val($(this).attr('data-date_inspected'));
		$('#ww').val($(this).attr('data-ww'));
		$('#fy').val($(this).attr('data-fy'));
		$('#time_ins_from').val($(this).attr('data-time_ins_from'));
		$('#time_ins_to').val($(this).attr('data-time_ins_to'));
		$('#shift').val($(this).attr('data-shift'));
		$('#inspector').val($(this).attr('data-inspector'));
		$('#submission').val($(this).attr('data-submission'));
		$('#coc_req').val($(this).attr('data-coc_req'));
		$('#judgement').val($(this).attr('data-judgement'));
		$('#lot_qty').val($(this).attr('data-lot_qty'));
		$('#sample_size').val($(this).attr('data-sample_size'));
		$('#lot_inspected').val($(this).attr('data-lot_inspected'));
		$('#lot_accepted').val($(this).attr('data-lot_accepted'));
		$('#no_of_defects').val($(this).attr('data-num_of_defects'));
		$('#remarks').val($(this).attr('data-remarks'));
		$('#inspection_save_status').val('EDIT');

		if ($(this).attr('data-type') == 'PROBE PIN') {
			$('#is_probe').prop('checked', true);
		}

		checkLotAccepted($(this).attr('data-lot_accepted'));

		checkAuhtor($(this).attr('data-inspector'));

		$('#inspection_modal').modal('show');
	});

	$('#btn_confirm_delete').on('click', function() {
		if ($('#delete_func').val() == 'INSPECTION') {
			delete_items('.checkboxes',DeleteInspectionURL,oqcDataTableURL,'tbl_oqc',dataColumn);
		}

		if ($('#delete_func').val() == 'MOD') {
			delete_items('.checkboxes-mod',DeleteModeOfDefectsURL,modDataTableURL,'tbl_mode_of_defects',modColumn);
		}
	});

	$('.validate').on('change', function(e) {
		var no_error = $(this).attr('id');
		InspectionNoErrors(no_error)
	});

	$('.validateModeOfDefects').on('change', function(e) {
		var no_error = $(this).attr('id');
		ModeOfDefectsNoErrors(no_error)
	});

	$('#time_ins_from').on('change', function() {
		var time = setTime($(this).val());
		$(this).val(time);
	});

	$('#time_ins_to').on('change', function() {
		var time = setTime($(this).val());
		$(this).val(time);
	});

	$('#lot_accepted').on('change', function() {
		checkLotAccepted($(this).val())
	});

	$('#btn_getpodetails').on('click', function() {
		if ($('#po_no').val() == '') {

		} else {
			openloading();
			var is_probe = 0;
            if ($('#is_probe').is(':checked')) {
                is_probe = 1;
            }

			var data = {
				_token: token,
				is_probe: is_probe,
				po: $('#po_no').val(),
			}

			$.ajax({
				url: getPOdetailsURL,
				type: 'POST',
				dataType: 'JSON',
				data: data,
				complete: function(xhr, textStatus) {
					closeloading();
				},
				success: function(data, textStatus, xhr) {
					if (data.length > 0) {
						console.log(data);
						if (is_probe > 0) {
							getProbeProduct(data[0]['device_code']);
						} else {
							$('#series_name').val(data[0]['device_name']);
							$('#series_code').val(data[0]['device_code']);
							$('#customer').val(data[0]['customer_name']);
							$('#customer_code').val(data[0]['customer_code']);
							$('#po_qty').val(data[0]['po_qty']);
						}
					} else {
						msg("P.O. does not exist.","failed");
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					//called when there is an error
				}
			});
		}
	});

	$('#tbl_mode_of_defects_body').on('click', '.btn_edit_mod', function() {
		$('#mode_save_status').val('EDIT');
		$('#mod_po').val($(this).attr('data-pono'));
		$('#mod_device').val($(this).attr('data-device'));
		$('#mod_lotno').val($(this).attr('data-lotno'));
		$('#mod_submission').val($(this).attr('data-submission'));
		$('#mode_of_defects_name').val($(this).attr('data-mod1'));
		$('#mod_id').val($(this).attr('data-id'));
		$('#mod_qty').val($(this).attr('data-qty'));
	});

	$('#field1').on('change',function(){
		GroupByValues($(this).val(),$('#content1'));
    });

    $('#field2').on('change',function(){
        GroupByValues($(this).val(),$('#content2'));
    });

    $('#field3').on('change',function(){
        GroupByValues($(this).val(),$('#content3'));
    });

    $('#frm_DPPM').on('submit', function(e) {
    	e.preventDefault();
    	openloading();
    	$.ajax({
    		url: $(this).attr('action'),
    		type: 'POST',
    		dataType: 'JSON',
    		data: $(this).serialize()
    	}).done(function(data,xhr,textStatus) {
    		calculateDPPM(data);
    	}).fail(function(data,xhr,textStatus) {
    		msg("There was an error while calculating",'error');
    	}).always(function() {
    		closeloading();
    	});
    });
});

function initialize() {
	loadSelectInput();
	getFiscalYear();
	getWorkWeek();

	$('#accept').val(0);
	$('#reject').val(1);
	$('#lot_inspected').val(1);

	$('#no_of_defects_div').hide();
	$('#mode_of_defects_div').hide();
}

function clearControls() {
	$('.clear').val('');
}

function clearMOD() {
	$('.clear_mod').val('');
}

function InspectionErrors(errors) {
	$.each(errors, function(i, x) {
		switch(i) {
			case 'assembly_line':
				$('#assembly_line_div').addClass('has-error');
				$('#assembly_line_msg').html(x);
			break;
			case 'lot_no':
				$('#lot_no_div').addClass('has-error');
				$('#lot_no_msg').html(x);
			break;
			case 'app_date':
				$('#app_date_div').addClass('has-error');
				$('#app_date_msg').html(x);
			break;
			case 'app_time':
				$('#app_time_div').addClass('has-error');
				$('#app_time_msg').html(x);
			break;
			case 'prod_category':
				$('#prod_category_div').addClass('has-error');
				$('#prod_category_msg').html(x);
			break;
			case 'po_no':
				$('#po_no_div').addClass('has-error');
				$('#po_no_msg').html(x);
			break;
			case 'series_name':
				$('#series_name_div').addClass('has-error');
				$('#series_name_msg').html(x);
			break;
			case 'customer':
				$('#customer_div').addClass('has-error');
				$('#customer_msg').html(x);
			break;
			case 'po_qty':
				$('#po_qty_div').addClass('has-error');
				$('#po_qty_msg').html(x);
			break;
			case 'family':
				$('#family_div').addClass('has-error');
				$('#family_msg').html(x);
			break;
			case 'type_of_inspection':
				$('#type_of_inspection_div').addClass('has-error');
				$('#type_of_inspection_msg').html(x);
			break;
			case 'severity_of_inspection':
				$('#severity_of_inspection_div').addClass('has-error');
				$('#severity_of_inspection_msg').html(x);
			break;
			case 'inspection_lvl':
				$('#inspection_lvl_div').addClass('has-error');
				$('#inspection_lvl_msg').html(x);
			break;
			case 'aql':
				$('#aql_div').addClass('has-error');
				$('#aql_msg').html(x);
			break;
			case 'date_inspected':
				$('#date_inspected_div').addClass('has-error');
				$('#date_inspected_msg').html(x);
			break;
			case 'shift':
				$('#shift_div').addClass('has-error');
				$('#shift_msg').html(x);
			break;
			case 'time_ins_from':
				$('#time_ins_div').addClass('has-error');
				$('#time_ins_msg').html(x);
			break;
			case 'time_ins_to':
				$('#time_ins_div').addClass('has-error');
				$('#time_ins_msg').html(x);
			break;
			case 'submission':
				$('#submission_div').addClass('has-error');
				$('#submission_msg').html(x);
			break;
			case 'coc_req':
				$('#coc_req_div').addClass('has-error');
				$('#coc_req_msg').html(x);
			break;
			case 'judgement':
				$('#judgement_div').addClass('has-error');
				$('#judgement_msg').html(x);
			break;
			case 'lot_qty':
				$('#lot_qty_div').addClass('has-error');
				$('#lot_qty_msg').html(x);
			break;
			case 'sample_size':
				$('#sample_size_div').addClass('has-error');
				$('#sample_size_msg').html(x);
			break;
			case 'lot_inspected':
				$('#lot_inspected_div').addClass('has-error');
				$('#lot_inspected_msg').html(x);
			break;
			case 'lot_accepted':
				$('#lot_accepted_div').addClass('has-error');
				$('#lot_accepted_msg').html(x);
			break;
		}
	});
}

function InspectionNoErrors(error) {
	switch(error) {
		case 'assembly_line':
			$('#assembly_line_div').removeClass('has-error');
			$('#assembly_line_msg').html('');
		break;
		case 'lot_no':
			$('#lot_no_div').removeClass('has-error');
			$('#lot_no_msg').html('');
		break;
		case 'app_date':
			$('#app_date_div').removeClass('has-error');
			$('#app_date_msg').html('');
		break;
		case 'app_time':
			$('#app_time_div').removeClass('has-error');
			$('#app_time_msg').html('');
		break;
		case 'prod_category':
			$('#prod_category_div').removeClass('has-error');
			$('#prod_category_msg').html('');
		break;
		case 'po_no':
			$('#po_no_div').removeClass('has-error');
			$('#po_no_msg').html('');
		break;
		case 'series_name':
			$('#series_name_div').removeClass('has-error');
			$('#series_name_msg').html('');
		break;
		case 'customer':
			$('#customer_div').removeClass('has-error');
			$('#customer_msg').html('');
		break;
		case 'po_qty':
			$('#po_qty_div').removeClass('has-error');
			$('#po_qty_msg').html('');
		break;
		case 'family':
			$('#family_div').removeClass('has-error');
			$('#family_msg').html('');
		break;
		case 'type_of_inspection':
			$('#type_of_inspection_div').removeClass('has-error');
			$('#type_of_inspection_msg').html('');
		break;
		case 'severity_of_inspection':
			$('#severity_of_inspection_div').removeClass('has-error');
			$('#severity_of_inspection_msg').html('');
		break;
		case 'inspection_lvl':
			$('#inspection_lvl_div').removeClass('has-error');
			$('#inspection_lvl_msg').html('');
		break;
		case 'aql':
			$('#aql_div').removeClass('has-error');
			$('#aql_msg').html('');
		break;
		case 'date_inspected':
			$('#date_inspected_div').removeClass('has-error');
			$('#date_inspected_msg').html('');
		break;
		case 'shift':
			$('#shift_div').removeClass('has-error');
			$('#shift_msg').html('');
		break;
		case 'time_ins_from':
			$('#time_ins_div').removeClass('has-error');
			$('#time_ins_msg').html('');
		break;
		case 'time_ins_to':
			$('#time_ins_div').removeClass('has-error');
			$('#time_ins_msg').html('');
		break;
		case 'submission':
			$('#submission_div').removeClass('has-error');
			$('#submission_msg').html('');
		break;
		case 'coc_req':
			$('#coc_req_div').removeClass('has-error');
			$('#coc_req_msg').html('');
		break;
		case 'judgement':
			$('#judgement_div').removeClass('has-error');
			$('#judgement_msg').html('');
		break;
		case 'lot_qty':
			$('#lot_qty_div').removeClass('has-error');
			$('#lot_qty_msg').html('');
		break;
		case 'sample_size':
			$('#sample_size_div').removeClass('has-error');
			$('#sample_size_msg').html('');
		break;
		case 'lot_inspected':
			$('#lot_inspected_div').removeClass('has-error');
			$('#lot_inspected_msg').html('');
		break;
		case 'lot_accepted':
			$('#lot_accepted_div').removeClass('has-error');
			$('#lot_accepted_msg').html('');
		break;
	}
}

function ModeOfDefectsErrors(errors) {
	$.each(errors, function(i, x) {
		switch(i) {
			case 'mode_of_defects_name':
				$('#mode_of_defects_name_div').addClass('has-error');
				$('#mode_of_defects_name_msg').html(x);
			break;
			case 'mod_qty':
				$('#mod_qty_div').addClass('has-error');
				$('#mod_qty_msg').html(x);
			break;
		}
	});
}

function ModeOfDefectsNoErrors(error) {
	switch(error) {
		case 'mode_of_defects_name':
			$('#mode_of_defects_name_div').removeClass('has-error');
			$('#mode_of_defects_name_msg').html('');
		break;
		case 'mod_qty':
			$('#mod_qty_div').removeClass('has-error');
			$('#mod_qty_msg').html('');
		break;
	}
}

function NewInspection() {
	clearControls();
	$('#btn_savemodal').prop('disabled', false);
	$('#inspection_save_status').val('ADD');
	$('#inspection_modal').modal('show');
}

function ModeOfDefects() {
	clearMOD();
	if ($('#po_no').val() == '') {
		msg('Please select a P.O. Number.');
	} else {
		$('#mode_save_status').val('ADD');
		$('#mod_po').val($('#po_no').val());
		$('#mod_device').val($('#series_name').val());
		$('#mod_lotno').val($('#lot_no').val());
		$('#mod_submission').val($('#submission').val());

		var modUrl = modDataTableURL+'?_token='+token+
					'&&pono='+$('#po_no').val()+
					'&&submission='+$('#submission').val();
		getDatatable('tbl_mode_of_defects',modUrl,modColumn,[],0);
		$('#mode_of_defects_modal').modal('show');
	}
}

function loadSelectInput() {
	$.ajax({
		url: loadSelectInputURL,
		type: 'GET',
		dataType: 'JSON',
		data: {_token: token},
		complete: function(xhr, textStatus) {
			//called when complete
		},
		success: function(data, textStatus, xhr) {
			$.each(data.families, function(i, x) {
                $('#family').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.assemblyline, function(i, x) {
                $('#assembly_line').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.tofinspections, function(i, x) {
                $('#type_of_inspection').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.sofinspections, function(i, x) {
                $('#severity_of_inspection').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.inspectionlvls, function(i, x) {
                $('#inspection_lvl').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.aqls, function(i, x) {
                $('#aql').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.shifts, function(i, x) {
                $('#shift').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.submissions, function(i, x) {
                $('#submission').append('<option value="'+x.description+'">'+x.description+'</option>');
                $('#rpt_sub').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $.each(data.mods, function(i, x) {
                $('#mode_of_defects_name').append('<option value="'+x.description+'">'+x.description+'</option>');
            });

            $('#shift').val('Shift A');
            $('#submission').val('1st');
		},
		error: function(xhr, textStatus, errorThrown) {
			msg("There was an error while generating Select input options.");
		}
	});
}

function delete_items(checkboxClass,deleteUrl,datatableURL,table,dataColumn) {
	var chkArray = [];
	$(checkboxClass+":checked").each(function() {
		chkArray.push($(this).val());
	});

	if (chkArray.length > 0) {
		var data = {
			_token: token,
			ids: chkArray,
		}
		delete_now(deleteUrl,datatableURL,data,table,dataColumn);
	} else {
		$('#delete_modal').modal('hide');
		msg("Please select at least 1 item.", 'failed');
	}
}

function delete_now(deleteUrl,datatableURL,data,table,dataColumn) {
	$.ajax({
		url: deleteUrl,
		type: 'POST',
		dataType: 'JSON',
		data: data,
	}).done(function(data,textStatus,jqXHR) {
		$('#delete_modal').modal('hide');
		msg(data.msg,data.status);
		getDatatable(table,datatableURL,dataColumn,[],0);
	}).fail(function(data,textStatus,jqXHR) {
		msg("There's an error occurred while processing.",'error');
	});
}

function setTime(time) {
	var h = time.substring(0,2);
	var m = time.substring(3,5);
	var a = time.substring(6,8);

	if (m == undefined || m == '' || m == null) {
		m = '00';
	}

	if (h < 12 && h > 0) {
		if (a == undefined || a == '' || a == null || a == 'A') {
			a = 'AM';
		}
		return h+":"+m+" "+a;
	} else if (h == 00 || h == 0) {
		if (a == undefined || a == '' || a == null || a == 'A') {
			a = 'AM';
		}
		return "12"+":"+m+" "+a;
	}  else if (h == 12) {
		if (a == undefined || a == '' || a == null || a == 'P') {
			a = 'PM';
		}
		return h+":"+m+" "+a;
	} else {
		if (a == undefined || a == '' || a == null || a == 'P') {
			a = 'PM';
		}
		switch(h) {
			case '13':
				return "01"+":"+m+" "+a;
				break;
			case '14':
				return "02"+":"+m+" "+a;
				break;
			case '15':
				return "03"+":"+m+" "+a;
				break;
			case '16':
				return "04"+":"+m+" "+a;
				break;
			case '17':
				return "05"+":"+m+" "+a;
				break;
			case '18':
				return "06"+":"+m+" "+a;
				break;
			case '19':
				return "07"+":"+m+" "+a;
				break;
			case '20':
				return "08"+":"+m+" "+a;
				break;
			case '21':
				return "09"+":"+m+" "+a;
				break;
			case '22':
				return "10"+":"+m+" "+a;
				break;
			case '23':
				return "11"+":"+m+" "+a;
				break;
			default:
				return time;
				break;
		}
	}
}

function getFiscalYear() {
    var date = new Date();
    var month = date.getMonth();
    var year = date.getFullYear();

    $('#fy').val(year);
}

function getWorkWeek() {
	$.ajax({
		url: getWorkWeekURL,
		type: 'GET',
		dataType: 'JSON',
		data: {_token: token},
		complete: function(xhr, textStatus) {
			//called when complete
		},
		success: function(data, textStatus, xhr) {
			$('#ww').val(data);
		},
		error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
		}
	});
}

function DeleteInspection() {
	if ($('.checkboxes:checkbox:checked').length > 0) {
		$('#delete_func').val('INSPECTION');
		$('#delete_modal').modal('show');
	} else {
		msg('Select at least 1 inspection.','failed');
	}
}

function DeleteModeOfDefects() {
	if ($('.checkboxes-mod:checkbox:checked').length > 0) {
		$('#delete_func').val('MOD');
		$('#delete_modal').modal('show');
	} else {
		msg('Select at least 1 mode of defect.','failed');
	}
}

function checkLotAccepted(lot_accepted) {
	if (lot_accepted == 0) {
		$('#judgement').val('Reject');
		$('#no_of_defects_div').show();
		$('#mode_of_defects_div').show();
	}

	if (lot_accepted == 1) {
		$('#judgement').val('Accept');
		$('#no_of_defects').val(0);
		$('#no_of_defects_div').hide();
		$('#mode_of_defects_div').hide();
	}
}

function Search() {
	$('#search_modal').modal('show');
}

function Report() {
	$('#rpt_submission').val('1st');
	$('#report_modal').modal('show');
}

function GroupBy() {
	$('#groupby_modal').modal('show');
}

function searchInspection() {
	var oqcSearchURL = oqcDataTableURL+'?type=search&search_po='+$('#search_po').val()+
						'&search_from='+$('#search_from').val()+
						'&search_to='+$('#search_to').val();
	getDatatable('tbl_oqc',oqcSearchURL,dataColumn,[],0);
}

function checkAuhtor(inspector) {
	if (author != inspector || author != 'cnpoblete') {
		$('#btn_savemodal').prop('disabled', true);
	} else {
		$('#btn_savemodal').prop('disabled', false);
	}
}

function PDFReport() {
	var oqcSearchURL = oqcDataTableURL+'?type=search&search_po='+$('#rpt_po').val()+
						'&search_from='+$('#rpt_from').val()+
						'&search_to='+$('#rpt_to').val();
	getDatatable('tbl_oqc',oqcSearchURL,dataColumn,[],0);

	window.location.href = PDFReportURL+"?po="+$('#rpt_po').val()+"&&from="+$('#rpt_from').val()+
	"&&to="+$('#rpt_to').val()+"&&submission="+$('#rpt_submission').val();
}

function ExcelReport() {
	var oqcSearchURL = oqcDataTableURL+'?type=search&search_po='+$('#rpt_po').val()+
						'&search_from='+$('#rpt_from').val()+
						'&search_to='+$('#rpt_to').val();
	getDatatable('tbl_oqc',oqcSearchURL,dataColumn,[],0);

	window.location.href = ExcelReportURL+"?po="+$('#rpt_po').val()+"&&from="+$('#rpt_from').val()+
	"&&to="+$('#rpt_to').val()+"&&submission="+$('#rpt_submission').val();
}

function GroupByValues(field,element) {
	element.html('');
	var data = {
		_token: token,
		field: field
	}
	$.ajax({
		url: GroupByURL,
		type: 'GET',
		dataType: 'JSON',
		data: data,
	}).done(function(data,xhr,textStatus) {
		$.each(data, function(i, x) {
			element.append('<option value="'+x.field+'">'+x.field+'</option>');
		});
	}).fail(function(data,xhr,textStatus) {
		msg("There was an error while processing the values.",'error');
	}).always(function() {
		console.log("complete");
	});
}

function calculateDPPM(data) {
	var tbl_DPPM_details_body = '';
	$('#tbl_DPPM_details_body').html(tbl_DPPM_details_body);
	var tbl_DPPM_body = '';
	$('#tbl_DPPM_body').html(tbl_DPPM_body);


	$.each(data, function(i, x) {
		var templar = x.lot_accepted / x.lot_inspected;
		var lar = (templar * 100).toFixed(2);

		var templrr = x.lot_rejected / x.lot_inspected;
    	var lrr = (templrr * 100).toFixed(2);

    	if(x.num_of_defects == 0 && x.sample_size == 0){
	        var noddivss = 0;   
	    }else if(x.sample_size == 0){
	        var noddivss = 0;
	    }else if(x.num_of_defects == 0){
	        var noddivss = 0;
	    }else{
	        var noddivss = x.num_of_defects/x.sample_size;
	    }

	    var dppm = (noddivss * 1000000).toFixed(2);

	    tbl_DPPM_details_body = '<tr>'+  
	                                '<td></td>'+ 
	                                '<td>'+x.lot_inspected+'</td>'+
	                                '<td>'+x.lot_accepted+'</td>'+
	                                '<td>'+x.lot_rejected+'</td>'+  
	                                '<td>'+x.sample_size+'</td>'+
	                                '<td>'+x.num_of_defects+'</td>'+
	                                '<td>'+lar+'</td>'+
	                                '<td>'+lrr+'</td>'+
	                                '<td>'+dppm+'</td>'+
	                            '</tr>';

	    $('#tbl_DPPM_details_body').append(tbl_DPPM_details_body)
	});

	$.each(data, function(i, x) {
		var templar = x.lot_accepted / x.lot_inspected;
		var lar = (templar * 100).toFixed(2);

		var templrr = x.lot_rejected / x.lot_inspected;
    	var lrr = (templrr * 100).toFixed(2);

    	if(x.num_of_defects == 0 && x.sample_size == 0){
	        var noddivss = 0;   
	    }else if(x.sample_size == 0){
	        var noddivss = 0;
	    }else if(x.num_of_defects == 0){
	        var noddivss = 0;
	    }else{
	        var noddivss = x.num_of_defects/x.sample_size;
	    }

	    var dppm = (noddivss * 1000000).toFixed(2);

        var tbl_DPPM_body = '<tr>'+  
			                    '<td>'+x.submission+'</td>'+ 
			                    '<td>'+x.lot_inspected+'</td>'+
			                    '<td>'+x.lot_accepted+'</td>'+
			                    '<td>'+x.lot_rejected+'</td>'+  
			                    '<td>'+x.sample_size+'</td>'+
			                    '<td>'+x.num_of_defects+'</td>'+
			                    '<td>'+lar+'</td>'+
			                    '<td>'+lrr+'</td>'+
			                    '<td>'+dppm+'</td>'+
			                '</tr>';
        $('#tbl_DPPM_body').append(tbl_DPPM_body);
	});
}

function getProbeProduct(code) {
	$('#item_probe').html('');
    var data = {
        _token: token,
        code: code
    }
    $.ajax({
        url: GetProbeProductURL,
        type: 'GET',
        dataType: 'JSON',
        data: data,
    }).done(function(data,textStatus,jqXHR) {
        $('#item_probe').html('<option value=""></option>');
        $.each(data, function(i, x) {
            $('#item_probe').append('<option value="'+x.devicecode+'|'+x.DEVNAME+'">'+x.DEVNAME+'</option>');
            $('#probe_item_modal').modal('show');
        });
    }).fail(function(data,textStatus,jqXHR) {
        console.log("error");
    });
}
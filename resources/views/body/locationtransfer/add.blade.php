@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
         
        @parent
    @stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">
        <!--end of page level css-->
	
	<link rel="stylesheet" href="{{asset('assets/vendors/datetime/css/jquery.datetimepicker.css')}}">
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datepicker.css')}}">
	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/buttons.bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/colReorder.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/scroller.bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/responsive_datatables.css')}}">
@stop

{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Material Transfer
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="fa fa-fw fa-briefcase"></i> Inventory
                    </a>
                </li>
                <li>
                    <a href="#">Material  Transfer</a>
                </li>
                <li class="active">
                    Add
                </li>
            </ol>
        </section>
        <!--section ends-->
		
		<!--section ends-->
		
		@if(Session::has('message'))
		<div class="alert alert-success">
			<p>{{ Session::get('message') }}</p>
		</div>
		@endif
		
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left m-t-6">
                                <i class="fa fa-fw fa-crosshairs"></i> New Material Transfer
                            </h3>
							
							<div class="pull-right">
							 <a href="{{ url('location_transfer/add') }}"  class="btn btn-info btn-sm">
									<span class="btn-label">
										<i class="fa fa-fw fa-refresh"></i>
									</span>
							</a>
								
							
							</div>
                        </div>
                        <div class="panel-body">
							<div class="controls"> 
                            <form class="form-horizontal" role="form" method="POST" name="frmLocTransfer" id="frmLocTransfer" action="{{ url('location_transfer/save') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


							<div class="form-group">
                               <font color="#16A085">  <label class="col-sm-2 control-label"><b>Location From</b><span class="text-danger">*</span></label></font>
                               <div class="col-sm-10">
                                 <div id="locationRadioGroup">
                                   @foreach($location as $loc)
                                <label class="radio-inline">
                                    <input type="radio" class="locfrom-radio" name="location_from" value="{{ $loc['id'] }}">{{ $loc['name'] }}
                                 </label>
                                 @endforeach
								 <small class="text-muted" id="locfrom-hint">
                                             Select one location — once chosen, it becomes fixed.
                                    </small>
                                 </div>

                               <input type="hidden" id="selected_locfrom_id" name="locfrom_id">
                                  <small class="text-muted" id="locfrom-mand">
                                             '*' is mandatory fields
                                    </small>
                             </div>
                        </div>

								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">LT. No.</label>
                                    <div class="col-sm-10">
									  <div class="input-group">
											<span class="input-group-addon" id="prefixBox">{{$voucherno->prefix}}</span>
                                   <input type="text" class="form-control" id="voucher_no" readonly name="voucher_no" placeholder="{{$voucherno->no}}">
                                    <input type="hidden" value="{{$voucherno->prefix}}" name="prefix">
									<input type="hidden" value="{{$voucherno->voucher_type}}" name="voucher_type">
											<input type="hidden" value="{{$voucherno->autoincrement}}" name="autoincrement">
									<span class="input-group-addon inputvn"><i class="fa fa-fw fa-edit"></i></span>
										</div>
										<input type="hidden" name="curno" id="curno" value="{{(old('curno'))?old('curno'):$voucherno->no}}">
									</div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Reference No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reference_no" name="reference_no" autocomplete="off" placeholder="Reference No.">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">LT. Date</label>
                                    <div class="col-sm-10">
										<input type="text" class="form-control pull-right" autocomplete="off" name="voucher_date" data-language='en' id="voucher_date" placeholder="{{date('d-m-Y')}}"/>
                                    </div>
                                </div>
								
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"><b>Location To</b><span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select id="locto_id" class="form-control select2" style="width:100%" name="locto_id">
											<?php 
											foreach($location as $loc) { 
											?>
											<option value="{{ $loc['id'] }}">{{ $loc['name'] }}</option>
											<?php } ?>
											<option value="" selected>Select Location..</option>
                                        </select>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"> Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" name="description" autocomplete="off" placeholder="Description">
                                    </div>
                                </div>
								
								<br/>
								<fieldset>
								<legend style="margin-bottom:0px !important;"><h5><span class="itmDtls">Item Details</span></h5></legend>
								<table class="table table-bordered" style="margin-bottom:0px !important;">
									<thead>
									<tr>
										<th width="15%" class="itmHd">
											<span class="small">Item Code</span>
										</th>
										<th width="25%" class="itmHd">
											<span class="small">Item Description</span>
										</th>
										<th width="7%" class="itmHd">
											<span class="small">Unit</span>
										</th>
										<th width="10%" class="itmHd">
											<span class="small">Quantity</span>
										</th>
									</tr>
									</thead>
								</table>
								<div class="itemdivPrnt">
									<div class="itemdivChld">							
										<table border="0" class="table-dy-row">
												<tr>
													<td width="16%" >
														<input type="hidden" name="item_id[]" id="itmid_1">
														<input type="text" id="itmcod_1" name="item_code[]" class="form-control" autocomplete="off" data-toggle="modal" data-target="#item_modal" placeholder="Item Code">
													</td>
													<td width="29%">
														<input type="text" name="item_name[]" id="itmdes_1" autocomplete="off" class="form-control" placeholder="Item Description">
													</td>
													<td width="7%">
														<select id="itmunt_1" class="form-control select2 line-unit" style="width:100%" name="unit_id[]"><option value="">Unit</option></select>
													</td>
													<td width="8%" class="itcod">
														<input type="number" id="itmqty_1" autocomplete="off" name="quantity[]" class="form-control line-quantity" placeholder="Qty.">
													</td>
													
													<td width="1%">
														<button type="button" class="btn btn-success btn-add-item" >
																<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
															 </button>
													</td>
												</tr>
											</table>

											<div id="loc" style="float:left; padding-right:5px;">
												<button type="button" id="loc_1" class="btn btn-primary btn-xs loc-info">Location</button>
											</div>

											<div id="locin" style="float:left; padding-right:5px;">
												<button type="button" id="locin_1" class="btn btn-primary btn-xs locin-info">Intra Location</button>
											</div>
											
											<div class="locPrntItm" id="locPrntItm_1">
													<div class="locChldItm">							
														<div class="table-responsive loc-data" id="locData_1"></div>
													</div>
												</div>

												
											
											<div class="locinPrntItm" id="locinPrntItm_1">
													<div class="locinChldItm">							
														<div class="table-responsive locin-data" id="locinData_1"></div>
													</div>
												</div>

										<hr/>
									</div>
								</div>
								
								</fieldset>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Total Quantity</label>
                                    <div class="col-xs-10">
										<div class="col-xs-2"></div>
										<div class="col-xs-2"></div>
										<div class="col-xs-2"></div>
										<div class="col-xs-2"></div>
										<div class="col-xs-2">
										<input type="number" id="total" step="any" name="total" class="form-control spl" readonly placeholder="0">
										</div>
									</div>
                                </div>
								<br/>
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
										<a href="{{ url('location_transfer') }}" class="btn btn-danger">Cancel</a>
										<a href="{{ url('location_transfer/add') }}" class="btn btn-warning">Clear</a>
                                    </div>
                                </div>
                                                            
							
							<div id="item_modal" class="modal fade animated" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Select Item</h4>
                                        </div>
                                        <div class="modal-body" id="item_data">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
							
                            </form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
       
            <!--main content-->
            <!-- row -->
        @include('layouts.right_sidebar')
        <!-- right side bar end -->
        </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/custom_js/form_elements.js')}}"></script>
        <!-- end of page level js -->

<script src="{{asset('assets/vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.en.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/custom_js/advanceddate_pickers.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.rowReorder.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.colVis.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.html5.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.scroller.js')}}"></script>
<script src="{{asset('assets/vendors/mark.js/jquery.mark.js')}}" charset="UTF-8"></script>
<script src="{{asset('assets/vendors/datatablesmark.js/js/datatables.mark.min.js')}}" charset="UTF-8"></script>
<script src="{{asset('assets/js/custom_js/responsive_datatables.js')}}" type="text/javascript"></script>
<script>

$('#voucher_date').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );

"use strict";

$(document).ready(function () { 
	
	$('.infodivPrnt').toggle(); $('.infodivPrntItm').toggle();$('.locPrntItm').toggle();$('.locinPrntItm').toggle();
   

  $(document).on('ifChecked', '.locfrom-radio', function (e) {
          var val = $(this).val();
		 
         $.get("{{ url('location/getCode') }}/" + val, function (locCode) { 
             
			  let prefix = $('input[name="prefix"]').val();   // Example: LT
             let newPrefix = prefix + locCode;               // LTWH1

               // show new prefix on screen
                $('#prefixBox').text(newPrefix);
                $('input[name="prefix"]').val(newPrefix);

               $('.locfrom-radio').prop('disabled', true);
         // store the value in the hidden field
              $('#selected_locfrom_id').val(val);

        // update message
        $('#locfrom-hint').text('Default location selected and locked.');
     });

	 // enable all options first
             $('#locto_id option').show();

    // reset dropdown if same was selected before
    if ($('#locto_id').val() == val) {
        $('#locto_id').val(''); 
    }

    // hide the selected "Location From" from the "Location To"
    $('#locto_id option[value="' + val + '"]').hide();

    // If using Select2, you must refresh it
    $('#locto_id').trigger('change.select2');
    });


	var urlcode = "{{ url('location_transfer/checkrefno/') }}";
    $('#frmLocTransfer').bootstrapValidator({
        fields: {
			reference_no: {
                validators: { 
                   /*  notEmpty: {
                        message: 'The reference no id is required and cannot be empty!'
                    }, */
					remote: {
                        url: urlcode,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('reference_no').val()
                            };
                        },
                        message: 'This Reference No. is already exist!'
                    }
                }
            },
			location_from: { validators: { notEmpty: { message: 'Location from is required and cannot be empty!' } }},
			location_to: { validators: { notEmpty: { message: 'Location to is required and cannot be empty!' } }},
			'item_code[]': { validators: { notEmpty: { message: 'The item code is required and cannot be empty!' } }},
			//'item_name[]': { validators: { notEmpty: { message: 'The item description is required and cannot be empty!' } }}
        }
        
    }).on('reset', function (event) {
        $('#frmLocTransfer').data('bootstrapValidator').resetForm();
    });
		
});

	//calculation item net total, tax and discount...
	function getTotal() {
		
		var lineTotal = 0;
		$( '.line-quantity' ).each(function() { 
			lineTotal = lineTotal + parseFloat(this.value);
		});
		
		$('#total').val(lineTotal);
	}
	
	
$(function() {	
	var rowNum = 1;
	$(document).on('click', '.btn-add-item', function(e)  { 
        rowNum++; //console.log(rowNum);
		e.preventDefault();
		if( $('.locPrntItm').is(":visible") ){
			$('.locPrntItm').toggle();	
			}
		if( $('.locinPrntItm').is(":visible") ){
			 $('.locinPrntItm').toggle();
			}
        var controlForm = $('.controls .itemdivPrnt'),
            currentEntry = $(this).parents('.itemdivChld:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
			newEntry.find($('.line-unit')).attr('id', 'itmunt_' + rowNum); //input[type='select']
			newEntry.find($('input[name="item_id[]"]')).attr('id', 'itmid_' + rowNum);
			newEntry.find($('input[name="item_code[]"]')).attr('id', 'itmcod_' + rowNum);
			newEntry.find($('input[name="item_name[]"]')).attr('id', 'itmdes_' + rowNum);
			newEntry.find($('input[name="unit[]"]')).attr('id', 'itmunt_' + rowNum);
			newEntry.find($('input[name="quantity[]"]')).attr('id', 'itmqty_' + rowNum);
			newEntry.find($('.infodivPrntItm')).attr('id', 'infodivPrntItm_' + rowNum);
			newEntry.find($('.item-data')).attr('id', 'itemData_' + rowNum);
			newEntry.find($('button[type="button"]')).attr('data-id', 'rem_' + rowNum); //NEW CHNG
			newEntry.find('input').val(''); 
			newEntry.find('.line-unit').find('option').remove().end().append('<option value="">Unit</option>');//new change
			newEntry.find($('.loc-info')).attr('id', 'loc_' + rowNum);
			newEntry.find($('.loc-data')).attr('id', 'locData_' + rowNum);
			newEntry.find($('.locPrntItm')).attr('id', 'locPrntItm_' + rowNum);  
            newEntry.find($('.locin-info')).attr('id', 'locin_' + rowNum);
			newEntry.find($('.locin-data')).attr('id', 'locinData_' + rowNum);
			newEntry.find($('.locinPrntItm')).attr('id', 'locinPrntItm_' + rowNum);  
 
			if( $('#infodivPrntItm_'+rowNum).is(":visible") ) 
				$('#infodivPrntItm_'+rowNum).toggle();
			if( $('#locPrntItm_'+rowNum).is(":visible") ) 
				$('#locPrntItm_'+rowNum).toggle();	
			controlForm.find('.btn-add-item:not(:last)')
            .removeClass('btn-default').addClass('btn-danger')
            .removeClass('btn-add-item').addClass('btn-remove-item')
            .html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> ');
    }).on('click', '.btn-remove-item', function(e)
    { 
		//new change..
		$(this).parents('.itemdivChld:first').remove();
		
		getTotal();
		
		e.preventDefault();
		return false;
	});
	

	$(document).on('blur', '#voucher_no', function(e) {  
		if(parseInt($(this).val()) > parseInt($('#curno').val())) {
			alert('Voucher no is greater than current range!');
			$('#voucher_no').val('');
		}
	});
	
	//new change.................
	$(document).on('click', '.itemRow', function(e) { 
		var num = $('#num').val();
		$('#itmcod_'+num).val( $(this).attr("data-code") );
		$('#itmid_'+num).val( $(this).attr("data-id") );
		$('#itmdes_'+num).val( $(this).attr("data-name") );
		
		var itm_id = $(this).attr("data-id")
		$.get("{{ url('purchase_order/getunit/') }}/" + itm_id, function(data) { 
			$.each(data, function(key, value) {   
			$('#itmunt_'+num).find('option').remove().end()
			 .append($("<option></option>")
						.attr("value",value.id)
						.text(value.unit_name)); 
			});

		});
	});
	
	
	//new change............
	var itmurl = "{{ url('itemmaster/item_data/') }}";
	$(document).on('click', 'input[name="item_code[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		$('#item_data').load(itmurl+'/'+curNum, function(result){ 
			$('#myModal').modal({show:true});
		});
		
	});
	
	//new change............
	$(document).on('click', 'input[name="item_name[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		$('#item_data').load(itmurl+'/'+curNum, function(result){ 
			$('#myModal').modal({show:true});
		});
		
	});
	
	
	$(document).on('blur', '.line-quantity', function(e) {
		getTotal();
		$('#frmPurchaseInvoice').bootstrapValidator('revalidateField', 'quantity[]');
	});
	
	
	//new change...
	$(document).on('change', '.line-unit', function(e) {
		var unit_id = e.target.value; 
		var res = this.id.split('_');
		var curNum = res[1];
		
	});
	
	$('input,select').keydown( function(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if(key == 13) {
            e.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });

	$(document).on('click', '.loc-info', function(e) { 
	   e.preventDefault();
	   var res = this.id.split('_');
	   var curNum = res[1];  
	    if( $('#locinPrntItm_'+curNum).is(":visible") ){
			$('#locinPrntItm_'+curNum).toggle(); 
			}
	   var item_id = $('#itmid_'+curNum).val();
	   if(item_id!='') {
		   var locUrl = "{{ url('itemmaster/view_locinfo/') }}/"+item_id
		  // if ($('#locData_'+curNum).is(':empty')){
    		   $('#locData_'+curNum).load(locUrl, function(result) {
    			  $('#myModal').modal({show:true});
    		   });
    		  
		 // } else
		       $('#locPrntItm_'+curNum).toggle(); 
	   }
    });

	$(document).on('click', '.locin-info', function(e) { 
	   e.preventDefault();
	   
	   var res = this.id.split('_');
	   var curNum = res[1];  
	   if( $('#locPrntItm_'+curNum).is(":visible") ){
			$('#locPrntItm_'+curNum).toggle(); 
			}
	   var item_id = $('#itmid_'+curNum).val();
	   if(item_id!='') {
		   var locUrl = "{{ url('itemmaster/view_intralocinfo/') }}/"+item_id
		  
    		   $('#locinData_'+curNum).load(locUrl, function(result) {
    			  $('#myModal').modal({show:true});
    		   });
    		  
		
		       $('#locinPrntItm_'+curNum).toggle(); 
	   }
    });

	// --------------------------------------------------------
// LOCATION FROM radio selection - permanent lock
// --------------------------------------------------------



	
});

</script>
@stop

@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
         
        @parent
    @stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">
        <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Set Report
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-shield"></i> Administration
                    </a>
                </li>
                <li>
                    <a href="#">Set Report</a>
                </li>
                
            </ol>
			
        </section>
		
        <section class="content">
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left m-t-6">
                            <i class="fa fa-fw fa-list-alt"></i> Report - {{ isset($report) ? $report->name : (isset($reports[0]) ? $reports[0]->report_name : '') }}
                        </h3>
                        
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
							<div class="pull-right">
								<a href="{{ url('set_report/'.(isset($report) ? $report->id : (isset($reports[0]) ? $reports[0]->id : ''))) }}" class="btn btn-warning"><i class="fa fa-fw fa-refresh"></i> Refresh</a>
								
								<button type="button" class="btn btn-primary btn-add-row" >
									<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add more
								 </button>
							 </div>
								<input type="hidden" id="rid" name="rid" value="{{ isset($report) ? $report->id : (isset($reports[0]) ? $reports[0]->id : '') }}"/>
                                <table class="table table-striped" id="formTable">
                                    <thead>
                                    <tr>
										<th>Button Name</th>
										<th>File Name</th>
										<th>Default</th>
										<th>Save</th>
										<th>Delete</th>
										<th>Design</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									@foreach($reports as $row)
                                    <tr>
										<td><input type="text" class="form-control txname" name="name" value="{{$row->name}}"/>
											<input type="hidden" class="txid" name="id" value="{{$row->rid}}"/>
										</td>
										<td>
											<select class="form-control select2 selview" style="width:100%" name="file_name">
												<option value="">Select Template...</option>
												@foreach ($files as $file)
												<?php $chkd = ($row->print_name == $file)?'selected':'';	?>
												<option value="{{ $file }}" {{$chkd}}>{{ $file }}</option>
												@endforeach
											</select>
										</td>
										<td class="opt"><input type="radio" class="opdft" name="is_default" <?php if($row->is_default==1) echo 'checked';?>/> </td>
										<td><button class="btn btn-primary btn-xs save"><i class="fa fa-fw fa-floppy-o"></i></button>
										</td>
										<td class="del"><?php if($row->is_default==0) { ?> <button class="btn btn-danger btn-xs delete">
											<span class="glyphicon glyphicon-trash"></span></button><?php } ?>
										</td>
                                        <td><a href="{{ URL::to('designer/'.$row->rid) }}" target="_blank" class="btn btn-warning btn-xs design">
											<span class="glyphicon glyphicon-wrench"></span></a>
										</td>
                                    </tr>
									@endforeach
                                   
                                    </tbody>
                                </table>
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
<!-- end of page level js -->
<script>

function buildReportRow() {
    var options = '<option value="">Select Template...</option>'
@foreach ($files as $file)
        + '<option value="{{ addslashes($file) }}">{{ addslashes($file) }}</option>'
@endforeach
        ;

    return '<tr>'
        + '<td><input type="text" class="form-control txname" name="name" value=""/>'
        + '<input type="hidden" class="txid" name="id" value=""/></td>'
        + '<td><select class="form-control select2 selview" style="width:100%" name="file_name">' + options + '</select></td>'
        + '<td class="opt"><input type="radio" class="opdft" name="is_default"/></td>'
        + '<td><button class="btn btn-primary btn-xs save"><i class="fa fa-fw fa-floppy-o"></i></button></td>'
        + '<td class="del"><button class="btn btn-danger btn-xs delete"><span class="glyphicon glyphicon-trash"></span></button></td>'
        + '<td><button type="button" class="btn btn-warning btn-xs design-disabled" disabled title="Save first"><span class="glyphicon glyphicon-wrench"></span></button></td>'
        + '</tr>';
}

$(document).on('click', '.btn-add-row', function(e) 
{ 
   e.preventDefault();
   $('#formTable tbody').append(buildReportRow());
});

$(document).on('click', '.save', function(e)  {
    e.preventDefault();
    var $row = $(this).closest("tr");
    var name = $row.find(".txname").val();
    var id = $row.find(".txid").val();
    var file = $row.find(".selview option:selected").val(); //console.log('nm '+file); 
    var opt = ($row.find(".opdft").is(":checked"))?1:0; //console.log('opt '+opt); 
	var rid = $('#rid').val();
	
	$.ajax({
		url: "{{ url('set_report/update/') }}",
		type: 'get',
		data: 'file='+file+'&id='+id+'&name='+name+'&opt='+opt+'&rid='+rid,
		success: function(data) {
			if(data && data.id) {
				$row.find('.txid').val(data.id);
				if($row.find('.design').length === 0) {
					$row.find('td:last').html(
						'<a href="{{ url('designer') }}/'+data.id+'" target="_blank" class="btn btn-warning btn-xs design"><span class="glyphicon glyphicon-wrench"></span></a>'
					);
				}
			}
			alert('Print format has been updated successfully.')
			
			return true;
		}
	})
	
});

$(document).on('click', '.delete', function(e)  { 
  e.preventDefault();
  var con = confirm('Are you sure delete this print format?');
	if(con==true) {
		var id = $(this).closest("tr").find(".txid").val(); console.log('opt '+id); 
		$.ajax({
			url: "{{ url('set_report/delete/') }}/"+id,
			type: 'get',
			//data: 'id='+id,
			success: function(data) {
				alert('Print format has been deleted successfully.')
				return true;
			}
		})
		$(this).closest('tr').remove();
	}
});

$(document).on('click', '.design', function(e)  { 
  e.preventDefault();
	var id = $(this).closest("tr").find(".txid").val();
	if(!id) {
		alert('Save this row first.');
		return false;
	}
	$.ajax({
		url: "{{ url('set_report/save/') }}/"+id,
		type: 'get',
		success: function(data) {
			return true;
		}
	})
    window.open("{{ url('designer') }}", "_blank")
});

$(document).on('click', '.design-disabled', function(e) {
	e.preventDefault();
	alert('Save this row first.');
});

</script>

@stop

<br/>
<div class="col-xs-4">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Location</th>
			<th>Stock </th>
			
		</tr>
		</thead>
		<tbody>
		@foreach($info as $row)
		<tr>
			<td>{{ $row->name }}</td>
			<td>{{ $row->quantity }}</td>
			
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
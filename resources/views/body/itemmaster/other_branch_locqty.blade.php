<br/>
<div class="col-xs-10">
    <h4>Other Branch Locations</h4>
    
    @if($items->isEmpty())
        <div class="alert alert-info">
            No quantities found in other branches.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Code</th>
                <th>Location Name</th>
                <th>Quantity</th>
                <th>Bin</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $row)
            <tr>
                <td>{{ $row->location_code }}</td>
                <td>{{ $row->location_name }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->bin_code ?? '-' }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
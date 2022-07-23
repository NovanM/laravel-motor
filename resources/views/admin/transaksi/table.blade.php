<table id="bootstrap-data-table-export" class="table table-t table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Status</th>
            <th>Total</th>
            <th>URL Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allTransaksi as $i => $row)

        <tr>
            <td>{{++$i}}</td>
            <td>000{{$row->id}}</td>
            <td>{{date('d F Y',strtotime($row->created_at))}}</td>
            <td>{{$row->user->name}}</td>
            @if($row->status == 'pending')
            <td><label class="badge badge-warning">{{$row->status}}</label></td>
            @elseif($row->status=='success')
            <td> <label class="badge badge-success">{{$row->status}}</label></td>
            @else
            <td><label class="badge badge-danger">{{$row->status}}</label></td>
            @endif
            <td>@currency($row->total)</td>
            <td><a class="btn btn-primary" href="{{$row->payment_url}}">Goto Link</a></td>

        </tr>
        @endforeach
    </tbody>
</table>
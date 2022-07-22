<table id="bootstrap-data-table-export" class="table table-t table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
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
            <td>@currency($row->total)</td>
            <td><a class="btn btn-primary" href="{{$row->payment_url}}">Goto Link</a></td>

        </tr>
        @endforeach
    </tbody>
</table>
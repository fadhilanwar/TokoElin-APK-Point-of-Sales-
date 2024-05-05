<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Belanja</title>
</head>
<body>
    <style>
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        </style>
    <div class="form-group">
        <center>
            <h1>
                Detail Belanja
            </h1>
        </center>
        <table>

            @foreach ($penjualan as $head)
            
            <tr>
                <td>{{ $head->no_transaksi }}</td>
                <td>{{ $head->tgl_transaksi }}</td>
                <td>{{ $head->kasir }}</td>
                <td>{{ $head->nama_pembeli }}</td>
                {{-- <td>{{ $head->total_bayar }}</td> --}}
                <td>{{ $head->uang_diterima }}</td>
                <td>{{ $head->kembalian }}</td>
            </tr>
            @endforeach
        </table>
        <table border="1px" class="static" align="center" rules="all" style="width: 95%">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            @php
                $total = 0;
                $totalK = 0;
            @endphp
            @foreach ($penjualan as $item)
            <tr>
                <td>{{ $item->id_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>Rp. {{ number_format($item->harga_satuan) }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp. {{ number_format($item->subtotal) }}</td>
            </tr>
            {{-- @php
                // $total += $item->total_bayar;
                // $totalK += ($item->harga_satuan - $item->harga_grosir) * $item->qty;
                // $totalK += $item->harga_sat 
            @endphp --}}
            @endforeach
        </tbody>

            <tr>
                <td colspan="3"></td>     
                <td>Total Bayar</td>
                <td><strong>Rp. {{ number_format($head->total_bayar) }}</strong></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Kembalian</td>
                <td> <strong>Rp. {{ number_format($item->kembalian) }}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
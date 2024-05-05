<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pemasokan Barang</title>
</head>
<body>
    <style onload="window.print()" onafterprint="window.location='{{ '/transaksiSelesai' }}'">
        body{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 0;
            margin: 0;

        }

        .title{
            margin-left: 30px;
        }

        tr td{
            padding: 5px;
        }

        .wrapper{
            /* background-color: red; */
            
        }
        .header{
            /* background-color: blue; */
            padding: 15px;
        }
        
        </style>

        <div class="wrapper">
            <div class="header">
                <h2 class="title">
                    Rekap Keseluruhan Data Restok "Toko Elin."
                </h2>
                <h4 class="title">
                    <table border="0">
                        <tr>
                            <td>Dicetak Oleh</td>
                            <td>: {{ Str::title(auth()->user()->name) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Cetak</td>
                            <td>: {{ $date }}</td>
                        </tr>
                    </table>
                </h4>
                <hr>
            </div>
        </div>
    
    <div class="form-group">
        

        <table border="1px" class="static" align="center" rules="all" style="width: 95%">
            <tr>
                <th>ID Pasok</th>
                <th>Supplier Tujuan</th>
                <th>Tanggal</th>
                <th>Uang Keluar</th>
                <th>Total Belanja</th>
                <th>Kembalian</th>
            </tr>
            @php
                $total = 0;
                // $totalK = 0;
            @endphp
            @foreach ($pasokAll as $item)
            <tr>
                <td>{{ $item->id_pasok }}</td>
                <td>{{ $item->supplier_tujuan }}</td>
                <td>{{ $item->tgl_transaksi }}</td>
                <td>Rp. {{ number_format($item->uang_keluar) }}</td>
                <td>Rp. {{ number_format($item->total_bayar) }}</td>
                <td>Rp. {{ number_format($item->kembalian) }}</td>
            </tr>
            @php
                // $total += $item->total_bayar;
                // $totalK += ($item->harga_satuan - $item->harga_grosir) * $item->qty;
                // $totalK += $item->harga_sat 
            @endphp
            @endforeach
            <tr align="center">
                <td colspan="3"></td>
               
                <td style="background: yellow">Total Pengeluaran</td>
                <td style="background: yellow; text-align: left;">Rp. {{ number_format($pengeluaran) }}</td>
            </tr>
            {{-- <tr>
                <td colspan="2">Keuntungan</td>
                <td>{{ number_format($totalK) }}</td>
            </tr> --}}
        </table>
    </div>
</body>
</html>
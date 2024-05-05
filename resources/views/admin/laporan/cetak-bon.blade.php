<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak : Laporan Bon</title>
</head>
<body onload="window.print()" onafterprint="window.location='{{ '/transaksiSelesai' }}'">
    <style>
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
                    Rekap Keseluruhan Data BON "Toko Elin."
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
            <thead>
                <tr>
                    <th>ID Bon</th>
                    <th>No. Trans</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>Sisa Bayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @php
                $totalPiutang = 0;
                // $totalK = 0;
            @endphp
            @foreach ($bon as $item)
            <tr>
                <td>{{ $item->id_bon }}</td>
                <td>{{ $item->no_transaksi }}</td>
                <td>{{ $item->tgl_transaksi }}</td>
                <td>{{ $item->nama_pembeli }}</td>
                <td>Rp. {{ number_format($item->sisa_bayar) }}</td>
                <td>{{ $item->status_pembayaran }}</td>
            </tr>
            @php
                $totalPiutang += $item->sisa_bayar;
                // $totalK += ($item->harga_satuan - $item->harga_grosir) * $item->qty;
                // $totalK += $item->harga_sat 
            @endphp
            @endforeach
        </tbody>

            {{-- <tr>
                <td colspan="3"></td>     
                <td>Total Piutang</td>
                <td>Rp. {{ number_format($total) }}</td>
            </tr> --}}
            <tr>
                
                <td colspan="3"></td>
                <td style="background: rgb(60, 196, 60)">Total Kekurangan</td>
                <td style="background: rgb(60, 196, 60);"> <strong>Rp. {{ number_format($totalPiutang) }}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
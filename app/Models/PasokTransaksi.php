<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasokTransaksi extends Model
{
    use HasFactory;
    protected $table = 'pasok_transaksi';
    
    protected $fillable = [
        'id_pasok',
        'id_supplier',
        'nama_supplier',
        'tgl_transaksi',
        'total_bayar',
        'uang_keluar',
        'kembalian'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


   
}

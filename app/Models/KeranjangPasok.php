<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangPasok extends Model
{
    use HasFactory;
    protected $table = 'keranjang_pasok';

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'harga_satuan',
        'qty',
        'subtotal'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}

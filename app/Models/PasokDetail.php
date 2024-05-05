<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasokDetail extends Model
{
    use HasFactory;
    protected $table = 'pasok_detail';

    protected $fillable = [
        'id_pasok',
        'id_barang',
        'nama_barang',
        'harga_grosir',
        'qty',
        'subtotal'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}

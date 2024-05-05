<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'databarang';

    protected $fillable = [
        'id_barang','id_jenis',  'nama_barang', 'harga_grosir', 'harga_satuan', 'stok'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function kodeBarang()
    {
        $model = $this->orderBy('id_barang', 'desc')->first();
        if ($model) {
            $numberFormat = $model->id_barang + 1;
        } else {
            $numberFormat = 1;
        }

        return $numberFormat;
    }
}

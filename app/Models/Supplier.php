<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Supplier extends Model
{
    use HasFactory;
    protected $table = 'data_supplier';
    protected $increments = false;

    protected $fillable = [
        'nama_supplier', 'alamat', 'no_tlp'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // public function autoNumberSupplier() {
    //     $num = $this->id;
    //     return 'SUP' . Str::padLeft($num++, 4, '0');
    // }
}

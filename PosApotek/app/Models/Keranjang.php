<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id','id')
                        ->withDefault(['produk_id' => 'Produk Belum Dipilih']);
    }
}

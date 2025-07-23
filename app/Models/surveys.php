<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class surveys extends Model
{
    protected $table = 'surveys';

    protected $fillable = [
        'nama', 'kualitas_produk', 'pelayanan', 'pengiriman','kemudahan_transaksi','harga_nilai','after_sales','kepuasan_umum','nps','saran'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keranjang extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_keranjang',
        'id_produk',
        'id_user',
        'jumlah_beli',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_keranjang';

    protected $table = 'keranjang';
}

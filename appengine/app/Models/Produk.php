<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_produk',
        'id_supplier',
        'id_kategori',
        'nama_produk',
        'foto_produk',
        'harga',
        'stok',
        'diskon',
        'deskripsi_produk',
        'manfaat_produk',
        'cara_penyimpanan',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_produk';
    protected $dates = ['deleted_at'];

    protected $table = 'produk';
}

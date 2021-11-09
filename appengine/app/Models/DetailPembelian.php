<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPembelian extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_detail_pembelian',
        'id_pembelian',
        'id_produk',
        'jumlah_beli',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_detail_transaksi';
    protected $dates = ['deleted_at'];

    protected $table = 'detail_pembelian';
}

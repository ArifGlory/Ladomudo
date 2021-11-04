<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'total_harga',
        'bukti_bayar',
        'status_transaksi',
        'tanggal_kirim',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_transaksi';
    protected $dates = ['deleted_at'];

    protected $table = 'transaksi';
}

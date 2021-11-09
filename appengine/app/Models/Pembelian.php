<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_pembelian',
        'total_harga',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_pembelian';
    protected $dates = ['deleted_at'];

    protected $table = 'pembelian';
}

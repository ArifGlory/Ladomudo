<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UlasanRating extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_ulasan',
        'id_produk',
        'id_user',
        'ulasan',
        'rating',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_keranjang';

    protected $table = 'ulasan_rating';
}

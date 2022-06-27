<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ongkir extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_kota',
        'ongkir',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id';

    protected $table = 'ongkir';
}

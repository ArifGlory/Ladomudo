<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'deskripsi_kategori',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_kategori';
    protected $dates = ['deleted_at'];

    protected $table = 'kategori';
}

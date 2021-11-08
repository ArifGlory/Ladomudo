<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_supplier',
        'nama_supplier',
        'alamat_supplier',
        'phone_supplier',
        'foto_supplier',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_supplier';
    protected $dates = ['deleted_at'];

    protected $table = 'supplier';
}

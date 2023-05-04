<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Level extends Model
{
    use HasApiTokens, SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_levels';

    // @var array
    protected $fillable = [
        'encrypt_id', 'difficulty', 'name'
    ];

    // @var array
    protected $hidden = [
        'id', 'deleted_at'
    ];
}

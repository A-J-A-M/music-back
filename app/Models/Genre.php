<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Genre extends Model
{
    use HasApiTokens, SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_genres';

    // @var array
    protected $fillable = [
        'encrypt_id', 'name'
    ];

    // @var array
    protected $hidden = [
        'id', 'deleted_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens, SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_admins';
}

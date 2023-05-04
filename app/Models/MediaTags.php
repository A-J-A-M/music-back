<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MediaTags extends Model
{
    use HasApiTokens;

    protected $table = 't_media_tags';

    // @var array
    protected $fillable = [
        'tag_id', 'media_id'
    ];

    // @var array
    protected $hidden = [
        'id', 'deleted_at'
    ];
}

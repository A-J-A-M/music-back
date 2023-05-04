<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Media extends Model
{
    use HasApiTokens;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_media';

     // @var array
     protected $fillable = [
        'encrypt_id', 'title', 'url', 'outside', 'description', 'type_id', 'level_id', 'admin_id', 'genre_id'
    ];

    // @var array
    protected $hidden = [
        'id', 'deleted_at'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 't_media_tags');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'path',
        'status',
        'created_at',
        'updated_at',
    ];

    public function detail()
    {
        return $this->hasOne(PhotoDetails::class, 'photo_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'photo_id');

    }



}

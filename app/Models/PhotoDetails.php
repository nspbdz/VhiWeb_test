<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'photo_id',
        'caption',
        'tags',
        'created_at',
        'updated_at',
    ];
}

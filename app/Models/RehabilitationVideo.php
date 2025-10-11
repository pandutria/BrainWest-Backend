<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RehabilitationVideo extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'rehabilitation_id',
        'title',
        'thumbnail',
        'link',
        'text'
    ];
}

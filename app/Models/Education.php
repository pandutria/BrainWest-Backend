<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        "title",
        "thumbnail",
        "desc",
        "text",
        "link",
        "category",
    ];
}

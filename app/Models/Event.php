<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Event extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "events";
    protected $fillable = [
        "title",
        "image",
        "desc",
        "date",
        "timestamp",
        "address",
        "price",
        "city"
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    //
     use HasFactory, Notifiable;

      protected $fillable = [
        "specialization",
        "hospital",
        "rating",
        "image",
        "experience",
        "user",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

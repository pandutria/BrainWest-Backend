<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationChatHistories extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'last_message',
        'last_message_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

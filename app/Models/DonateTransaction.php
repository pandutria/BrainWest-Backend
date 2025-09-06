<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DonateTransaction extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "donate_transactions";
    protected $fillable = [
        "user_id",
        "donate_id",
        "total_donate"
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donate()
    {
        return $this->belongsTo(Donate::class, 'donate_id');
    }
}

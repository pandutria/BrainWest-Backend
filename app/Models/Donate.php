<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Donate extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "donates";
    protected $fillable = [
        "title",
        "image",
        "desc",
        "target",
        "institution",
        "image_institution",
        "date",
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_donate()
    {
        return $this->hasMany(DonateTransaction::class, 'donate_id');
    }
}

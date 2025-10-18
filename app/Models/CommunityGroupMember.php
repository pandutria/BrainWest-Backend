<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommunityGroupMember extends Model
{
    //
    use HasFactory, Notifiable;
    protected $fillable = [
        'group_id',
        'user_id'
    ];

    public function group()
    {
        return $this->belongsTo(CommunityGroup::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

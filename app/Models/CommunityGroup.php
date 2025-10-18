<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommunityGroup extends Model
{
    //
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'description',
        'image_logo',
        'image',
        'admin_id'
    ];

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function members() {
        return $this->belongsToMany(User::class, 'community_group_members', 'group_id', 'user_id')
                ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(CommunityGroupMessage::class, 'group_id');
    }


}

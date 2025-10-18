<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventTransaction()
    {
        return $this->hasMany(EventTransaction::class, 'user_id');
    }

    public function communities() {
        return $this->hasMany(CommunityGroup::class, 'admin_id');
    }

    public function joinedCommunities()
    {
        return $this->belongsToMany(CommunityGroup::class, 'community_group_members', 'user_id', 'group_id')
                ->withTimestamps();
    }

    public function groupMemberships()
    {
        return $this->hasMany(CommunityGroupMember::class, 'user_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(CommunityGroupMessage::class, 'sender_id');
    }

}

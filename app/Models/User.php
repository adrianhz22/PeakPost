<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    public function scopeFilter($query, $filters)
    {

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['days'])) {
            $query->where('created_at', '>=', now()->subDays($filters['days']));
        }

        if (!empty($filters['role'])) {
            $query->role($filters['role']);
        }

        return $query;
    }

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function galleryImages(): hasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)->withPivot('achieved_at')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function follow(User $user)
    {
        if (!$this->isFollowing($user)) {
            $this->following()->attach($user->id);
        }
    }

    public function unfollow(User $user)
    {
        $this->following()->detach($user->id);
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likeable_likes', 'user_id', 'likeable_id')
            ->where('likeable_type', Post::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public function getRouteKeyName()
    {
        return 'username';
    }

    protected $fillable = [
        'name',
        'last_name',
        'username',
        'email',
        'password',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

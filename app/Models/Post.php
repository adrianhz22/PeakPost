<?php

namespace App\Models;

use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use hasFactory, Likeable;

    public function scopeSearch($query, $search, $sort = 'desc')
    {
        $query->where('status', 'approved');

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        if ($sort === 'popular') {
            return $query
                ->withCount('likes')
                ->orderBy('likes_count', 'desc');
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function scopeFromProvince($query, $province)
    {
        if ($province) {
            return $query->where('province', $province);
        }

        return $query;
    }

    public function scopeFromDifficulty($query, $difficulty)
    {
        if ($difficulty) {
            return $query->where('difficulty', $difficulty);
        }

        return $query;
    }

    public function user() : belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'province',
        'difficulty',
        'longitude',
        'altitude',
        'time',
        'track',
        'user_id',
        'status',
        'reject_reason',
    ];
}

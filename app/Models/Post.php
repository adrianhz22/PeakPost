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

    public function scopeSearch($query, $search = null, $sort = 'desc', $province = null, $difficulty = null)
    {

        $query->where('status', 'approved');

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        if ($province) {
            $query->where('province', $province);
        }

        if ($difficulty) {
            $query->where('difficulty', $difficulty);
        }

        if ($sort === 'popular') {
            return $query->withCount('likes')->orderBy('likes_count', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
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
        'duration',
        'track',
        'user_id',
        'status',
        'rejection_reason',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'user_id',
        'path',
        'title',
        'status',
        'reject_reason',
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

}

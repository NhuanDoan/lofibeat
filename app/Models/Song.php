<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug', 
        'artist_id', 
        'category_id', 
        'file_url', 
        'cover_image', 
        'duration_seconds', 
        'is_active', 
        'view_count'
    ];
    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class, 'playlist_songs')->withPivot('added_at');
    }
}

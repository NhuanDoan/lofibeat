<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug', 
        'bio', 
        'image_url'
    ];
    public function songs() {
        return $this->hasMany(Song::class);
    }
}

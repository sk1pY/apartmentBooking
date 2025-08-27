<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarkFactory> */
    use HasFactory;
    protected $table = 'bookmarks';
    protected $fillable = ['apartment_id', 'user_id'];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}


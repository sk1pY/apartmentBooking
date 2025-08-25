<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'apartment_id',
        'date_start',
        'date_end',
    ];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}

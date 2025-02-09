<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'phone', 'email', 'city', 'address', 'profile_image_url'];

    public function user()
    {
        return $this->belongsTo(User::class); // Salon pripada korisniku
    }
}
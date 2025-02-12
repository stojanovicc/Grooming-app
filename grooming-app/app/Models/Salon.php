<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'phone', 'email', 'city', 'address', 'area', 'profile_image_url'];

    public function user()
    {
        return $this->hasOne(Salon::class, 'user_id'); // Salon pripada korisniku
    }

    public function services()
    {
        return $this->hasMany(Service::class); // Salona ima vise usluga
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // Salon ima vise recenzija
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
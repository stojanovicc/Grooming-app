<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['salon_id', 'name', 'price', 'duration'];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}
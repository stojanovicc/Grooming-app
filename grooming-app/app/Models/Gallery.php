<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['salon_id', 'image_path'];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}

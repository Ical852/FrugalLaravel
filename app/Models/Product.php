<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function vendor() {  
        return $this->belongsTo(Vendor::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }

    public function whistlist() {
        return $this->hasMany(Whistlist::class);
    }
}

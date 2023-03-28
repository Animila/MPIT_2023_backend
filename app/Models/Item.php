<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'countPeople', 'price', 'base_id'];

    public function base() {
        return $this->belongsTo(Base::class);
    }
    public function bonuses() {
        return $this->hasMany(Bonus::class);
    }
}

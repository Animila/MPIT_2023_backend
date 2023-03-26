<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'longitude', 'latitude'];

    public function services() {
        return $this->hasMany(Item::class);
    }

}

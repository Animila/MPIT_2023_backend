<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['id_base', 'id_user', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cultureBase()
    {
        return $this->belongsTo(Base::class, 'id_base');
    }
}

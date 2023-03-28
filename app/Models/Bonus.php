<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'count', 'type'];
    public function service() {
        return $this->belongsTo(Item::class);
    }

}

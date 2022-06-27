<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destiny extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function flight()
    {
        return $this->hasMany(Flight::class);
    }
}

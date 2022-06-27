<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'departure_date'
    ];

    protected $with = [
        'airplane',
        'destiny'
    ];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class);
    }
}

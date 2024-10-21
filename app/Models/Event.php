<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function trainings(): HasMany {
        return $this->hasMany(Training::class);
    }

    public function eventDetails(): HasMany {
        return $this->hasMany(EventDetail::class);
    }

    public function meets(): HasMany {
        return $this->hasMany(Meet::class);
    }
}

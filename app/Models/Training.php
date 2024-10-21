<?php

namespace App\Models;

use App\Models\EventPermission;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Pivot
{
    use HasFactory;

    public function event(): BelongsTo {
        return $this->belongsTo(Event::class);
    }
    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class);
    }

    public function groups(): HasMany {
        return $this->hasMany(Group::class);
    }

    public function trainingDetails(): HasMany {
        return $this->hasMany(TrainingDetail::class);
    }
}

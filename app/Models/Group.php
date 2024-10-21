<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    
    public function training(): BelongsTo {
        return $this->belongsTo(Training::class);
    }

    public function groupDetails(): HasMany {
        return $this->hasMany(GroupDetail::class);
    }
}

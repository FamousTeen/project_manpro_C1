<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function trainingDetails(): HasMany {
        return $this->hasMany(TrainingDetail::class, 'group_id', 'id');
    }
    
    
    public function groupDetails(): HasMany {
        return $this->hasMany(GroupDetail::class);
    }
}

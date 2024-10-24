<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Misa extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'category', 'activity_datetime', 'upload_datetime', 'evaluation', 'status'];

    public function misaDetails(): HasMany
    {
        return $this->hasMany(Misa_Detail::class);
    }
}

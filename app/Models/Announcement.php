<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    public function announcementDetails(): HasMany {
        return $this->hasMany(Template::class);
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    public function misaPermissions(): HasMany {
        return $this->hasMany(MisaPermission::class);
    }

    public function eventPermissions(): HasMany {
        return $this->hasMany(EventPermission::class);
    }

    public function trainings(): HasMany {
        return $this->hasMany(Training::class);
    }

    public function templates(): HasMany {
        return $this->hasMany(Template::class);
    }

    public function announcements(): HasMany {
        return $this->hasMany(Announcement::class);
    }
}

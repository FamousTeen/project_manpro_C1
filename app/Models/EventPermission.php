<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventPermission extends Pivot
{
    use HasFactory;

    public function eventDetail(): BelongsTo {
        return $this->belongsTo(EventDetail::class);
    }
    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class);
    }
}

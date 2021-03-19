<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class BadgeUser extends Pivot
{
    use SoftDeletes;

    protected $table = 'badge_user';

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }
}

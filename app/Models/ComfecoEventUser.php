<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComfecoEventUser extends Pivot
{
    use SoftDeletes;

    protected $table = 'comfeco_event_user';

    public function comfecoEvent()
    {
        return $this->belongsTo(ComfecoEvent::class, 'comfeco_event_id');
    }
}

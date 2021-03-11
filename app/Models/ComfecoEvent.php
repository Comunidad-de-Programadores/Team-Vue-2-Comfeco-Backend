<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComfecoEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('already_registered');
    }
}

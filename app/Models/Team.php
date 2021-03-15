<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }
}

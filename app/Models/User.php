<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            $roles = explode(" ", $roles);
        }

        if ($this->roles()->whereIn('code', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class)
                    ->using(BadgeUser::class);
    }

    public function comfecoEvents()
    {
        return $this->belongsToMany(ComfecoEvent::class)
                    ->withPivot('already_registered')
                    ->using(ComfecoEventUser::class);
    }

    public function userActivities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}

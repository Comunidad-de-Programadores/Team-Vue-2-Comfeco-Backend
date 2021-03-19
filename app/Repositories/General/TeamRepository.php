<?php

namespace App\Repositories\General;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamRepository
{
    public function getTeams()
    {
        $teams = Team::with('technology')
        ->withCount('members')
        ->get();

        return $teams;
    }

    public function getCurrentTeam()
    {
        $team = Auth::user()->team()->with('members')->first();

        return $team;
    }

    public function assignTeam(Team $team)
    {
        $user = Auth::user();
        return $user->team()->associate($team)->save();
    }

    public function leaveTeam(Team $team)
    {
        $user = Auth::user();
        return $user->team()->disassociate($team)->save();
    }
}

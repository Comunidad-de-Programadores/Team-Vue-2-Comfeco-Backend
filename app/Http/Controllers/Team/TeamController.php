<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\CustomController;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Repositories\General\TeamRepository;
use Illuminate\Support\Facades\Auth;

class TeamController extends CustomController
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        parent::__construct();
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $teams = $this->teamRepository->getTeams();
        return response()->json(['teams' => $teams], $this->successStatus);
    }
    public function currentTeam()
    {
        $team = $this->teamRepository->getCurrentTeam();
        return response()->json(['team' => $team], $this->successStatus);
    }

    public function joinTeam($id)
    {
        $team = Team::find($id);
        $currentTeam = $this->teamRepository->getCurrentTeam();
        if($currentTeam) {
            // abort
        }

        $this->teamRepository->assignTeam($team);
        $user = Auth::user()->with('team')->first();
        $team = $this->teamRepository->getCurrentTeam();
        return response()->json(['user' => $user, 'team' => $team], $this->successStatus);
    }

    public function leaveTeam()
    {
        $currentTeam = $this->teamRepository->getCurrentTeam();
        $this->teamRepository->leaveTeam($currentTeam);
        $user = Auth::user()->with('team', 'team.members');
        return response()->json(['user' => $user], $this->successStatus);
    }
}

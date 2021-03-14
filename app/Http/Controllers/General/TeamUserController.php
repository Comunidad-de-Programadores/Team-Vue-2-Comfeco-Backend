<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\TeamRepository;
use App\Http\Requests\General\TeamRequest;

class TeamUserController extends CustomController
{
    protected $teamUserRepository;

    public function __construct(TeamRepository $teamUserRepository)
    {
        parent::__construct();
        $this->teamUserRepository = $teamUserRepository;
    }

    public function getListAssigned()
    {
        $records = $this->teamUserRepository->getListAssigned(request()->user());
        return response()->json(['records' => $records], $this->successStatus);
    }

    public function store(TeamRequest $teamRequest)
    {
        $fields = request([
            'name',
            'description',
            'image_url'
        ]);

        try {
            $teamCreated = $this->teamUserRepository->store($fields);

            $response = [
                "error" => false,
                "team" => $teamCreated
            ];

            return response()->json($response, $this->successStatus);
        } catch (\Throwable $th) {

            $response['error'] = true;
            $response['errors'] = $th->getMessage();

            return response()->json($response, $this->errorStatus);
        }
    }

    public function updateTeam( TeamRequest $teamRequest )
    {
        $data = request()->only([
            'name',
            'description',
            'image_url',
            'id'
        ]);

        $user = request()->team();
    }

}

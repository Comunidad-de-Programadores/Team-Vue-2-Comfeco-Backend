<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\BadgeUserRepository;
use App\Http\Requests\General\BadgeRequest;

class BadgeUserController extends CustomController
{
    protected $badgeUserRepository;

    public function __construct(BadgeUserRepository $badgeUserRepository)
    {
        parent::__construct();
        $this->badgeUserRepository = $badgeUserRepository;
    }

    public function getListAssigned()
    {
        $records = $this->badgeUserRepository->getListAssigned(request()->user());
        return response()->json(['records' => $records], $this->successStatus);
    }

    public function store(BadgeRequest $badgeRequest)
    {
        $fields = request([
            'name',
            'description',
            'image_url'
        ]);

        try {          
            $badgeCreated = $this->badgeUserRepository->store($fields);

            $response = [
                "error" => false,
                "badge" => $badgeCreated
            ];

            return response()->json($response, $this->successStatus);
        } catch (\Throwable $th) {

            $response['error'] = true;
            $response['errors'] = $th->getMessage();

            return response()->json($response, $this->errorStatus);
        }
    }

    public function updateBadge( BadgeRequest $badgeRequest )
    {
        $data = request()->only([
            'name', 
            'description', 
            'image_url',
            'id'
        ]);

        $user = request()->badge();
    }
    
}

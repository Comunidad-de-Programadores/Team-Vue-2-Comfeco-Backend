<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\MentorRepository;

class MentorController extends CustomController
{
    protected $mentorRepository;

    public function __construct(MentorRepository $mentorRepository)
    {
        parent::__construct();
        $this->mentorRepository = $mentorRepository;
    }

    public function list()
    {
        $records = $this->mentorRepository->list();
        return response()->json(['records' => $records], $this->successStatus);
    }
}

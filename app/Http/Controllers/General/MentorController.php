<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\MentorRepository;

class MentorController extends Controller
{
    protected $mentorRepository;

    public function __construct(MentorRepository $mentorRepository)
    {
        $this->mentorRepository = $mentorRepository;
    }

    public function list()
    {
        $records = $this->mentorRepository->list();
        return response()->json(['records' => $records], 200);
    }
}

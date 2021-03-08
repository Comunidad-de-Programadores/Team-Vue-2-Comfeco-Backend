<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomController extends Controller
{
    public $successStatus;
    public $errorStatus;

    public function __construct()
    {
        $this->successStatus = config('response_values')['successStatus'];
        $this->errorStatus = config('response_values')['errorStatus'];
    }
}
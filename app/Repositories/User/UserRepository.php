<?php

namespace App\Repositories\User;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{
    public function getUserActualConnected($id) {
        return User::where('id', $id)->first();
    }
}

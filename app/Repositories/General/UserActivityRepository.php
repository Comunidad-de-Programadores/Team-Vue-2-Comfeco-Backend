<?php

namespace App\Repositories\General;

use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;

class UserActivityRepository
{
    public function listByUser($userId)
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $records = UserActivity::selectRaw("
                            id,
                            activity,
                            CASE WHEN image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',image_url)
                            END as image_url
                        ")
                        ->where('user_id', $userId)
                        ->orderBy('id', 'desc')
                        ->get();

        return $records;
    }

    public function store($data, $user_id)
    {
        try {
            $userActivity = new UserActivity;
                $userActivity->user_id = $user_id;
                $userActivity->activity = $data['activity'];
            $userActivity->save();

            //Probe con DB::insert y nada xD
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

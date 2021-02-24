<?php

namespace App\Repositories\General;

use Illuminate\Support\Facades\DB;
use App\Models\Mentor;

class MentorRepository
{
    public function list()
    {
        $assetUrl = asset('');
        DB::statement(DB::raw("SET @assetUrl = '${assetUrl}'"));
        $records = Mentor::select(
                    'id', 
                    'name', 
                    'master_on', 
                    DB::raw("CASE WHEN master_on_image IS NULL 
                        THEN ''
                    ELSE
                        CONCAT(@assetUrl,master_on_image)
                    END as master_on_image"),
                    DB::raw("CASE WHEN image_url IS NULL 
                        THEN ''
                    ELSE
                        CONCAT(@assetUrl,image_url)
                    END as image_url"),
                    'order'
                )->orderBy('order')
                ->get();

        return $records;
    }
}

<?php

namespace App\Repositories\General;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;
use App\Traits\FileMethods;

class BadgeUserRepository
{
    use FileMethods;

    public function getListAssigned($user)
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $badgesAssigned = $user->badges()
                            ->selectRaw("
                                badges.id,
                                badges.name,
                                CASE WHEN badges.image_url IS NULL 
                                    THEN ''
                                ELSE
                                    CONCAT(@storageUrl,'/',badges.image_url)
                                END as image_url,
                                description
                            ")
                            ->get();

        return $badgesAssigned;
    }

    public function store($badge){
        $image = $badge['image_url'];
        unset($badge['image_url']);

        $newBadge = Badge::create($badge);

        if (isset($image) && !is_null($image)) {
            $file = $image;
            if (strpos($file, 'base64') !== false) {
                @list($type, $file) = explode(';', $file);
                @list(, $file) = explode(',', $file);
                if ($file) {
                    $file = base64_decode($file);
                    $this->manageFile64($newBadge, $file, 'image_url', 'public', 'badges');
                }
            }
        }

        return $newBadge;
    }
}

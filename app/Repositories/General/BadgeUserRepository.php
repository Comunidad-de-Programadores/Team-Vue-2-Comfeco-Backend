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

        $badgesAssigned = DB::table('badges')
        ->leftJoin('badge_user', function ($join) use ($user) {
            $join->on('badges.id', '=', 'badge_user.badge_id')
                ->where('badge_user.user_id', '=', $user->id);
        })
        ->selectRaw("
            badges.id,
            badges.name,
            CASE WHEN badges.image_url IS NULL 
                THEN ''
            ELSE
                CONCAT(@storageUrl,'/',badges.image_url)
            END as image_url,
            badges.description,
            badges.how_win,
            case when badge_user.id is null then false 
            else true end as have_badge        
        ")->get();

        return $badgesAssigned;
    }

    public function store($badge)
    {
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

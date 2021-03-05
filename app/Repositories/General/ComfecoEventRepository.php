<?php

namespace App\Repositories\General;

use App\Models\ComfecoEvent;
use Illuminate\Support\Facades\DB;

class ComfecoEventRepository
{
    public function list()
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $records = ComfecoEvent::selectRaw("
                            id,
                            name,
                            CASE WHEN portrait_image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',portrait_image_url)
                            END as portrait_image_url,
                            CASE WHEN background_image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',background_image_url)
                            END as background_image_url,
                            start,
                            end,
                            content,
                            participants,
                            meeting_url,
                            external_url,
                            `order`
                        ")
                        ->whereIsVisible(1)
                        ->get();

        return $records;
    }

    public function listByUser($userId)
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $records = ComfecoEvent::selectRaw("
                            id,
                            name,
                            CASE WHEN portrait_image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',portrait_image_url)
                            END as portrait_image_url,
                            CASE WHEN background_image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',background_image_url)
                            END as background_image_url,
                            start,
                            end,
                            content,
                            participants,
                            meeting_url,
                            external_url,
                            `order`
                        ")
                        ->whereIsVisible(1)
                        ->whereHas('users', function ($query) use ($userId) {
                            $query->whereIn('users.id', [$userId]);
                        })
                        ->get();

        return $records;
    }

    public function findById($comfecoEventId)
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $model = ComfecoEvent::where('id', $comfecoEventId)
                        ->selectRaw("
                            id,
                            name,
                            CASE WHEN portrait_image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',portrait_image_url)
                            END as portrait_image_url,
                            CASE WHEN background_image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',background_image_url)
                            END as background_image_url,
                            start,
                            end,
                            content,
                            participants,
                            meeting_url,
                            external_url,
                            `order`
                        ")
                        ->whereIsVisible(1)
                        ->first();
                        
        return $model;
    }

    public function checkIsAttach($user, $comfecoEventId)
    {
        $comfectoEvent = $user->comfecoEvents()->where('comfeco_events.id', $comfecoEventId)->first();
        return !is_null($comfectoEvent);
    }

    public function attachEventToUser($user, $comfecoEventId)
    {
        $user->comfecoEvents()->attach($comfecoEventId);
    }

    public function detachEventToUser($user, $comfecoEventId)
    {
        $user->comfecoEvents()->detach($comfecoEventId);
    }
}

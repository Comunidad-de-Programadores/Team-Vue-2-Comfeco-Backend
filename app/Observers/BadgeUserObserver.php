<?php

namespace App\Observers;

use App\Models\BadgeUser;
use App\Repositories\General\UserActivityRepository;

class BadgeUserObserver
{
    protected $userActivityRepository;
    public function __construct(UserActivityRepository $userActivityRepository)
    {
        $this->userActivityRepository = $userActivityRepository;
    }
    /**
     * Handle the BadgeUser "created" event.
     *
     * @param  \App\Models\BadgeUser  $badgeUser
     * @return void
     */
    public function created(BadgeUser $badgeUser)
    {
        $data = $this->prepareData($badgeUser);
        $this->userActivityRepository->store($data);
    }

    /**
     * Handle the BadgeUser "updated" event.
     *
     * @param  \App\Models\BadgeUser  $badgeUser
     * @return void
     */
    public function updated(BadgeUser $badgeUser)
    {
        //
    }

    /**
     * Handle the BadgeUser "deleted" event.
     *
     * @param  \App\Models\BadgeUser  $badgeUser
     * @return void
     */
    public function deleted(BadgeUser $badgeUser)
    {
        //
    }

    /**
     * Handle the BadgeUser "restored" event.
     *
     * @param  \App\Models\BadgeUser  $badgeUser
     * @return void
     */
    public function restored(BadgeUser $badgeUser)
    {
        //
    }

    /**
     * Handle the BadgeUser "force deleted" event.
     *
     * @param  \App\Models\BadgeUser  $badgeUser
     * @return void
     */
    public function forceDeleted(BadgeUser $badgeUser)
    {
        //
    }

    public function prepareData(BadgeUser $badgeUser)
    {
        $badge = $badgeUser->badge()->first();
        return [
            "user_id" => $badgeUser->user_id,
            "activity" => 'Gano la insignia ' . $badge->name
        ];
    }
}

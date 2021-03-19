<?php

namespace App\Observers;

use App\Models\ComfecoEventUser;
use App\Repositories\General\UserActivityRepository;

class ComfecoEventUserObserver
{
    protected $userActivityRepository;
    public function __construct(UserActivityRepository $userActivityRepository)
    {
        $this->userActivityRepository = $userActivityRepository;
    }
    /**
     * Handle the ComfecoEventuser "created" event.
     *
     * @param  \App\Models\ComfecoEventUser  $comfecoEventUser
     * @return void
     */
    public function created(ComfecoEventUser $comfecoEventUser)
    {
        $data = $this->prepareData($comfecoEventUser);
        $this->userActivityRepository->store($data);
    }

    /**
     * Handle the ComfecoEventUser "updated" event.
     *
     * @param  \App\Models\ComfecoEventUser  $comfecoEventUser
     * @return void
     */
    public function updated(ComfecoEventUser $comfecoEventUser)
    {
        $data = $this->prepareData($comfecoEventUser);
        $this->userActivityRepository->store($data);
    }

    /**
     * Handle the ComfecoEventUser "deleted" event.
     *
     * @param  \App\Models\ComfecoEventUser  $comfecoEventUser
     * @return void
     */
    public function deleted(ComfecoEventUser $comfecoEventUser)
    {
        //
    }

    /**
     * Handle the ComfecoEventUser "restored" event.
     *
     * @param  \App\Models\ComfecoEventUser  $comfecoEventUser
     * @return void
     */
    public function restored(ComfecoEventUser $comfecoEventUser)
    {
        //
    }

    /**
     * Handle the ComfecoEventUser "force deleted" event.
     *
     * @param  \App\Models\ComfecoEventUser  $comfecoEventUser
     * @return void
     */
    public function forceDeleted(ComfecoEventUser $comfecoEventUser)
    {
        //
    }

    public function prepareData(ComfecoEventUser $comfecoEventUser)
    {
        $event = $comfecoEventUser->comfecoEvent()->first();
        return [
            "user_id" => $comfecoEventUser->user_id,
            "activity" => $comfecoEventUser->already_registered === 0 ? ('Se inscribió al evento ' . $event->name)  : ('Abandonó el evento ' .$event->name)
        ];
    }
}

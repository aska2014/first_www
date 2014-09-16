<?php

use Cane\Models\Social\Notification;

class NotificationController extends BaseController {

    /**
     * @param Notification $notifications
     * @param Cane\UserSession $userSession
     */
    public function __construct(Notification $notifications, \Cane\UserSession $userSession)
    {
        $this->notifications = $notifications;
        $this->userSession = $userSession;
    }

    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $query = $this->notifications;

        if(Input::has('newer_than')) {

            $query = $query->newerThan(Input::get('newer_than'));
        }

        return $query->get();
    }
}
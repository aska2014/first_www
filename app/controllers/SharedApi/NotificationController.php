<?php namespace SharedApi;


use Aska\Membership\Auth\SessionUser;
use Aska\Social\Models\Notification;
use BaseController;
use Input;

class NotificationController extends BaseController {

    /**
     * @param Notification $notifications
     * @param SessionUser $sessionUser
     */
    public function __construct(Notification $notifications, SessionUser $sessionUser)
    {
        $this->notifications = $notifications;
        $this->sessionUser = $sessionUser;
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
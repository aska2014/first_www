<?php

use Company\Project;
use Membership\User;
use Social\Notification;

class NotificationController extends APIController {

    /**
     * @param Notification $notifications
     * @param Membership\User $users
     */
    public function __construct(Notification $notifications, \Membership\User $users)
    {
        $this->notifications = $notifications;
        $this->users = $users;
    }

    /**
     * Get new notifications
     */
    public function getNew()
    {
        $last_online = $this->me()->online_at;

        return $this->notifications->newerThan($last_online)->get();
    }

    /**
     * Notify all registered users except me
     *
     * @return static
     */
    public function notifyAll()
    {
        $allUsers = $this->users->except($this->me())->get();

        $this->notifications->newInstance(Input::all())
            ->notifyUsers($allUsers);
    }

    /**
     * Notify all project users except me
     *
     * @param Project $project
     */
    public function notifyProjectUsers(Project $project)
    {
        $me = $this->me();

        // Get all project users except me
        $allUsers = $project->users->filter(function(User $user) use($me)
        {
            return !$user->compare($me);
        });

        $this->notifications->newInstance(Input::all())
            ->notifyUsers($allUsers);
    }
}
<?php

use Aska\Site\Models\CompanyBranch;
use Aska\Site\Models\ContactEmail;

class ContactUsController extends BaseController {

    /**
     * @param CompanyBranch $branches
     * @param Aska\Site\Models\ContactEmail $contactEmails
     */
    public function __construct(CompanyBranch $branches, ContactEmail $contactEmails)
    {
        $this->branches = $branches;
        $this->contactEmails = $contactEmails;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $branches = $this->branches->all();

        $locations = [];

        foreach($branches as $branch)
        {
            if($branch->gps_latitude && $branch->gps_longitude) {

                $location = new stdClass();

                $location->id = $branch->id;
                $location->latitude = $branch->gps_latitude;
                $location->longitude = $branch->gps_longitude;

                $locations[] = $location;
            }
        }


        $map = new stdClass();

        $map->locations = $locations;
        $map->center = $location;

        return View::make('contact.index')->with('map', $map)->with('branches', $branches);
    }


    /**
     * Send message to all registered emails
     */
    public function send()
    {
        $allEmails = $this->contactEmails->all();

        $inputs = Input::all();

        foreach($allEmails as $email) {

            Mail::send('emails.contact', compact('inputs'), function($mail) use($email)
            {
                $mail->to($email, 'FirstChoice administrator')->subject('Message from FirstChoice');
            });
        }
    }
}
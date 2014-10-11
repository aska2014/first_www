<?php

use Aska\Site\Models\CompanyBranch;

class ContactUsController extends BaseController {

    /**
     * @var CompanyBranch
     */
    protected $branches;

    /**
     * @param CompanyBranch $branches
     */
    public function __construct(CompanyBranch $branches)
    {
        $this->branches = $branches;
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
}
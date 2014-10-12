<?php namespace Aska\composers;

use Aska\Media\Models\Image;
use Aska\Site\Models\ContactDetail;
use Aska\Site\Models\Service;
use Twitter;

class FooterComposer {

    /**
     * @param Image $images
     * @param \Aska\Site\Models\Service $services
     * @param \Aska\Site\Models\ContactDetail $contactDetails
     */
    public function __construct(Image $images, Service $services, ContactDetail $contactDetails)
    {
        $this->images = $images;
        $this->services = $services;
        $this->contactDetails = $contactDetails;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('productImages', $this->images->byProducts()->take(8)->get());

        $view->with('footerServices', $this->services->take(2)->get());

        $view->with('contactDetails', $this->contactDetails->first());


        // We don't need to get tweets on loca environment
        if(\App::environment() != 'local') {
            $view->with('tweets', $this->getTweets());
        }
    }

    /**
     * @return mixed
     */
    protected function getTweets()
    {
        return Twitter::getUserTimeline(array('screen_name' => 'First_Choice_CO', 'count' => 5));
    }

} 
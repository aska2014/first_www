<?php

use Aska\Site\Models\Service;
use Aska\Site\Models\ServiceCategory;

class ServicesController extends BaseController {

    /**
     * @param ServiceCategory $serviceCategories
     * @param Service $services
     */
    public function __construct(ServiceCategory $serviceCategories, Service $services)
    {
        $this->serviceCategories = $serviceCategories;
        $this->services = $services;
    }

    /**
     * Display all products along with a filter by category
     */
    public function index()
    {
        $this->setPage('services');

        return View::make('services.index')
            ->with('serviceCategories', $this->serviceCategories->all())
            ->with('services', $this->services->all());
    }

    /**
     * @param $slug
     */
    public function category($slug)
    {
        return $this->index()->with('selectedCategory', $this->serviceCategories->bySlug($slug)->first());
    }

    /**
     * @param $slug
     */
    public function show($slug)
    {
        return View::make('service.index')
            ->with('service', $this->services->bySlug($slug)->first());
    }

} 
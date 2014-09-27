<?php namespace SiteApi;

use Aska\Site\Models\Service;
use Aska\Site\Permissions\ServicePermission;
use BaseController;
use Input;

class ServiceController extends BaseController {

    /**
     * @param Service $services
     * @param ServicePermission $servicePermission
     */
    public function __construct(Service $services, ServicePermission $servicePermission)
    {
        $this->services = $services;
        $this->servicePermission = $servicePermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->services->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->servicePermission->canCreate()) {

            $this->forbidden("You can't create service");
        }

        $this->validateOrFail($data = Input::all(), $this->services->rules());

        return $this->services->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function show(Service $service)
    {
        return $service->load('images');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Service $service
     * @return Response
     */
    public function update(Service $service)
    {
        if(! $this->servicePermission->canUpdate($service)) {

            $this->forbidden("You can't update this service");
        }

        $this->validateOrFail($data = Input::all(), $service->rules());

        $service->update(Input::all());

        return $service;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return Response
     */
    public function destroy(Service $service)
    {
        if(! $this->servicePermission->canDelete($service)) {

            $this->forbidden("You can't delete this service");
        }

        $service->delete();

        return Response::make(['message' => 'Service deleted successfully']);
    }


}

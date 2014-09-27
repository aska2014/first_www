<?php namespace SiteApi;

use Aska\Site\Models\ServiceCategory;
use Aska\Site\Permissions\ServiceCategoryPermission;
use BaseController;
use Response, Input;

class ServiceCategoryController extends BaseController {

    /**
     * @param ServiceCategory $serviceCategories
     * @param ServiceCategoryPermission $serviceCategoryPermission
     */
    public function __construct(ServiceCategory $serviceCategories, ServiceCategoryPermission $serviceCategoryPermission)
    {
        $this->serviceCategories = $serviceCategories;
        $this->serviceCategoryPermission = $serviceCategoryPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->serviceCategories->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->serviceCategoryPermission->canCreate()) {

            $this->forbidden("You can't create service category");
        }

        $this->validateOrFail($data = Input::all(), $this->serviceCategories->rules());

        return $this->serviceCategories->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        return $serviceCategory->load('image');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function update(ServiceCategory $serviceCategory)
    {
        if(! $this->serviceCategoryPermission->canUpdate($serviceCategory)) {

            $this->forbidden("You can't update this service category");
        }

        $this->validateOrFail($data = Input::all(), $serviceCategory->rules());

        $serviceCategory->update(Input::all());

        return $serviceCategory;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        if(! $this->serviceCategoryPermission->canDelete($serviceCategory)) {

            $this->forbidden("You can't delete this service category");
        }

        $serviceCategory->delete();

        return Response::make(['message' => 'Service category deleted successfully']);
    }


}

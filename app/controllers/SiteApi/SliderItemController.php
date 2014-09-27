<?php namespace SiteApi;

use Aska\Site\Models\SliderItem;
use Aska\Site\Permissions\SliderItemPermission;
use BaseController;
use Input, Response;

class SliderItemController extends BaseController {

    /**
     * @param SliderItem $sliderItems
     * @param SliderItemPermission $sliderItemPermission
     */
    public function __construct(SliderItem $sliderItems, SliderItemPermission $sliderItemPermission)
    {
        $this->sliderItems = $sliderItems;
        $this->sliderItemPermission = $sliderItemPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->sliderItems->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->sliderItemPermission->canCreate()) {

            $this->forbidden("You can't create slider item");
        }

        $this->validateOrFail($data = Input::all(), $this->sliderItems->rules());

        return $this->sliderItems->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param SliderItem $sliderItem
     * @return Response
     */
    public function show(SliderItem $sliderItem)
    {
        return $sliderItem->load('image');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderItem $sliderItem
     * @return Response
     */
    public function update(SliderItem $sliderItem)
    {
        if(! $this->sliderItemPermission->canUpdate($sliderItem)) {

            $this->forbidden("You can't update this slider item");
        }

        $this->validateOrFail($data = Input::all(), $sliderItem->rules());

        $sliderItem->update(Input::all());

        return $sliderItem;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param SliderItem $sliderItem
     * @return Response
     */
    public function destroy(SliderItem $sliderItem)
    {
        if(! $this->sliderItemPermission->canDelete($sliderItem)) {

            $this->forbidden("You can't delete this slider item");
        }

        $sliderItem->delete();

        return Response::make(['message' => 'SliderItem deleted successfully']);
    }
}

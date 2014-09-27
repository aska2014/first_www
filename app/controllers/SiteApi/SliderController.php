<?php namespace SiteApi;

use Aska\Site\Models\Slider;
use Aska\Site\Permissions\SliderPermission;
use BaseController;
use Input, Response;

class SliderController extends BaseController {

    /**
     * @param Slider $sliders
     * @param SliderPermission $sliderPermission
     */
    public function __construct(Slider $sliders, SliderPermission $sliderPermission)
    {
        $this->sliders = $sliders;
        $this->sliderPermission = $sliderPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->sliders->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->sliderPermission->canCreate()) {

            $this->forbidden("You can't create slider");
        }

        $this->validateOrFail($data = Input::all(), $this->sliders->rules());

        return $this->sliders->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return Response
     */
    public function show(Slider $slider)
    {
        return $slider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Slider $slider
     * @return Response
     */
    public function update(Slider $slider)
    {
        if(! $this->sliderPermission->canUpdate($slider)) {

            $this->forbidden("You can't update this slider");
        }

        $this->validateOrFail($data = Input::all(), $slider->rules());

        $slider->update(Input::all());

        return $slider;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return Response
     */
    public function destroy(Slider $slider)
    {
        if(! $this->sliderPermission->canDelete($slider)) {

            $this->forbidden("You can't delete this slider");
        }

        $slider->delete();

        return Response::make(['message' => 'Slider deleted successfully']);
    }
}

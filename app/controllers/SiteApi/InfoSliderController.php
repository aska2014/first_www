<?php namespace SiteApi;

use Aska\Site\Models\InfoSlider;
use Input, Response;

class InfoSliderController extends \BaseController {

    /**
     * @param InfoSlider $infoSliders
     */
    public function __construct(InfoSlider $infoSliders)
    {
        $this->infoSliders = $infoSliders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->infoSliders->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->validateOrFail($data = Input::all(), $this->infoSliders->rules());

        return $this->infoSliders->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param InfoSlider $infoSlider
     * @return Response
     */
    public function show(InfoSlider $infoSlider)
    {
        return $infoSlider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InfoSlider $infoSlider
     * @return Response
     */
    public function update(InfoSlider $infoSlider)
    {
        $this->validateOrFail($data = Input::all(), $infoSlider->rules());

        $infoSlider->update(Input::all());

        return $infoSlider;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param InfoSlider $infoSlider
     * @return Response
     */
    public function destroy(InfoSlider $infoSlider)
    {
        $infoSlider->delete();

        return Response::make(['message' => 'Info slider deleted successfully']);
    }

} 
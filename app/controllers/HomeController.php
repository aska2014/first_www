<?php

use Aska\Site\Models\InfoSlider;
use Aska\Site\Models\ProductCategory;
use Aska\Site\Models\ServiceCategory;
use Aska\Site\Models\Slider;

class HomeController extends BaseController {

    /**
     * @param ProductCategory $productCategories
     * @param ServiceCategory $serviceCategories
     * @param Aska\Site\Models\Slider $sliders
     * @param Aska\Site\Models\InfoSlider $infoSliders
     */
    public function __construct(ProductCategory $productCategories, ServiceCategory $serviceCategories,
                                Slider $sliders, InfoSlider $infoSliders)
    {
        $this->productCategories = $productCategories;
        $this->serviceCategories = $serviceCategories;
        $this->sliders = $sliders;
        $this->infoSliders = $infoSliders;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $homeSlider = $this->sliders->byPage('home')->first();

        return View::make('home.index')
            ->with('productCategories', $this->productCategories->all())
            ->with('serviceCategories', $this->serviceCategories->all())
            ->with('sliderItems', $homeSlider->items)
            ->with('infoSliders', $this->infoSliders->all());
    }
}
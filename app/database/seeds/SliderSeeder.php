<?php

use Aska\Site\Models\Slider;

class SliderSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        Slider::truncate();

        Slider::create([
            'page' => 'home'
        ]);
    }

} 
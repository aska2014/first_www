<?php

use Aska\Site\Models\News;
use Aska\Site\Models\Product;
use Aska\Site\Models\Project;
use Aska\Site\Models\Service;

class NewsController extends BaseController {

    /**
     * @param News $news
     * @param Aska\Site\Models\Project $projects
     * @param Product $products
     * @param Aska\Site\Models\Service $services
     */
    public function __construct(News $news, Project $projects, Product $products, Service $services)
    {
        $this->news = $news;
        $this->projects = $projects;
        $this->products = $products;
        $this->services = $services;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function show($slug)
    {
        $news = $this->news->bySlug($slug)->first();

        $projects = $this->projects->with('images')->take(6)->get();
        $recentNews = $this->news->with('images')->take(6)->get();
        $products = $this->products->all();
        $services = $this->services->all();

        return View::make('news.index', compact('news', 'projects', 'recentNews', 'products', 'services'));
    }

} 
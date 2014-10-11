<?php

use Aska\Site\Models\News;

class NewsController extends BaseController {

    /**
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function show($slug)
    {
        $news = $this->news->bySlug($slug)->first();

        return View::make('news.index')->with('news', $news);
    }

} 
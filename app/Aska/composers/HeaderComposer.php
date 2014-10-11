<?php namespace Aska\composers;

use Aska\Site\Models\News;
use Aska\Site\Models\Page;

class HeaderComposer {

    /**
     * @param News $news
     * @param Page $pages
     */
    public function __construct(News $news, Page $pages)
    {
        $this->news = $news;
        $this->pages = $pages;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $page = $this->pages->bySlug('about-us')->first();

        $view->with('news', $this->news->take(5)->get());

        $view->with('aboutUsPage', $page);
    }
}
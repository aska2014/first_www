<?php

use Aska\Site\Models\Page;

class PageController extends BaseController {
    /**
     * @param Page $pages
     */
    public function __construct(Page $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function show($slug)
    {
        $page = $this->pages->bySlug($slug)->first();

        return View::make('pages.index')->with('page', $page);
    }

} 
<?php namespace SiteApi;


use Aska\Site\Models\Page;
use Aska\Site\Permissions\PagePermission;
use BaseController;
use Response, Input;

class PageController extends BaseController {

    /**
     * @param Page $pages
     * @param PagePermission $pagePermission
     */
    public function __construct(Page $pages, PagePermission $pagePermission)
    {
        $this->pages = $pages;
        $this->pagePermission = $pagePermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->pages->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->pagePermission->canCreate()) {

            $this->forbidden("You can't create page");
        }

        $this->validateOrFail($data = Input::all(), $this->pages->rules());

        return $this->pages->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function show(Page $page)
    {
        return $page->load('sections');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Page $page
     * @return Response
     */
    public function update(Page $page)
    {
        if(! $this->pagePermission->canUpdate($page)) {

            $this->forbidden("You can't update this page");
        }

        $this->validateOrFail($data = Input::all(), $page->rules());

        $page->update(Input::all());

        return $this->show($page);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        if(! $this->pagePermission->canDelete($page)) {

            $this->forbidden("You can't delete this page");
        }

        $page->delete();

        return Response::make(['message' => 'Page deleted successfully']);
    }
}

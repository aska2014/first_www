<?php namespace SiteApi;


use Aska\Site\Models\News;
use Aska\Site\Permissions\NewsPermission;
use BaseController;
use Response, Input;

class NewsController extends BaseController {

    /**
     * @param News $news
     * @param NewsPermission $newsPermission
     */
    public function __construct(News $news, NewsPermission $newsPermission)
    {
        $this->news = $news;
        $this->newsPermission = $newsPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->news->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->newsPermission->canCreate()) {

            $this->forbidden("You can't create news");
        }

        $this->validateOrFail($data = Input::all(), $this->news->rules());

        return $this->news->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return Response
     */
    public function show(News $news)
    {
        return $news->load('images');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param News $news
     * @return Response
     */
    public function update(News $news)
    {
        if(! $this->newsPermission->canUpdate($news)) {

            $this->forbidden("You can't update this news");
        }

        $this->validateOrFail($data = Input::all(), $news->rules());

        $news->update(Input::all());

        return $news;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return Response
     */
    public function destroy(News $news)
    {
        if(! $this->newsPermission->canDelete($news)) {

            $this->forbidden("You can't delete this news");
        }

        $news->delete();

        return Response::make(['message' => 'News deleted successfully']);
    }
}

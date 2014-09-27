<?php

use Aska\Site\Models\Project;

class ProjectsController extends BaseController {

    /**
     * @param Project $projects
     */
    public function __construct(Project $projects)
    {
        $this->projects = $projects;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $this->setPage('projects');

        return View::make('projects.index')
            ->with('projects', $this->projects->all());
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function show($slug)
    {
        $project = $this->projects->bySlug($slug)->first();

        return View::make('project.index')->with('project', $project);
    }
}
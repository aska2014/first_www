<?php namespace SiteApi;


use Aska\Site\Models\Project;
use Aska\Site\Permissions\ProjectPermission;
use BaseController;
use Response, Input;

class ProjectController extends BaseController {

    /**
     * @param Project $projects
     * @param ProjectPermission $projectPermission
     */
    public function __construct(Project $projects, ProjectPermission $projectPermission)
    {
        $this->projects = $projects;
        $this->projectPermission = $projectPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->projects->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->projectPermission->canCreate()) {

            $this->forbidden("You can't create project");
        }

        $this->validateOrFail($data = Input::all(), $this->projects->rules());

        return $this->projects->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Response
     */
    public function show(Project $project)
    {
        return $project->load('images');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @return Response
     */
    public function update(Project $project)
    {
        if(! $this->projectPermission->canUpdate($project)) {

            $this->forbidden("You can't update this project");
        }

        $this->validateOrFail($data = Input::all(), $project->rules());

        $project->update(Input::all());

        return $project;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Response
     */
    public function destroy(Project $project)
    {
        if(! $this->projectPermission->canDelete($project)) {

            $this->forbidden("You can't delete this project");
        }

        $project->delete();

        return Response::make(['message' => 'Project deleted successfully']);
    }
}

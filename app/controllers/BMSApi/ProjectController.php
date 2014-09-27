<?php namespace BMSApi;


use Aska\BMS\Models\Project;
use Aska\BMS\Permissions\ProjectPermission;
use Aska\BMS\Validators\ProjectValidator;
use Aska\Membership\Auth\SessionUser;
use BaseController;
use Response, Input;

class ProjectController extends BaseController {

    /**
     * @param Project $projects
     * @param ProjectValidator $projectValidator
     * @param SessionUser $sessionUser
     * @param ProjectPermission $projectPermission
     */
    public function __construct(Project $projects, ProjectValidator $projectValidator,
                                SessionUser $sessionUser, ProjectPermission $projectPermission)
    {
        $this->projects = $projects;
        $this->projectValidator = $projectValidator;
        $this->sessionUser = $sessionUser;
        $this->projectPermission = $projectPermission;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $query = $this->projects->with('creator');

        switch(Input::get('role')) {
            // Get all projects approved by this user
            case 'approver':
                $query = $query->byApprover($this->sessionUser->user());
                break;
            // Get all projects created by this user
            case 'creator':
                $query = $query->byCreator($this->sessionUser->user());
                break;
            // Get all projects where this user in team
            case 'team':
                $query = $query->inTeam($this->sessionUser->user());
                break;
            default:

                // Check if you have permission to see all projects
                if(! $this->projectPermission->canSeeAll()) {

                    $this->forbidden("You don't have access to see all projects");
                }
                break;
        }

        return $query->get();
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function show(Project $project)
    {
        if(! $this->projectPermission->canSee($project)) {

            $this->forbidden("You can't see this project");
        }

        return $project->load('stages', 'files', 'team');
    }

    /**
     * Create new project
     */
    public function store()
    {
        if(! $this->projectPermission->canCreate()) {

            $this->forbidden("You can't create projects");
        }

        $this->projectValidator->validateOrFail($data = Input::all());

        $project = $this->projects->create($data);

        if(Input::has('files')) {

            $project->setFiles(Input::get('files'));
        }

        if(Input::has('team')) {

            $project->setTeam(Input::get('team'));
        }

        if(Input::has('stages')) {

            $project->setStages(Input::get('stages'));
        }

        return $project;
    }

    /**
     * Update project
     *
     * @param Project $project
     * @return mixed
     */
    public function update(Project $project)
    {
        if(! $this->projectPermission->canUpdate($project)) {

            $this->forbidden("You can't update this project");
        }

        $this->projectValidator->validateOrFail($data = Input::all());

        $project->update($data);

        if(Input::has('files')) {

            $project->setFiles(Input::get('files'));
        }

        if(Input::has('team')) {

            $project->setTeam(Input::get('team'));
        }

        if(Input::has('stages')) {

            $project->setStages(Input::get('stages'));
        }

        return $project->load('stages', 'files', 'team');
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function destroy(Project $project)
    {
        if(! $this->projectPermission->canDelete($project)) {

            $this->forbidden("You can't delete this project");
        }

        $project->delete();

        return Response::make(['message' => 'Project deleted.']);
    }
}
<?php

use Cane\Models\Company\Project;
use Cane\Permissions\ProjectPermission;
use Cane\UserSession;
use Cane\Validators\ProjectValidator;

class ProjectController extends BaseController {

    /**
     * @param Project $projects
     * @param ProjectValidator $projectValidator
     * @param UserSession $userSession
     * @param Cane\Permissions\ProjectPermission $projectPermission
     */
    public function __construct(Project $projects, ProjectValidator $projectValidator,
                                UserSession $userSession, ProjectPermission $projectPermission)
    {
        $this->projects = $projects;
        $this->projectValidator = $projectValidator;
        $this->userSession = $userSession;
        $this->projectPermission = $projectPermission;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $query = $this->projects;

        switch(Input::get('role')) {
            // Get all projects approved by this user
            case 'approver':
                $query = $query->byApprover($this->userSession->user());
                break;
            // Get all projects created by this user
            case 'creator':
                $query = $query->byCreator($this->userSession->user());
                break;
            // Get all projects where this user in team
            case 'team':
                $query = $query->inTeam($this->userSession->user());
                break;
            default:

                // Check if you have permission to see all projects
                if(! $this->projectPermission->canSeeAll()) {

                    $this->noAccess("You don't have access to see all projects");
                }
                break;
        }

        return $query->get();
    }

    /**
     * @param Cane\Models\Company\Project $project
     * @return Project
     */
    public function show(Project $project)
    {
        if(! $this->projectPermission->canSee($project)) {

            $this->noAccess("You can't see this project");
        }

        return $project->load('stages', 'files', 'team');
    }

    /**
     * Create new project
     */
    public function store()
    {
        if(! $this->projectPermission->canCreate()) {

            $this->noAccess("You can't create projects");
        }

        $this->projectValidator->validateOrFail($data = Input::all());

        return $this->projects->create($data);
    }

    /**
     * Update project
     *
     * @param Cane\Models\Company\Project $project
     * @return mixed
     */
    public function update(Project $project)
    {
        if(! $this->projectPermission->canUpdate($project)) {

            $this->noAccess("You can't update this project");
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
     * @param Cane\Models\Company\Project $project
     * @return mixed
     */
    public function destroy(Project $project)
    {
        if(! $this->projectPermission->canDelete($project)) {

            $this->noAccess("You can't delete this project");
        }

        $project->delete();

        return Response::make(['message' => 'Project deleted.']);
    }
}